<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OwnerResource\Pages;
use App\Filament\Admin\Resources\OwnerResource\RelationManagers;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OwnerResource extends Resource
{
    protected static ?string $model = Owner::class;
    protected static ?int $navigationSort = 0;

    protected static ?string $navigationIcon = 'heroicon-s-building-office-2';

    public static function form(Form $form): Form
        {
          return $form
              ->schema([
                //card
                Forms\Components\Card::make()
                    ->schema([

                        //name
                        Forms\Components\TextInput::make('name')
                          ->label('Owner Name')
                          ->placeholder('Input owner name')
                          ->required(),


                        Forms\Components\TextInput::make('phone_number')
                        ->label('Phone Number')
                        ->placeholder('Input phone number')
                        ->required(),

                        //phone Number
                        Forms\Components\TextInput::make('email')
                          ->label('Email')
                          ->placeholder('Input email')
                          ->required(),

                        Forms\Components\Textarea::make('address')
                        ->label('Address')
                        ->placeholder('Input address')
                        ->required(),

                    ])
              ]);
        }

     public static function table(Table $table): Table
     {
       return $table
               ->columns([
                   Tables\Columns\TextColumn::make('name')->searchable(),
                   Tables\Columns\TextColumn::make('phone_number'),
                   Tables\Columns\TextColumn::make('email'),
                   Tables\Columns\TextColumn::make('address'),
                    // Show the creator's name
                  Tables\Columns\TextColumn::make('creator.name')
                      ->label('Created By')
                      ->sortable()
                      ->searchable()
                       ->default('System'),

                  // Show the updater's name
                  Tables\Columns\TextColumn::make('updater.name')
                      ->label('Updated By')
                      ->sortable()
                      ->searchable()
                      ->default('System'),
                  Tables\Columns\TextColumn::make('created_at'),
                  Tables\Columns\TextColumn::make('update_at'),
               ])
               ->filters([
                   //
               ])
               ->actions([
                   Tables\Actions\EditAction::make(),
               ])
               ->bulkActions([
                   Tables\Actions\BulkActionGroup::make([
                   Tables\Actions\DeleteBulkAction::make(),
               ]),
           ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOwners::route('/'),
            'create' => Pages\CreateOwner::route('/create'),
            'edit' => Pages\EditOwner::route('/{record}/edit'),
        ];
    }


    public static function getNavigationSort(): ?int
    {
        return 0;
    }
}
