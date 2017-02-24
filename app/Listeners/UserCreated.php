<?php

namespace App\Listeners;

use App\Events\UserCreated as UserCreatedEvent;
use Illuminate\Support\Facades\Mail;
use Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserCreated
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        Mail::to($event->user->email)->send(new \App\Mail\UserCreated($event->user));
        Log::info('User created: '.$event->user->email);
    }
}
