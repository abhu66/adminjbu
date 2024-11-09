<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransactionResource\Pages;
use App\Filament\Admin\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-m-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
       {

//          'product_name',
//                 'transaction_code'
//                 'transaction_date'
//                 'price',
//                 'product_id',
//                 'member_id',
//                 'leader_id',
//                 'sponsor_id',
//                 'no_wa',
//                 'komisi_referral',
//                 'komisi_sponsor',
//                 'komisi_leader',
//                 'status', //1 = pending payment, 2 = payment, 3 = Cancel
//                 'reward'
           return $table
               ->columns([
                   // Use ImageColumn for displaying the image

                   Tables\Columns\TextColumn::make('product_name')->searchable(),
                   Tables\Columns\TextColumn::make('transaction_code')->searchable(),
                   Tables\Columns\TextColumn::make('transaction_date')->searchable(),
                   Tables\Columns\TextColumn::make('product_id'),
                   Tables\Columns\TextColumn::make('member_id'),
                   Tables\Columns\TextColumn::make('leader_id'),
                   Tables\Columns\TextColumn::make('sponsor_id'),
                   Tables\Columns\TextColumn::make('no_wa'),
                   Tables\Columns\TextColumn::make('komisi_referral'),
                   Tables\Columns\TextColumn::make('komisi_leader'),
                   Tables\Columns\TextColumn::make('komisi_sponsor'),
                   Tables\Columns\TextColumn::make('reward'),
                   Tables\Columns\TextColumn::make('status'),
                   Tables\Columns\TextColumn::make('id')
                    ->label('Actions')


               ])
               ->filters([
                   // Add filters here if needed
               ])
               ->actions([
                   Tables\Actions\EditAction::make()

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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
        {
            return 4;
        }
}
