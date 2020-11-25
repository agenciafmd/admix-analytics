<?php

namespace Agenciafmd\Analytics\Mail;

use Agenciafmd\Analytics\Services\AnalyticsService;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Carbon;

class ReportMail extends Mailable
{
    protected $notifiable;

    public function __construct($notifiable)
    {
        $this->notifiable = $notifiable;
    }

    public function build(AnalyticsService $analytics)
    {
        $view['initialDate'] = Carbon::yesterday()
            ->subDays(7)
            ->startOfDay();
        $view['finalDate'] = Carbon::yesterday()
            ->endOfDay();

        $view['sessions'] = human_number($analytics->generic('ga:sessions')['totalForAllResults']);
        $view['newUsers'] = human_number($analytics->generic('ga:newUsers')['totalForAllResults']);
        $view['organicSearches'] = human_number($analytics->generic('ga:organicSearches')['totalForAllResults']);

        $analyticsTopPages = $analytics->topPages();
        $topPages = collect([]);
        foreach ($analyticsTopPages as $page) {
            $topPages->push((object)[
                'path' => $page['pagePath'],
                'pageViews' => human_number($page['pageViews']),
            ]);
        }

        $view['topPages'] = $topPages;

        $analyticsTopKeyword = $analytics->topKeyword();
        $topKeyword = collect([]);
        foreach ($analyticsTopKeyword as $page) {
            $topKeyword->push((object)[
                'keyword' => $page['keyword'],
                'pageViews' => human_number($page['pageViews']),
            ]);
        }

        $view['topKeyword'] = $topKeyword;

        $analyticsTopMedium = $analytics->topMedium();
        $topMedium = collect([]);
        foreach ($analyticsTopMedium as $page) {
            $topMedium->push((object)[
                'medium' => $page['medium'],
                'pageViews' => human_number($page['pageViews']),
            ]);
        }

        $view['topMedium'] = $topMedium;

        $analyticsTopDeviceCategory = $analytics->topDimensions('ga:deviceCategory');
        $topDeviceCategory = collect([]);
        $topDeviceCategoryTotal = $analyticsTopDeviceCategory['totalForAllResults'];
        foreach ($analyticsTopDeviceCategory['rows'] as $device) {
            $topDeviceCategory->push((object)[
                'deviceCategory' => $device['dimensions'],
                'sessions' => human_number($device['sessions']),
                'percent' => human_number(($device['sessions'] * 100) / $topDeviceCategoryTotal),
            ]);
        }

        $view['topDeviceCategory'] = $topDeviceCategory;

        $analyticsTopCity = $analytics->topDimensions('ga:city');
        $topCity = collect([]);
        foreach ($analyticsTopCity['rows'] as $city) {
            $topCity->push((object)[
                'city' => $city['dimensions'],
                'pageViews' => human_number($city['sessions']),
            ]);
        }

        $view['topCity'] = $topCity;

        return $this->to($this->notifiable->email, $this->notifiable->name)
            ->subject(config('app.name') . ' | Relatório de Semanal')
            ->view('agenciafmd/analytics::email.report')
            ->with($view);
    }
}
