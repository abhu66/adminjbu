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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\HTML;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;







class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-m-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        // Product Name input field
                        Forms\Components\TextInput::make('product_name')
                            ->label('Product Name')
                            ->placeholder('Input product name')
                            ->readOnly(),

                        // Transaction Code input field
                        Forms\Components\TextInput::make('transaction_code')
                            ->label('Transaction Code')
                            ->placeholder('Input transaction code')
                            ->readOnly(),

                        // Transaction Date input field (use date picker)
                        Forms\Components\DatePicker::make('transaction_date')
                            ->label('Transaction Date')
                            ->readOnly(),

                        // Product ID input field
                        Forms\Components\TextInput::make('product_id')
                            ->label('Product ID')
                            ->placeholder('Input product ID')
                            ->readOnly(),

                        // Member ID input field
                        Forms\Components\TextInput::make('member_id')
                            ->label('Member ID')
                            ->placeholder('Input member ID')
                            ->readOnly(),

                        // Leader ID input field
                        Forms\Components\TextInput::make('leader_id')
                            ->label('Leader ID')
                            ->placeholder('Input leader ID')
                            ->readOnly(),

                        // Sponsor ID input field
                        Forms\Components\TextInput::make('sponsor_id')
                            ->label('Sponsor ID')
                            ->placeholder('Input sponsor ID')
                            ->readOnly(),

                        // No WA (WhatsApp number) input field
                        Forms\Components\TextInput::make('no_wa')
                            ->label('WhatsApp Number')
                            ->placeholder('Input WhatsApp number')
                            ->readOnly(),

                          // Price input field
                        Forms\Components\TextInput::make('price')
                            ->label('Price')
                            ->placeholder('Input price')
                            ->readOnly()
                            ->reactive()
                             ->disabled()
                             ->default(0) // Default value (0 or any other value)
                             ->formatStateUsing(function ($state) {
                                 // Format the state as Rupiah
                                 return 'Rp ' . number_format($state, 0, ',', '.');
                             }),

                         TextInput::make('komisi_referral')
                             ->label('Referral Commission')
                             ->placeholder('Input referral commission')
                             ->readOnly() // Make the field read-only
                             ->reactive()
                              ->disabled()
                             ->default(0) // Default value (0 or any other value)
                             ->formatStateUsing(function ($state) {
                                 // Format the state as Rupiah
                                 return 'Rp ' . number_format($state, 0, ',', '.');
                             }),

                         TextInput::make('komisi_sponsor')
                             ->label('Sponsor Commission')
                             ->placeholder('Input sponsor commission')
                             ->readOnly() // Make the field read-only
                             ->reactive()
                             ->disabled()
                             ->default(0) // Default value (0 or any other value)
                             ->formatStateUsing(function ($state) {
                                 // Format the state as Rupiah
                                 return 'Rp ' . number_format($state, 0, ',', '.');
                             }),

                         TextInput::make('komisi_leader')
                             ->label('Leader Commission')
                             ->placeholder('Input leader commission')
                             ->readOnly() // Make the field read-only
                             ->reactive()
                              ->disabled()
                             ->default(0) // Default value (0 or any other value)
                             ->formatStateUsing(function ($state) {
                                 // Format the state as Rupiah
                                 return 'Rp ' . number_format($state, 0, ',', '.');
                             }),

                        // Reward input field
                        Forms\Components\TextInput::make('reward')
                            ->label('Reward')
                            ->placeholder('Input reward')
                            ->readOnly(),


                        // Sender Name input field
                        Forms\Components\TextInput::make('sender_name')
                            ->label('Sender Name')
                            ->placeholder('Input sender name')
                            ->readOnly(),


                       Placeholder::make('Proof Image')
                           ->content(function ($record): HtmlString {
                               $imageUrl = $record->url_proof_image;
                               return new HtmlString("
                                   <a href='#' class='filament-button' onclick='openInNewTab(\"$imageUrl\")'>
                                       <img src='" . $imageUrl . "' alt='Image' width='200' />
                                   </a>

                                   <script>
                                       function openInNewTab(imageUrl) {
                                           window.open(imageUrl, '_blank');
                                       }
                                   </script>
                               ");
                           }),

                        // Status dropdown
                        Select::make('status')
                            ->label('Status')
                            ->placeholder('Select status')
                            ->options([
                               1 => 'Pending Payment',
                               2 => 'Waiting Confirmation',
                               3 => 'Paid',
                               4 => 'Cancel',
                            ])
                            ->required() // Make the dropdown field required
                            ->searchable() // Allow searching within the dropdown
                            ->default(1), // Optionally, set a default value
                    ])
            ]);
    }

    // Helper method to format values as Rupiah (without decimals)
    protected function formatRupiah($value)
    {
        // Remove any non-numeric characters except the decimal point
        $formatted = preg_replace('/\D/', '', $value); // Remove non-numeric characters

        // Format as Rupiah without decimals (rounding if necessary)
        return 'Rp ' . number_format($formatted, 0, ',', '.');
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product_name')->searchable(),
                Tables\Columns\TextColumn::make('transaction_code')->searchable(),
                Tables\Columns\TextColumn::make('transaction_date')->searchable(),
                Tables\Columns\TextColumn::make('product_id'),
                Tables\Columns\TextColumn::make('member_id'),
                Tables\Columns\TextColumn::make('leader_id'),
                Tables\Columns\TextColumn::make('sponsor_id'),
                Tables\Columns\TextColumn::make('no_wa'),

TextColumn::make('komisi_referral')
    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

TextColumn::make('komisi_leader')
    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

TextColumn::make('komisi_sponsor')
    ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                Tables\Columns\TextColumn::make('reward'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            1 => 'Pending Payment',
                            2 => 'Waiting Confirmation',
                            3 => 'Paid',
                            4 => 'Cancel',
                            default => 'Unknown',
                        };
                    })
                    ->color(function ($state) {
                        return match ($state) {
                            1 => 'primary',
                            2 => 'warning',
                            3 => 'success',
                            4 => 'danger',
                            default => 'black',
                        };
                    }),


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
            ])
            ->defaultSort('transaction_date', 'desc');
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
