<?php

namespace App\Filament\Admin\Resources\LeaderResource\Pages;

use App\Filament\Admin\Resources\LeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLeaders extends ListRecords
{
    protected static string $resource = LeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
