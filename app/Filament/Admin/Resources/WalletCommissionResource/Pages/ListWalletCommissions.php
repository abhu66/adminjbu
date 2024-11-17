<?php

namespace App\Filament\Admin\Resources\WalletCommissionResource\Pages;

use App\Filament\Admin\Resources\WalletCommissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWalletCommissions extends ListRecords
{
    protected static string $resource = WalletCommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
//             Actions\CreateAction::make(),
        ];
    }
}
