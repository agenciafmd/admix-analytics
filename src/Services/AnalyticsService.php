<?php

namespace Agenciafmd\Analytics\Services;

use Illuminate\Support\Carbon;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class AnalyticsService
{
    public function generic($metrics = 'ga:users', $days = 7)
    {
        $responseBefore = Analytics::performQuery(
            Period::create(Carbon::yesterday()
                ->subDays($days * 2 - 1)
                ->startOfDay(), Carbon::yesterday()
                ->subDays($days)
                ->endOfDay()),
            $metrics, [
                'dimensions' => 'ga:date',
            ]
        );

        $response = Analytics::performQuery(
            Period::create(Carbon::yesterday()
                ->subDays($days - 1)
                ->startOfDay(), Carbon::yesterday()
                ->endOfDay()),
            $metrics, [
                'dimensions' => 'ga:date',
            ]
        );

        $rows = collect($response['rows'] ?? [])->map(function (array $dateRow) {
            return [
                'date' => Carbon::createFromFormat('Ymd', $dateRow[0]),
                'visitors' => (int)$dateRow[1],
            ];
        });

        return collect([
            'totalForAllResultsBefore' => $responseBefore->totalsForAllResults[$metrics],
            'totalForAllResults' => $response->totalsForAllResults[$metrics],
            'rows' => $rows,
        ]);
    }

    public function topDimensions($dimensions = 'ga:deviceCategory', $days = 7, $qty = 5)
    {
        $response = Analytics::performQuery(
            Period::create(Carbon::yesterday()
                ->subDays($days - 1)
                ->startOfDay(), Carbon::yesterday()
                ->endOfDay()),
            'ga:sessions', [
                'dimensions' => $dimensions,
                'sort' => '-ga:sessions',
                'filters' => $dimensions . '!=(not set)',
                'max-results' => $qty,
            ]
        );

        $rows = collect($response['rows'] ?? [])
            ->map(function (array $dataRow) {
                return [
                    'dimensions' => $dataRow[0],
                    'sessions' => (int)$dataRow[1],
                ];
            })
            ->splice(0, $qty);

        return collect([
            'totalForAllResults' => $response->totalsForAllResults['ga:sessions'],
            'rows' => $rows,
        ]);
    }

    public function topPages($days = 7, $qty = 5)
    {
        $response = Analytics::performQuery(
            Period::create(Carbon::yesterday()
                ->subDays($days - 1)
                ->startOfDay(), Carbon::yesterday()
                ->endOfDay()),
            'ga:pageViews,ga:avgTimeOnPage', [
                'dimensions' => 'ga:pageTitle,ga:pagePath,ga:hostname',
                'sort' => '-ga:pageViews',
                'filters' => 'ga:pageTitle!=(not set)',
                'max-results' => $qty,
            ]
        );

        return collect($response['rows'] ?? [])
            ->map(function (array $pageTitleRow) {
                return [
                    'pageTitle' => $pageTitleRow[0],
                    'pagePath' => $pageTitleRow[1],
                    'hostname' => $pageTitleRow[2],
                    'pageViews' => (int)$pageTitleRow[3],
                    'avgTimeOnPage' => (int)$pageTitleRow[4],
                    // 'avgTimeOnPage' => date('i \m\i\n s \s', mktime(0, 0, (int)$pageTitleRow[2], 1, 1, 2017)),
                ];
            })
            ->splice(0, $qty);
    }

    public function topMedium($days = 7, $qty = 5)
    {
        $response = Analytics::performQuery(
            Period::create(Carbon::yesterday()
                ->subDays($days - 1)
                ->startOfDay(), Carbon::yesterday()
                ->endOfDay()),
            'ga:pageViews,ga:sessions', [
                'dimensions' => 'ga:medium',
                'sort' => '-ga:pageViews',
                'filters' => 'ga:medium!=(none);ga:medium!=(not set)',
                'max-results' => $qty,
            ]
        );

        return collect($response['rows'] ?? [])
            ->map(function (array $pageTitleRow) {
                return [
                    'medium' => $pageTitleRow[0],
                    'pageViews' => (int)$pageTitleRow[1],
                    'sessions' => (int)$pageTitleRow[2],
                ];
            })
            ->splice(0, $qty);
    }

    public function topKeyword($days = 7, $qty = 5)
    {
        $response = Analytics::performQuery(
            Period::create(Carbon::yesterday()
                ->subDays($days - 1)
                ->startOfDay(), Carbon::yesterday()
                ->endOfDay()),
            'ga:pageViews,ga:sessions', [
                'dimensions' => 'ga:keyword',
                'sort' => '-ga:pageViews',
                'filters' => 'ga:keyword!=(none);ga:keyword!=(not set);ga:keyword!=(not provided);ga:keyword!=(automatic matching)',
                'max-results' => $qty,
            ]
        );

        return collect($response['rows'] ?? [])
            ->map(function (array $pageTitleRow) {
                return [
                    'keyword' => $pageTitleRow[0],
                    'pageViews' => (int)$pageTitleRow[1],
                    'sessions' => (int)$pageTitleRow[2],
                ];
            })
            ->splice(0, $qty);
    }
}
