<?php

namespace Maxfactor\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Dewsign\PusherAgent\Traits\BroadcastsPusherEvents;

class Language extends Model
{
    use BroadcastsPusherEvents;

    /**
     * The route namespace.
     *
     * @var array
     */
    protected $namespaces = [
        'admin' => 'admin.language.',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locale',
        'name',
    ];
}
