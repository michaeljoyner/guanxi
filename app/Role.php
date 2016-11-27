<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const SUPER_ADMIN = 'super admin';
    const EDITOR = 'editor';
    const WRITER = 'writer';

    protected $table = 'roles';

    protected $fillable = ['type'];

    public static function superadmin()
    {
        return static::firstOrCreate(['type' => static::SUPER_ADMIN]);
    }

    public static function editor()
    {
        return static::firstOrCreate(['type' => static::EDITOR]);
    }

    public static function writer()
    {
        return static::firstOrCreate(['type' => static::WRITER]);
    }
}
