<?php
namespace Ss\Repositories\Setting;

interface SettingInterface
{
    /**
     * Fetches and returns setting data associated with a key
     *
     * @param $key
     * @return object
     * @throws SettingNotFoundException
     */
    public function getByKey($key);

    /**
     * Accept setting data that will be persisted in data source
     *
     * @param Setting $setting
     * @return \Ss\Repositories\Setting\Setting
     * @throws SettingNotSavedException
     */
    public function save(Setting $setting);

    /**
     * Updates the rating threshold after user is added,
     * updated, deleted, or restored
     *
     * @param $userCount
     * @return object
     */
    public function updateThreshold($userCount);
}
