<?php

use ikdev\ikpanel\App\Broadcasting\FoundExceptionChannel;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('exceptions', FoundExceptionChannel::class);
