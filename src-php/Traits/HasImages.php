<?php

namespace Maxfactor\CMS\Traits;

trait HasImages
{
    /**
     * Get image ID.
     *
     * @param string $image_attribute
     * @return string Image ID
     */
    private function getImageId(string $image_attribute)
    {
        $image = $this->{$image_attribute};
        $image_id = data_get($image, 'content.image_id');

        if (!$image && !$image_id) {
            return null;
        }

        return $image_id;
    }

    /**
      * Get image URL.
      *
      * @param string $image_attribute
      * @param array $image_params
      * @return string Image URL
      */
    private function getImageUrl(string $image_attribute, array $image_params = [])
    {
        if (!$image_id = $this->getImageId($image_attribute)) {
            return null;
        }

        if (!$image_url = ImageStore::getUrl($image_id, $image_params)) {
            return null;
        }

        return $image_url;
    }

    /**
      * Get image alt text.
      *
      * @param string $image_attribute
      * @return string Image alt text
      */
    private function getImageAlt(string $image_attribute)
    {
        $image = $this->{$image_attribute};

        if (!$image || !($image_alt = $image['image_alt'])) {
            return null;
        }

        return $image_alt;
    }
}
