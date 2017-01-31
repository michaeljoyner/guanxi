<?php


namespace App\Content;


trait HasTags
{
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function addTag(Tag $tag)
    {
        $this->tags()->attach($tag->id);
    }

    public function removeTag(Tag $tag)
    {
        $this->tags()->detach($tag->id);
    }

    public function syncTags($tags)
    {
        $this->tags()->sync($tags);
    }

    public function createAndAttachTag($tagName)
    {
        $tag = Tag::firstOrCreate(['name' => $tagName]);

        if (!$this->tags->contains($tag)) {
            $this->addTag($tag);
        }

        return $tag;
    }
}