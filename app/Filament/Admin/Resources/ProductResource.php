<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-s-shopping-bag';

   public static function form(Form $form): Form
   {
       return $form
           ->schema([
               // Card
               Forms\Components\Card::make()
                   ->schema([
                       // Image upload field
                       Forms\Components\FileUpload::make('url_image')
                           ->label('Image')
                           ->directory('uploads/images') // Specify the directory for image uploads
                           ->image() // Enables image-specific handling and preview
                           ->required(),

                       // Name input field
                       Forms\Components\TextInput::make('name')
                           ->label('Product Name')
                           ->placeholder('Input product name')
                           ->required(),

                       // Price input field
                       Forms\Components\TextInput::make('price')
                           ->label('Price')
                           ->placeholder('Input price')
                           ->required(),

                         // Price input field
                          Forms\Components\TextInput::make('komisi_referral')
                              ->label('Referral Fee')
                              ->placeholder('Input Referral Fee')
                              ->required(),

                           // Price input field
                           Forms\Components\TextInput::make('komisi_sponsor')
                               ->label('Sponsor Fee')
                               ->placeholder('Input Sponsor Fee')
                               ->required(),

                          // Price input field
                         Forms\Components\TextInput::make('komisi_leader')
                             ->label('Leader Fee')
                             ->placeholder('Input Leader Fee')
                             ->required(),

                         // Price input field
                          Forms\Components\TextInput::make('reward')
                              ->label('Reward')
                              ->placeholder('Input Reward')
                              ->required(),


                       // Product description as a rich text editor
                       Forms\Components\RichEditor::make('description')
                           ->label('Description')
                           ->placeholder('Input detailed product description')
                           ->required(),

                       // Owner dropdown
                       Forms\Components\Select::make('owners_id')
                           ->label('Owner')
                           ->placeholder('Select Owner')
                           ->options(
                               Owner::query()
                                   ->pluck('name', 'id')
                                   ->toArray()
                           )
                           ->searchable()
                           ->required(),
                   ])
           ]);
   }


  public static function table(Table $table): Table
  {
      return $table
          ->columns([
              // Image column
              Tables\Columns\ImageColumn::make('url_image')
                  ->label('Image') // Optional: Set the column label
                  ->width(50) // Set the width of the image
                  ->height(50) // Set the height of the image
                  ->rounded() // Optional: Make the image rounded
                  ->disk('public') // Specifies the disk for retrieving the image
                  ->searchable(),

              // Text column for name
              Tables\Columns\TextColumn::make('name')
                  ->width(50)
                  ->searchable(),

              // Text column for price
              Tables\Columns\TextColumn::make('price')
                  ->width(50)
                  ->searchable(),

//               // Text column for description
//               Tables\Columns\TextColumn::make('description')
//                   ->width(50)
//                   ->html() // Ensure content is rendered as HTML
//                   ->limit(50),

              // Creator's name column
              Tables\Columns\TextColumn::make('creator.name')
                  ->label('Created By')
                  ->sortable()
                  ->width(50)
                  ->searchable()
                  ->default('System'),

              // Updater's name column
              Tables\Columns\TextColumn::make('updater.name')
                  ->label('Updated By')
                  ->sortable()
                  ->width(50)
                  ->searchable()
                  ->default('System'),

              // Created at column
              Tables\Columns\TextColumn::make('created_at')
                  ->width(50),

              // Updated at column
              Tables\Columns\TextColumn::make('update_at')
                  ->width(50),

          ])
          ->filters([
              // Add filters here if needed
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getNavigationSort(): ?int
        {
            return 3;
        }
}
