<?php


namespace App;


trait HasRoles
{
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function assignRole($role)
    {
        if(! $role instanceof  Role) {
            $role = Role::findOrFail(intval($role));
        }
        $this->role_id = $role->id;
        $this->save();
    }

    public function isSuperAdmin()
    {
        return $this->role && $this->role->type === Role::SUPER_ADMIN;
    }

    public function isEditor()
    {
        return $this->role && $this->role->type === Role::EDITOR;
    }

    public function isWriter()
    {
        return $this->role && $this->role->type === Role::WRITER;
    }
}