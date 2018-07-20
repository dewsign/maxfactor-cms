<?php

namespace Maxfactor\CMS\Modules;

use Maxfactor\CMS\Facades\ImageStore;
use Maxfactor\Support\Video\Facades\Video;

/**
 * WIP. Quick fix solution to render repeater blocks. Needs to thought on how to improve this and
 * make it more scalable?
 */
class RepeaterContent
{
    private $repeaterBlocks;

    public function __construct(array $repeaterBlocks = null)
    {
        $this->repeaterBlocks = collect($repeaterBlocks);
    }

    /**
     * Return all repeater blocks as a combined markdown text value
     *
     * @return String
     */
    public function toMarkdown()
    {
        return $this->repeaterBlocks->map(function ($item, $key) {
            if (is_string($item)) {
                return $item;
            }

            $itemType = ucfirst($item['type']);
            $itemValue = $item['content'];

            if (!method_exists($this, $itemRenderMethod = "render{$itemType}Repeater")) {
                return $itemValue;
            }

            return $this->$itemRenderMethod($itemValue);
        })->implode("\n\r");
    }

    /**
     * Process "text" repeater field
     *
     * @param mixed $value
     * @return String
     */
    public function renderTextRepeater($value)
    {
        return $value;
    }

    /**
     * Process "textarea" repeater field
     *
     * @param mixed $value
     * @return String
     */
    public function renderTextareaRepeater($value)
    {
        return $value;
    }

    /**
     * Process "image" repeater field
     *
     * @param mixed $value
     * @return String
     */
    public function renderImageRepeater($value)
    {
        $image_id = $value['image_id'];

        if (! $image_id) {
            return '';
        }

        $imageUrl = ImageStore::getUrl($image_id, [
            "width" => 1200,
        ]);

        $imageAlt = $value['image_alt'];

        return "![$imageAlt]({$imageUrl})";
    }

    /**
     * Process "video" repeater field
     *
     * @param mixed $value
     * @return string
     */
    public function renderVideoRepeater($value)
    {
        $content = Video::parse($value);

        return sprintf('<div class="repeater-block__video">%s</div>', $content);
    }
}
