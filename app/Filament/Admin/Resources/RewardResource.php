<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RewardResource\Pages;
use App\Filament\Admin\Resources\RewardResource\RelationManagers;
use App\Models\Reward;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RewardResource extends Resource
{
    protected static ?string $model = Reward::class;

    protected static ?string $navigationIcon = 'heroicon-m-gift';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\Card::make()
                ->schema([
                    //name
                     Forms\Components\TextInput::make('name')
                      ->label('Reward Name')
                      ->placeholder('Input reward name')
                      ->required(),

                       Forms\Components\TextInput::make('poin')
                        ->label('Point')
                        ->placeholder('Input point')
                        ->required(),

                      Forms\Components\TextInput::make('hadiah')
                        ->label('Reward Name')
                        ->placeholder('Input reward name')
                        ->required(),

                     Forms\Components\Textarea::make('individu')
                         ->label('Invidu')
                         ->placeholder('Input invidu')
                         ->required(),

                     Forms\Components\Textarea::make('amir')
                          ->label('Invidu')
                          ->placeholder('Input invidu')
                          ->required(),
                ])
            ]);
    }

   public static function table(Table $table): Table
        {
          return $table
                  ->columns([
                      Tables\Columns\TextColumn::make('name')->searchable(),

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
            'index' => Pages\ListRewards::route('/'),
            'create' => Pages\CreateReward::route('/create'),
            'edit' => Pages\EditReward::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
            {
                return 5;
            }
}
