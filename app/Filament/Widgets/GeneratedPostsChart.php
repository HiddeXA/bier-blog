<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Carbon\CarbonPeriod;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class GeneratedPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Generated posts';
    protected static ?string $pollingInterval = '10s';

    public ?string $filter = '7_days';

    protected function getFilters(): ?array
    {
        return [
            '7_days' => 'Last 7 days',
            '30_days' => 'Last 30 days',
            '90_days' => 'Last 90 days',
            '365_days' => 'Last 12 months',
        ];
    }

    protected function getData(): array
    {
        [$start, $end, $period] = $this->getDateRange();

        $counts = Post::query()
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->all();

        $labels = [];
        $data = [];

        foreach ($period as $date) {
            $key = $date->toDateString();

            $labels[] = $date->format('M j');
            $data[] = $counts[$key] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Posts',
                    'data' => $data,
                    'borderColor' => '#f59e0b',
                    'backgroundColor' => 'rgba(245, 158, 11, 0.25)',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getDateRange(): array
    {
        $days = match ($this->filter) {
            '30_days' => 30,
            '90_days' => 90,
            '365_days' => 365,
            default => 7,
        };

        $end = Carbon::now()->endOfDay();
        $start = Carbon::now()->subDays($days - 1)->startOfDay();
        $period = CarbonPeriod::create($start, $end);

        return [$start, $end, $period];
    }
}
