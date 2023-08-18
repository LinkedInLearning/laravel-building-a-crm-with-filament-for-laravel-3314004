<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Client edited')
            ->body('An client was edited')
            ->duration(9000)
            ->info()
            ->color('info')
            ->actions([
                Action::make('View')
                ->button()
                ->url(fn() => ClientResource::getUrl('view', ['record' => $this->getRecord()]))
            ])
        ;
    }
}
