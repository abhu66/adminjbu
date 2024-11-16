<?php

namespace App\Filament\Admin\Resources\LeaderResource\Pages;

use App\Filament\Admin\Resources\LeaderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditLeader extends EditRecord
{
    protected static string $resource = LeaderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

     protected function getRedirectUrl(): string
        {
            return $this->getResource()::getUrl('index');
        }

    protected function mutateFormDataBeforeSave(array $data): array
    {

        $data['image'] =  empty($data['image']) ? null : config('app.url')."/storage/".$data['image'];

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        //dd($data['image']);
        if (empty($data['image'])) {
            $data['image'] = $record['image'];
        }



        $record->update($data);

        return $record;
    }

}
