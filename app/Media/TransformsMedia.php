<?php


namespace App\Media;


trait TransformsMedia
{
    public function transformMedia($media)
    {
        return [
            'title'       => $media->title,
            'thumbnail'   => $media->mainImageSrc('thumb'),
            'gallery'     => $media->galleryImages()->map(function ($image) {
                return ['src' => $image->getUrl('web')];
            })->toArray(),
            'contributor' => [
                'name' => $media->contributor->name,
                'link' => localUrl('/bios/' . $media->contributor->slug)
            ]
        ];
    }

    protected function mediaResponse($request, $galleries)
    {
        return response()->json([
            'page'      => $request->get('page', 1),
            'remaining' => $galleries->hasMorePages(),
            'albums'    => $this->prepareAlbums($galleries)
        ]);
    }

    protected function prepareAlbums($galleries)
    {
        return $galleries->map(function($media) {
            return $this->transformMedia($media);
        })->values();
    }
}