<?php

namespace App\Filament\Admin\Resources\LeaderResource\Pages;

use App\Filament\Admin\Resources\LeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLeader extends EditRecord
{
    protected static string $resource = LeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
