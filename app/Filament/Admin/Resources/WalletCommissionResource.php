<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WalletCommissionResource\Pages;
use App\Filament\Admin\Resources\WalletCommissionResource\RelationManagers;
use App\Models\WalletCommission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;


class WalletCommissionResource extends Resource
{
    protected static ?string $model = WalletCommission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
        {
            return $table
                ->columns([

                TextColumn::make('index')
                ->label('No. ')
                ->rowIndex(),


                Tables\Columns\TextColumn::make('transaction_code')->searchable(),

                TextColumn::make('ref_type')
                    ->searchable()->label('Reference Name')
                    ->formatStateUsing(function ($state, $record) {
                        if ($state === 'Members') {
                            // If ref_type is "Members", get the name from the related Member model
                            return $record->member ? $record->member->name . " - Member " : 'No member found';
                        }
                        else if($state === 'Leaders'){
                                // If ref_type is "Members", get the name from the related Member model
                            return $record->leader ? $record->leader->name . " - Leaders " : 'No leader found';
                        }
                        else if($state === 'Owners'){
                                // If ref_type is "Members", get the name from the related Member model
                            return $record->owner ? $record->owner->name . " - Owners " : 'No owners found';
                        }
                        return $state;
                    }),

//                    Tables\Columns\TextColumn::make('ref_type')->label('Ref Type'),

                    Tables\Columns\TextColumn::make('type')
                     ->label('Commissions Type')->searchable()
                     ->formatStateUsing(fn($state) => strtoupper($state)),

                     TextColumn::make('amount')
                     ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),
                ])
                ->filters([
                    // Add filters here if needed
                ])
                ->actions([
//                      ExportAction::make()
//                                     ->exporter(ProductExporter::class)
                ])
                ->bulkActions([
                    Tables\Actions\BulkActionGroup::make([
//                          ExportBulkAction::make()
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
            'index' => Pages\ListWalletCommissions::route('/'),
            'create' => Pages\CreateWalletCommission::route('/create'),
            'edit' => Pages\EditWalletCommission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
    {
        return 7;
    }
}
