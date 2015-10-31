<?php

namespace Ss\Repositories\Setting;

use Illuminate\Database\Eloquent\Model;

class EloquentSetting implements SettingInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Fetches and returns setting data associated with a key.
     *
     * @param $key
     * @return object
     * @throws SettingNotFoundException
     */
    public function getByKey($key)
    {
        $setting = $this->model->where('key', $key)->first();
        if (!$setting) {
            throw new SettingNotFoundException('No setting found with KEY: ' . $key);
        }

        return $setting;
    }

    /**
     * Accept setting data that will be persisted in data source.
     *
     * @param Setting $setting
     * @return \Ss\Repositories\Setting\Setting
     * @throws SettingNotSavedException
     */
    public function save(Setting $setting)
    {
        $setting->save();

        if (!$setting->id) {
            throw new SettingNotSavedException('The setting was not saved.');
        }

        return $setting;
    }

    /**
     * Updates the rating threshold after user is added,
     * updated, deleted, or restored.
     *
     * @param $userCount
     * @return object
     */
    public function updateThreshold($userCount)
    {
        $setting = $this->getByKey('threshold');

        // recalculate threshold
        if ($userCount == 1) {
            $setting->value = 1;
        } elseif ($userCount % 2 == 0) {
            // if even amount of users, add 1 for majority
            $setting->value = ($userCount / 2) + 1;
        } else {
            // if odd amount of users, calculate majority
            $setting->value = ceil($userCount / 2);
        }

        $this->save($setting);

        return $setting;
    }
}
