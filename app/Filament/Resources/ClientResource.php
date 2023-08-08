<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make([
                    'md' => 3,
                ])
                    ->schema([
                        Forms\Components\Section::make()->schema([
                            Forms\Components\Section::make('Personal info')->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->required()
                                    ->string()
                                    ->minLength(2)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('last_name')
                                    ->required()
                                    ->string()
                                    ->minLength(2)
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('email')
                                    ->email()
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('phone')
                                    ->tel()
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('mobile')
                                    ->maxLength(255),

                                Forms\Components\FileUpload::make('photo')
                                    ->image()
                                    ->maxSize(1024),

                                Forms\Components\TextInput::make('linkedin')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),

                                Forms\Components\Toggle::make('active')
                                    ->required(),
                            ]),

                            Forms\Components\Section::make('Business info')->schema([
                                Forms\Components\TextInput::make('title')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('company')
                                    ->maxLength(255),
                                Forms\Components\TextInput::make('role')
                                    ->maxLength(255),

                                Forms\Components\TextInput::make('company_website')
                                    ->maxLength(255),
                                Forms\Components\Textarea::make('business_details')
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                                Forms\Components\TextInput::make('business_type')
                                    ->maxLength(255),
                                
                                Forms\Components\Select::make('company_size')->options([
                                    'small', 'medium', 'big'
                                ]),

                                Forms\Components\Select::make('temperature')
                                    ->options([
                                        'cold', 'medium', 'hot'
                                    ]),
                            ]),
                        ])->columnSpan(2),

                        Forms\Components\Section::make()->schema([
                            Forms\Components\Textarea::make('notes')
                                ->maxLength(65535)
                            ,

                            Forms\Components\Textarea::make('referrals')
                                ->maxLength(65535)
                                ->columnSpanFull(),
                        ])
                            ->columnSpan(1),

                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_website')
                    ->searchable(),
                Tables\Columns\TextColumn::make('business_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_size')
                    ->searchable(),
                Tables\Columns\TextColumn::make('temperature')
                    ->searchable(),
                Tables\Columns\TextColumn::make('photo')
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
