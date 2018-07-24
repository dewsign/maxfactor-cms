<?php

namespace Maxfactor\CMS\Modules\ImageStore;

use Illuminate\Support\Carbon;

class ImageStore
{
    public function __construct()
    {
        \Cloudinary::config([
            'cloud_name' => config('imagestore.cloud_name'),
            'api_key' => config('imagestore.api_key'),
            'api_secret' => config('imagestore.api_secret'),
        ]);
    }

    /**
     * Get the full URL of an image for a given ID and transformation
     *
     * @param string $imageID
     * @param array $options
     * @return string
     */
    public function url(string $imageID, array $options)
    {
        // Always force secure URLs
        $options['secure'] = true;

        return \Cloudinary::cloudinary_url(
            $imageID,
            $options
        );
    }

    /**
     * Upload an image and return the required data to store it to the database
     *
     * @param string $filePath
     * @param string $originalFilename
     * @return array
     */
    public function store(string $filePath, string $filename)
    {
        $uploadPayload = \Cloudinary\Uploader::upload(
            $filePath,
            $options = [
                'public_id' => $this->uniqueFilename($filename),
            ]
        );

        if (is_array($uploadPayload)) {
            return [
                'image_id' => $uploadPayload['public_id'],
                'image_ext' => $uploadPayload['format'],
                'image_size' => $uploadPayload['bytes']
            ];
        }
    }

    /**
     * Delete a remote image and all its transformations
     *
     * @param string $imageID
     * @return void
     */
    public function destroy(string $imageID)
    {
        \Cloudinary\Uploader::destroy($imageID);
    }

    /**
     * Render image tag with alt tag.
     *
     * TODO: Move somewhere else, this shouldn't really be here.
     *
     * @param  array  $image  Image data and parameters
     * @return string|null
     */
    public function renderImage(array $image)
    {
        $imageId = array_get($image, 'data.content.image_id');
        $imageAlt = array_get($image, 'data.image_alt');
        $imageParams = array_get($image, 'params', []);

        if (!$imageId || !$imageAlt) {
            return null;
        }

        $imageUrl = self::getUrl($imageId, $imageParams);

        if ($imageUrl) {
            return sprintf('<img src="%s" alt="%s">', $imageUrl, $imageAlt);
        }
    }

    /**
     * Get a unique filename to avoid replacing existing files
     *
     * @param string $filename
     * @return string
     */
    private function uniqueFilename(string $filename)
    {
        return $originalFilename . '_' . Carbon::now()->timestamp;
    }
}
