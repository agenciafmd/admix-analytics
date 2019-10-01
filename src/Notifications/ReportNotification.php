<?php

namespace Agenciafmd\Analytics\Notifications;

use Agenciafmd\Analytics\Mail\ReportMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ReportNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $tries = 5;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return new ReportMail($notifiable);
    }
}
