<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Models\Address;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->columns(2)->schema([
                    TextInput::make('two_columns_1')
                        ->label('2 columns')
                        ->string(),
                    TextInput::make('two_columns_2')
                        ->label('2 columns')
                        ->string(),
                ]),
                Grid::make()->columns(3)->schema([
                    TextInput::make('three_columns_1')
                        ->label('3 columns')
                        ->string(),
                    TextInput::make('three_columns_2')
                        ->label('3 columns')
                        ->string(),
                    TextInput::make('three_columns_3')
                        ->label('3 columns')
                        ->string(),
                ]),
                Grid::make()->columns(6)->schema([
                    TextInput::make('six_columns_1')
                        ->label('6 columns')
                        ->string(),
                    TextInput::make('six_columns_2')
                        ->label('6 columns')
                        ->string(),
                    TextInput::make('six_columns_3')
                        ->label('6 columns')
                        ->string(),
                    TextInput::make('six_columns_4')
                        ->label('6 columns')
                        ->string(),
                    TextInput::make('six_columns_5')
                        ->label('6 columns')
                        ->string(),
                    TextInput::make('six_columns_6')
                        ->label('6 columns')
                        ->string(),
                ]),
                Grid::make()->columns(12)->schema([
                    TextInput::make('twelve_columns_1')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_2')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_3')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_4')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_4')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_5')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_6')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_7')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_8')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_9')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_10')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_11')
                        ->label('12 columns')
                        ->string(),
                    TextInput::make('twelve_columns_12')
                        ->label('12 columns - column span 12')
                        ->string()
                        ->columnSpan('full'),
                ]),


                Fieldset::make('Fieldset with 2 columns')
                    ->schema([
                        TextInput::make('fieldset_input_1')
                            ->label('Fieldset input')
                            ->string(),
                        TextInput::make('fieldset_input_2')
                            ->label('Fieldset input')
                            ->string(),
                    ])->columns(3),

                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Tab 1')
                            ->schema([
                                TextInput::make('tab_1_input_1')
                                    ->label('Tab 1 input 1')
                                    ->string(),
                                TextInput::make('tab_1_input_2')
                                    ->label('Tab 1 input 2')
                                    ->string(),
                            ]),
                        Tab::make('Tab 2')
                            ->schema([
                                TextInput::make('tab_2_input_1')
                                    ->label('Tab 2 input 1')
                                    ->string(),
                                TextInput::make('tab_2_input_2')
                                    ->label('Tab 2 input 2')
                                    ->string(),
                            ]),
                        Tab::make('Tab 3')
                            ->schema([
                                TextInput::make('tab_3_input_1')
                                    ->label('Tab 3 input 1')
                                    ->string(),
                                TextInput::make('tab_3_input_1')
                                    ->label('Tab 3 input 2')
                                    ->string(),
                            ]),
                    ])->columnSpan(2),

                Wizard::make([
                    Step::make('Order')
                        ->schema([
                            TextInput::make('name')
                                ->label('Name')
                                ->string(),
                            TextInput::make('email')
                                ->label('Email')
                                ->string(),
                        ]),
                    Step::make('Delivery')
                        ->schema([
                            TextInput::make('address')
                                ->label('Address')
                                ->string(),
                            TextInput::make('country')
                                ->label('Country')
                                ->string(),
                        ]),
                    Step::make('Billing')
                        ->schema([
                            TextInput::make('card_name')
                                ->label('Card Name')
                                ->string(),
                            TextInput::make('card_number')
                                ->label('Card number')
                                ->string(),
                        ]),
                ])->columnSpan(2),

                Section::make('Section Heading')
                    ->description('Section Description')
                    ->schema([
                        TextInput::make('section_name')
                            ->label('Section name')
                            ->string(),
                        TextInput::make('section_address')
                            ->label('Section address')
                            ->string(),
                    ]),
                Section::make()
                    ->schema([
                        TextInput::make('card_input')
                            ->label('Section without header')
                            ->string()
                    ]),
                Placeholder::make('Placeholder Label')
                    ->content('Content, displayed underneath the label'),

        /*
                 Forms\Components\TextInput::make('city_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('client_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('street')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('zip')
                    ->required()
                    ->maxLength(255),

        */    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('city_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('street')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zip')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
