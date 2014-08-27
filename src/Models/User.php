<?php
namespace Ss\Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Hash;

class User extends BaseModel implements UserInterface, RemindableInterface
{

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('first_name', 'last_name', 'email', 'password', 'is_admin', 'is_active');

    /**
     * Hashes the user's password before record is saved
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * User has many songs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function songs()
    {
        return $this->hasMany('Ss\Repositories\Song\Song');
    }
}
