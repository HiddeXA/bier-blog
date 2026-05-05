<?php

namespace App\Filament\Resources\PostGenerationFailures\Tables;

use App\Models\FailedJob;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostGenerationFailuresTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('failed_at')
                    ->label('Mislukt op')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                TextColumn::make('display_name')
                    ->label('Job')
                    ->state(fn (FailedJob $record) => $record->display_name ?? 'Onbekend')
                    ->searchable(),
                TextColumn::make('exception_message')
                    ->label('Foutmelding')
                    ->limit(120)
                    ->tooltip(fn (FailedJob $record) => $record->exception ?: null)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('queue')
                    ->label('Queue')
                    ->badge()
                    ->sortable(),
            ])
            ->defaultSort('failed_at', 'desc')
            ->filters([
                //
            ]);
    }
}
