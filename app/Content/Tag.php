<?php

namespace App\Content;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    protected $fillable = ['name'];

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }

    public function hasArticles()
    {
        return $this->articles->count() > 0;
    }

    public static function deleteBatch($ids)
    {
        collect($ids)->each(function($id) {
           static::findOrFail($id)->delete();
        });
    }
}
