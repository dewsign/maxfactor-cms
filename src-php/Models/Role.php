<?php

namespace Maxfactor\CMS\Models;

use Silvanite\Brandenburg\Role as BrandenburgRole;
use Dewsign\PusherAgent\Traits\BroadcastsPusherEvents;

class Role extends BrandenburgRole
{
    use BroadcastsPusherEvents;
}
