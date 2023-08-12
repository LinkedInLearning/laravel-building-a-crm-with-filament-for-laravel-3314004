<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Infolists\Components\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([

            Tabs::make('Label')
                ->tabs([
                    Tabs\Tab::make('Personal info')
                        ->schema([
                            TextEntry::make('first_name')
                                ->label('Name')
                                ->formatStateUsing(fn(string $state, $record): string => $record->first_name . " " . $record->last_name),

                            TextEntry::make('phone'),
                            TextEntry::make('mobile'),

                            TextEntry::make('email')
                                ->copyable(),

                            ImageEntry::make('photo'),
                            TextEntry::make('linkedin')
                                ->suffixAction(
                                    Action::make('openLinkedin')
                                        ->icon('heroicon-m-clipboard')
                                        ->url(fn($record) => $record->linkedin)
                                ),

                            TextEntry::make('active')
                                ->badge()
                                ->color(fn(bool $state): string => match ($state) {
                                    false => 'gray',
                                    true => 'success'
                                })
                        ]),
                    Tabs\Tab::make('Business info')
                        ->schema([
                            TextEntry::make('company'),
                            TextEntry::make('title'),
                            TextEntry::make('role'),
                            TextEntry::make('company_website'),
                            TextEntry::make('business_details'),
                            TextEntry::make('business_type'),
                            TextEntry::make('company_size'),
                            TextEntry::make('company_size'),
                            TextEntry::make('temperature'),

                        ]),
                    Tabs\Tab::make('Notes')
                        ->schema([
                            TextEntry::make('notes'),
                            TextEntry::make('referrals'),

                        ]),
                ])->columnSpanFull()


        ]);
    }

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
                                    ->required()
//                                    ->visibleOn('edit'),
                                    ->visible(fn($operation) => $operation === 'edit'),
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
                            ])
                                ->disabledOn('create')
                            ,
                        ])->columnSpan(2)

                        ,

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
                Tables\Actions\ViewAction::make(),
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
            'view' => Pages\ViewClient::route('/{record}')
        ];
    }
}
