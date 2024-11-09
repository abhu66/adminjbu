<?php

namespace App\Filament\Admin\Resources\LeaderResource\Pages;

use App\Filament\Admin\Resources\LeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLeader extends CreateRecord
{
    protected static string $resource = LeaderResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
