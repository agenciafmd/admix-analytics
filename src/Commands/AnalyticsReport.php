<?php

namespace Agenciafmd\Analytics\Commands;

use Agenciafmd\Admix\Models\User;
use Agenciafmd\Analytics\Notifications\ReportNotification;
use Illuminate\Console\Command;

class AnalyticsReport extends Command
{
    protected $signature = 'analytics:report';

    protected $description = 'Dispara emails com as estatísticas';

    public function handle()
    {
        $users = User::isActive()
            ->get();

        $users->each(function ($user) {
            $user->notify(new ReportNotification());
        });
    }
}
