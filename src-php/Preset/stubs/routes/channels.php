<?php

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Broadcast;

collect([
    'store_name' => 'required_permission',
])->each(function ($permission, $channel) {
    Broadcast::channel($channel, function () use ($permission) {
        return Gate::allows($permission);
    });
});
