<?php

namespace Ss\Repositories\User;

use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\UserTrait;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Laracasts\Presenter\PresentableTrait;
use Ss\Domain\User\Events\UserAdded;
use Ss\Domain\User\Events\UserDeleted;
use Ss\Domain\User\Events\UserRestored;
use Ss\Domain\User\Events\UserUpdated;
use Ss\Models\BaseModel;

class User extends BaseModel implements UserInterface, RemindableInterface
{
    use UserTrait, RemindableTrait, PresentableTrait, SoftDeletingTrait;

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
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'is_admin', 'is_active'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * @var string
     */
    protected $presenter = 'Ss\Repositories\User\UserPresenter';

    /**
     * Hashes the user's password before record is saved.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * User has many activities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activities()
    {
        return $this->hasMany('Ss\Repositories\Activity\Activity')->latest()->latest('id');
    }

    /**
     * A user has many follows.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function follows()
    {
        return $this->hasMany('Ss\Repositories\Follow\Follow');
    }

    /**
     * User has many songs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function songs()
    {
        return $this->hasMany('Ss\Repositories\Song\Song');
    }

    /**
     * A user has many votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany('Ss\Repositories\Vote\Vote');
    }

    public function unvotedSongs()
    {
        $user = $this->id;

        return \Ss\Repositories\Song\Song::whereHas('votes', function ($q) use ($user) {
            $q->where('user_id', '=', $user);
        }, '=', 0)->get();
    }

    /**
     * Add a new user to the system.
     *
     * @param $first_name
     * @param $last_name
     * @param $email
     * @param $password
     * @param $is_admin
     * @param $is_active
     * @param $notify
     * @return User
     */
    public static function add($first_name, $last_name, $email, $password, $is_admin, $is_active, $notify)
    {
        $song = new static(compact('first_name', 'last_name', 'email', 'password', 'is_admin', 'is_active', 'notify'));

        $song->raise(new UserAdded($song));

        return $song;
    }

    /**
     * Updates a user in the system.
     *
     * @param $user
     * @param $input
     * @return User
     */
    public static function edit($user, $input)
    {
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->email = $input['email'];
        $user->notify = $input['notify'];

        if (isset($input['is_active'])) {
            $user->is_active = $input['is_active'];
        }

        if (isset($input['is_admin'])) {
            $user->is_admin = $input['is_admin'];
        }

        if ($input['password']) {
            $user->password = $input['password'];
        }

        // only overwrite the file if not currently available
        if (isset($input['image']) && $input['image'] !== null) {
            if ($user->image !== null) {
                Queue::push('Ss\Workers\DeleteUserImages', array('image' => $user->image));
            }

            $user->image = $input['image'];
        }

        $user->raise(new UserUpdated($user));

        return $user;
    }

    /**
     * Deletes a user from the system.
     *
     * @param User $user
     * @return User
     */
    public static function deleteUser(User $user)
    {
        $user->raise(new UserDeleted($user));

        return $user;
    }

    /**
     * Restore a user.
     *
     * @param User $user
     * @return User
     */
    public static function restoreUser(User $user)
    {
        $user->raise(new UserRestored($user));

        return $user;
    }
}
