<?php

namespace App;

use App\People\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleted(function($user) {
            $user->profile->delete();
        });
    }

    public static function registerNew($user_attributes, $profile = null)
    {
        if($profile && $profile->user_id !== null) {
            throw new \Exception('Profile already has a user');
        }

        $user = static::create($user_attributes);
        $role_id = $user_attributes['role_id'] ?? Role::writer()->id;
        $user->assignRole($role_id);

        if($profile !== null) {
            $profile->assignTo($user);
        } else {
            $user->createProfile();
        }

        return $user;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function createProfile()
    {
        return $this->profile()->create([
            'name' => $this->name,
            'title' => ['en' => '', 'zh' => ''],
            'intro' => ['en' => '', 'zh' => ''],
            'bio' => ['en' => '', 'zh' => '']
        ]);
    }

    public function setPasswordAttribute($password)
    {
        if( ! empty($password)) {
            return $this->attributes['password'] = bcrypt($password);
        }
    }

    public function resetPassword($newPassword)
    {
        $this->password = $newPassword;
        $this->save();
    }

    public function createArticle(array $title, string $designation)
    {
        return $this->profile->articles()->create(['title' => $title, 'designation' => $designation]);
    }


}
