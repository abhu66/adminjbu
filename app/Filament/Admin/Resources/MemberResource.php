<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MemberResource\Pages;
use App\Filament\Admin\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use App\Models\Leader;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

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

                         //name
                         Forms\Components\TextInput::make('name')
                           ->label('Member Name')
                           ->placeholder('Input member name')
                           ->readOnly()
                           ->required(),

                         //name
                     Forms\Components\TextInput::make('phone_number')
                       ->label('Phone Number')
                       ->placeholder('Input phone number')
                       ->readOnly()
                       ->required(),

                         //phone Number
                         Forms\Components\TextInput::make('email')
                           ->label('Email')
                           ->placeholder('Input email')
                            ->readOnly()
                            ->required(),


                         //phone Number
                   Forms\Components\TextInput::make('no_rekening')
                     ->label('Account Number')
                     ->placeholder('Account number')
                      ->readOnly()
                      ->required(),

                    //phone Number
                     Forms\Components\TextInput::make('nama_bank')
                       ->label('Bank Name')
                       ->placeholder('Nama Bank')
                        ->readOnly()
                         ->required(),


                    //phone Number
                    Forms\Components\TextInput::make('nama_rekening')
                      ->label('Account Name')
                      ->placeholder('Account name')
                       ->readOnly()
                      ->required(),

                    //phone Number
                    Forms\Components\TextInput::make('address')
                      ->label('Address')
                      ->placeholder('Alamat')
                      ->readOnly()
                     ->required(),

                     // Leader dropdown
                    Forms\Components\Select::make('sponsor_id')
                        ->label('Sponsor')
                        ->placeholder('Select Sponsor')
                        ->options(
                            Member::query()
                                ->pluck('name', 'id')
                                ->toArray()
                        )
                        ->searchable()
                         ->disabled()

                        ->required(),


                     // Leader dropdown
                    Forms\Components\Select::make('leader_id')
                        ->label('Leader')
                        ->placeholder('Select Leader')
                        ->options(
                            Leader::query()
                                ->pluck('name', 'id')
                                ->toArray()
                        )
                        ->searchable()
                         ->disabled()
                         ->required(),

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
                Tables\Columns\TextColumn::make('email'),
                 // Display the leader's name instead of leader_id
                Tables\Columns\TextColumn::make('sponsor.name')
                    ->label('Sponsor')
                    ->sortable()
                    ->searchable(),

                // Display the leader's name instead of leader_id
                 Tables\Columns\TextColumn::make('leader.name')
                     ->label('Leader')
                     ->sortable()
                     ->searchable(),

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
            ->filters([])
            ->actions([
//                 Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
        {
            return 2;
        }
}
