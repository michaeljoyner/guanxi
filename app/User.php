<?php

namespace App;

use App\Content\Article;
use App\People\Profile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\Translatable\HasTranslations;

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

        static::created(function($user) {
           $user->createProfile();
        });

        static::deleted(function($user) {
            $user->profile->delete();
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    protected function createProfile()
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

    public function createArticle($title, $locale = 'en')
    {
        $articleTitle = $locale === 'en' ? ['en' => $title, 'zh' => ''] : ['en' => '', 'zh' => $title];
        return $this->profile->articles()->create(['title' => $articleTitle]);
    }
}
