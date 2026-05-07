<?php

namespace App\Filament\Resources\PostGenerationFailures;

use App\Filament\Resources\PostGenerationFailures\Pages\ListPostGenerationFailures;
use App\Filament\Resources\PostGenerationFailures\Tables\PostGenerationFailuresTable;
use App\Models\FailedJob;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PostGenerationFailureResource extends Resource
{
    protected static ?string $model = FailedJob::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static ?string $navigationLabel = 'Post generatie fouten';

    protected static ?string $modelLabel = 'Post generatie fout';

    protected static ?string $pluralModelLabel = 'Post generatie fouten';

    public static function table(Table $table): Table
    {
        return PostGenerationFailuresTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('payload', 'like', '%GeneratePostJob%');
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPostGenerationFailures::route('/'),
        ];
    }
}
