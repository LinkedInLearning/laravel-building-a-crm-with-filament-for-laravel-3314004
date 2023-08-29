<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use App\Models\Meeting;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{

    protected int|string|array $columnSpan = 'full';


    /**
     * Return events that should be rendered statically on calendar.
     */
    public function getViewData(): array
    {
        return [];
    }

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        return Meeting::whereBetween('start', [$fetchInfo['start'], $fetchInfo['end']])
            ->get()
            ->toArray();
    }

    public static function getCreateEventFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),

            Select::make('client_id')
                ->options(Client::select(DB::raw('CONCAT(first_name, " ", last_name, " - ", company) as name, id'))->get()->pluck('name', 'id')->toArray())
                ->label('Client')
                ->searchable(),

            Textarea::make('summary'),

            DateTimePicker::make('start')
                ->required(),

            DateTimePicker::make('end')
                ->after('start')
                ->required()
        ];
    }

    public function createEvent(array $data): void
    {
        Meeting::create($data);

        $this->refreshEvents();

        Notification::make()
            ->title('Meeting saved successfully')
            ->success()
            ->send();
    }

    public static function canCreate(): bool
    {
        // Returning 'false' will remove the 'Create' button on the calendar.
        return true;
    }

    public static function getEditEventFormSchema(): array
    {
        return [
            TextInput::make('title')->required(),

            Select::make('client_id')
                ->options(Client::select(DB::raw('CONCAT(first_name, " ", last_name, " - ", company) as name, id'))->get()->pluck('name', 'id')->toArray())
                ->label('Client')
                ->searchable(),

            Textarea::make('summary'),

            DateTimePicker::make('start')
                ->required(),

            DateTimePicker::make('end')
                ->after('start')
                ->required()
        ];

    }

    public function onEventClick($event): void
    {
        parent::onEventClick($event);

        $this->editEventFormState['client_id'] = $this->editEventFormState['extendedProps']['client_id'];
        $this->editEventFormState['summary'] = $this->editEventFormState['extendedProps']['summary'];
    }


    public function editEvent(array $data): void
    {

        if(Meeting::find($this->event_id)->update($data)){
            Notification::make()
                ->title('Meeting edited successfully')
                ->success()
                ->send();
        }

        $this->refreshEvents();
    }

    protected $listeners = [
        'deleteEvent' => 'onDeleteEvent'
    ];

    public function onDeleteEvent()
    {
        if(Meeting::destroy($this->event_id)){
            Notification::make()
                ->title('Meeting delete successfully')
                ->success()
                ->send();
        }

        $this->refreshEvents();
    }
}
