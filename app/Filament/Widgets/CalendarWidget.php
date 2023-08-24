<?php

namespace App\Filament\Widgets;

use App\Models\Meeting;
use Filament\Widgets\Widget;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{

    protected int | string | array $columnSpan = 'full';


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
        return Meeting::whereBetween('start',[$fetchInfo['start'],$fetchInfo['end']])
            ->get()
            ->toArray();
    }
}
