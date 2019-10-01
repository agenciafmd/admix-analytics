<?php

namespace Agenciafmd\Analytics\Commands;

use Illuminate\Console\Command;
use Agenciafmd\Analytics\Services\AnalyticsService;

class AnalyticsImport extends Command
{
    protected $signature = 'analytics:import';

    protected $description = 'Importa as estatísticas do Analytics';

    public function handle()
    {
        $analytics = new AnalyticsService();

        $analytics->generic('ga:pageViews');
        $analytics->generic('ga:sessions');
        $analytics->generic('ga:avgSessionDuration');
        $analytics->generic('ga:goalCompletionsAll');
        $analytics->generic('ga:bounceRate');
        $analytics->generic('ga:users');
        $analytics->generic('ga:organicSearches');
        $analytics->generic('ga:sessions');
        $analytics->generic('ga:impressions');
        $analytics->generic('ga:newUsers');

        $analytics->topDimensions('ga:screenResolution');
        $analytics->topDimensions('ga:operatingSystem');
        $analytics->topDimensions('ga:browser');
        $analytics->topDimensions('ga:city');
        $analytics->topDimensions('ga:deviceCategory');
    }
}
