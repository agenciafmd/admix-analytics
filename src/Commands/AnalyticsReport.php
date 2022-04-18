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
        if (!config('analytics.view_id')) {
            return $this->error('Configuração Analytics não encontrada');
        }

        if (!file_exists(config('analytics.service_account_credentials_json'))) {
            return $this->error('Arquivo de credenciais do analytics não encontrado');
        }

        $users = User::isActive()
            ->get();

        $users->each(function ($user) {
            $user->notify(new ReportNotification());
        });

        return $this->info('Estatísticas enviadas com sucesso');
    }
}
