<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use App\Models\Client;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;

class RegisteredClientsChart extends ChartWidget
{
    protected static ?string $heading = 'Client Registration Chart';

    protected int | string | array $columnSpan = ['md' => 2, 'lg' =>1];

    public static function canView(): bool
    {
        return true;
    }

    protected function getData(): array
    {

        $data = Trend::model(Client::class)
            ->between(
                now()->subMonths(6),
                now()
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Last semester client registrations',
                    'data' => $data->map(fn($value) => $value->aggregate)
                ]

            ],
            'labels' => $data->map(fn($value) => $value->date)
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
