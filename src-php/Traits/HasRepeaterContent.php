<?php

namespace Maxfactor\CMS\Traits;

use Maxfactor\CMS\Modules\RepeaterContent;

/**
 * This is WIP and currently is partly hard-coded to use the "content" attribute. The long-term plan
 * is to make it work with any fields passed into the "repeaterFields" and "repeaterOutputFields".
 */
trait HasRepeaterContent
{
    private $repeaterFields = [
        'page_content',
    ];

    private $repeaterOutputFields = [
        'content',
    ];

    public function initHasRepeaterContent()
    {
        $this->casts = array_merge($this->casts, collect($this->repeaterFields)->map(function ($field) {
            return [$field => 'array'];
        })->collapse()->all());

        $this->fillable = array_merge($this->fillable, $this->repeaterFields);
        $this->appends = array_merge($this->appends, $this->repeaterOutputFields);
    }

    public function getContentAttribute()
    {
        /**
         * Would be nice to improve this by using a Facade or Contract type of approach and also
         * to return toMarkdown by default, similar to how laravel return toArray when passing data
         * to blade views for example.
         */
        return (new RepeaterContent($this->page_content))->toMarkdown();
    }
}
