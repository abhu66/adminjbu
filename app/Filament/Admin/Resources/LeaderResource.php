<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LeaderResource\Pages;
use App\Filament\Admin\Resources\LeaderResource\RelationManagers;
use App\Models\Leader;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\User; // Import the User model

use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;

class LeaderResource extends Resource
{
    protected static ?string $model = Leader::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
              //card
              Forms\Components\Card::make()
                  ->schema([
                    Placeholder::make('Profile Image')
                       ->content(function ($record): HtmlString {
                           $imageUrl = $record->image;
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

                   Forms\Components\FileUpload::make('image')
                       ->label('Change Image')
                       ->directory('uploads/images') // Specify the directory for image uploads
                       ->image(),
                        // Make the image upload optional// Enables image-specific handling and preview


                      //name
                      Forms\Components\TextInput::make('name')
                        ->label('Leader Name')
                        ->placeholder('Leader Name')
                        ->required(),

                      //phone Number
                      Forms\Components\TextInput::make('phone_number')
                        ->label('Phone Number')
                        ->placeholder('Phone Number')
                        ->required(),

                      //phone Number
                      Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->placeholder('Email')
                        ->required(),

                      //phone Number
                      Forms\Components\TextInput::make('no_rekening')
                        ->label('Account Number')
                        ->placeholder('Account number')
                        ->required(),

                       //phone Number
                        Forms\Components\TextInput::make('nama_bank')
                          ->label('Bank Name')
                          ->placeholder('Nama Bank')
                          ->required(),


                       //phone Number
                       Forms\Components\TextInput::make('nama_rekening')
                         ->label('Account Name')
                         ->placeholder('Account name')
                         ->required(),

                       //phone Number
                       Forms\Components\TextInput::make('address')
                         ->label('Address')
                         ->placeholder('Alamat')
                         ->required(),

                     // Leader dropdown
                     Forms\Components\Select::make('owner_id')
                         ->label('Owner')
                         ->placeholder('Select Owner')
                         ->options(
                             Owner::query()
                                 ->pluck('name', 'id')
                                 ->toArray()
                         )
                         ->searchable()
                         ->required(),
//phone Number
                     // Display Created By (Creator Name) only in Edit mode, not when creating
                 Forms\Components\TextInput::make('created_by')
                     ->label('Created By')
                     ->disabled() // Read-only
                     ->default(function ($get) {
                         $record = $get('record');
                         return $record && $record->creator ? $record->creator->name : 'System';
                     }),

                 // Display Updated By (Updater Name) only in Edit mode, not when creating
                 Forms\Components\TextInput::make('updated_by')
                     ->label('Updated By')
                     ->disabled() // Read-only
                     ->default(function ($get) {
                         $record = $get('record');
                         return $record && $record->updater ? $record->updater->name : 'System';
                     }),
                  ])
            ]);
    }

    public static function table(Table $table): Table
    {
       return $table
               ->columns([

                // Image column
               Tables\Columns\ImageColumn::make('image')
                   ->label('Image') // Optional: Set the column label
                   ->width(50) // Set the width of the image
                   ->height(50) // Set the height of the image
                   ->rounded() // Optional: Make the image rounded
                   ->searchable(),
                   Tables\Columns\TextColumn::make('name')->searchable(),
                   Tables\Columns\TextColumn::make('phone_number'),
                   Tables\Columns\TextColumn::make('no_rekening')
                    ->label('Account Number'),

                   Tables\Columns\TextColumn::make('nama_bank')
                    ->label('Bank Name'),
                   Tables\Columns\TextColumn::make('nama_rekening')
                    ->label('Account Name'),
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
            'index' => Pages\ListLeaders::route('/'),
            'create' => Pages\CreateLeader::route('/create'),
            'edit' => Pages\EditLeader::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
        {
            return 1;
        }
}
