<?php

namespace App\Filament\Resources\PostGenerationFailures\Pages;

use App\Filament\Resources\PostGenerationFailures\PostGenerationFailureResource;
use Filament\Resources\Pages\ListRecords;

class ListPostGenerationFailures extends ListRecords
{
    protected static string $resource = PostGenerationFailureResource::class;
}
