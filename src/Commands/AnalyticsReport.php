<?php

namespace Agenciafmd\Analytics\Commands;

use Agenciafmd\Admix\User;
use Agenciafmd\Analytics\Notifications\StatisticsReportNotification;
use Agenciafmd\Analytics\Services\AnalyticsService;
use Illuminate\Console\Command;

class AnalyticsReport extends Command
{
    protected $signature = 'analytics:report';

    protected $description = 'Dispara emails com as estatisticas';

    public function handle()
    {
        $users = User::get();


        // TODO: refatorar
        foreach ($users as $user) {
            $user->notify(new StatisticsReportNotification());
        }
    }
}
