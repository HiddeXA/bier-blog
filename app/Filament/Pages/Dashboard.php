<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\GeneratedPostsChart;
use App\Jobs\GeneratePostJob;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected function getHeaderActions(): array
    {
        return [
            Action::make('generatePost')
                ->label('Generate Post')
                ->icon('heroicon-o-sparkles')
                ->requiresConfirmation()
                ->action(function (): void {
                    GeneratePostJob::dispatch();

                    Notification::make()
                        ->title('Post generation queued')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function getWidgets(): array
    {
        return [
            GeneratedPostsChart::class,
        ];
    }
}
