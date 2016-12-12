<?php


namespace App\Media;


trait HasMainImage
{
    public function mainImageSrc($conversion = '')
    {
        return $this->modelImage($conversion) ?: static::DEFAULT_IMG_SRC;
    }

    public function setMainImage($file)
    {
        return $this->setImage($file);
    }
}