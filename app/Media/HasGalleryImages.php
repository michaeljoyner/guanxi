<?php


namespace App\Media;


trait HasGalleryImages
{
    public function gallery()
    {
        return $this->morphOne(Gallery::class, 'galleryable');
    }

    public function getGallery()
    {
        return $this->gallery()->firstOrCreate([]);
    }

    public function addGalleryImage($file)
    {
        return $this->getGallery()->addImage($file);
    }

    public function galleryImages($withMainImage = true)
    {
        if($withMainImage) {
            return $this->getMedia()->merge($this->getGallery()->getMedia());
        }

        return $this->getGallery()->getMedia();
    }
}