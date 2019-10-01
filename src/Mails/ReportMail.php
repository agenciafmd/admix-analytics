<?php

namespace Agenciafmd\Analytics\Mail;

use Illuminate\Mails\Mailable;
use Agenciafmd\Analytics\Services\AnalyticsService;
use Illuminate\Support\Carbon;

class ReportMail extends Mailable
{
    protected $notifiable;

    public function __construct($notifiable)
    {
        $this->notifiable = $notifiable;
    }

    public function build(AnalyticsService $analyticsServices)
    {
        // TODO: refatorar para vir do services
        /*
        $initialDate = Carbon::yesterday()->subDays(8)->startOfDay();
        $finalDate = Carbon::yesterday()->startOfDay();

        $analytics = $analyticsServices->topPages($initialDate, $finalDate);
        $medium = $analyticsServices->topMedium($initialDate, $finalDate);

        $table = [];
        foreach($analytics as $data) {
            $title = str_replace('|', '&#124;', str_limit($data['pageTitle'], 40));
            $table[] = (object)[
                'pagePath' => "[{$title}](https://{$data['hostname']}{$data['pagePath']})",
                'pageViews' => $data['pageViews'],
                'avgTimeOnPage' => date('i\m\i\n s\s', mktime(0, 0, (int)$data['avgTimeOnPage'], 1, 1, 2017))
            ];
        }

        $analyticsPageViews = $analyticsServices->pageViews(7);
        $statisticsLastWeek = $analyticsPageViews['rows']->pluck('sessions')->implode(',');

        $analyticsFinalDate = Carbon::today()->subDays(8)->startOfDay();
        $analyticsPageViews = $analyticsServices->pageViews(7, $analyticsFinalDate);
        $statisticsPastLastWeek = $analyticsPageViews['rows']->pluck('sessions')->implode(',');

        $content = [
            'greeting' => 'Olá ' . $this->notifiable->name . '!',
            'introLines' => [
                'Veja o resumo dos acessos do ' . config('app.name'),
                'Período de ' . $initialDate->format('d/m/Y') . ' até ' . $finalDate->format('d/m/Y'),
            ],
            'analytics' => collect($table),
            'medium' => collect(json_decode(json_encode($medium))),
            'statistics' => $statisticsPastLastWeek . '|' . $statisticsLastWeek
        ];

        return $this->to($this->notifiable->email, $this->notifiable->name)
            ->subject(config('app.name') . ' | Relatório de Semanal')
            ->markdown('mixdinternet/analytics::markdown.statistics')
            ->with($content);
        */
    }
}
