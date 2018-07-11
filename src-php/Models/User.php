<?php

namespace Maxfactor\CMS\Models;

use Illuminate\Notifications\Notifiable;
use Silvanite\Brandenburg\Traits\HasRoles;
use Dewsign\PusherAgent\Traits\BroadcastsPusherEvents;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use BroadcastsPusherEvents;
}
