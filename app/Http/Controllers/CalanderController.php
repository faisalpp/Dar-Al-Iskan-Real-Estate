<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Enums\EventStatus;
use Carbon\Carbon;

class CalanderController extends Controller
{
    public function GenerateEvents(){
        $startDate = Carbon::now();
        $endDate = $startDate->add(1,'day');
        $calendar = Calendar::create()
        ->name('Dar Al-Iskan Events Calander')
        ->description('This Calander Shows Events from Dar Al-Iskan Dashboard.')
        ->refreshInterval(120);
        $event = Event::create()->name('Demo Event')->description('This is a Demo Event')->status(EventStatus::confirmed())->startsAt($startDate)->endsAt($endDate);
        $calendar->event($event);

    $calendarContent = $calendar->get();

    $filePath = public_path('calendar.ics');
    // $request->file('file')->move($storagePath, $imageName);
    // Save the calendar content to the public folder
    file_put_contents($filePath, $calendarContent);

    // Optionally, you can also return the file path or a download link
    // return response()->download($filePath, 'calendar.ics', ['Content-Type' => 'text/calendar']);
    // Set the Content-Type header explicitly
    return response()->download($filePath, 'calendar.ics', [
        'Content-Type' => 'text/calendar',
        'Content-Disposition' => 'attachment; filename=calendar.ics',
    ]);
 }
}
