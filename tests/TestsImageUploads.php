<?php

/**
 * Created by PhpStorm.
 * User: mooz
 * Date: 5/5/16
 * Time: 8:53 AM
 */
trait TestsImageUploads
{
    protected function prepareFileUpload($path, $name = null)
    {
        return \Illuminate\Http\UploadedFile::fake()->image($name ?: 'test-upload.png');
    }
}