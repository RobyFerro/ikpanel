<?php

use Illuminate\Support\Facades\Broadcast;
use ikdev\ikpanel\App\Broadcasting\FoundExceptionChannel;

Broadcast::channel('exceptions', FoundExceptionChannel::class);
