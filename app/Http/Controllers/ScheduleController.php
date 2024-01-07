<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commerce;
use App\Models\Day;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $commerce = Commerce::where('user_id', Auth::user()->id)->first();
        if (!$commerce) {
            return redirect()->route('commerce.myCommerce');
        }

        $mySchedule = Schedule::with('day')->where('commerce_id', $commerce->id)->get();
        $days = Day::all();

        $filteredDays = $days->filter(function ($day) use ($mySchedule) {
            return !$mySchedule->contains('day_id', $day->id);
        });

        $days = $filteredDays;

        return view('app.schedules.index', compact('mySchedule', 'days'));
    }

    public function update(Request $request)
    {
        $commerce_id = Auth::user()->commerce->id;
        $schedules = json_decode($request->schedule);
        $request->merge(['schedules' => $schedules, 'commerce_id' => $commerce_id]);

        $this->validate(
            $request,
            [
                'schedules' => 'required|array|min:1',
            ],
            [
                'schedules.required' => 'Debe seleccionar al menos un día.',
            ]
        );

        Schedule::where('commerce_id', $commerce_id)->delete();

        foreach ($schedules as $schedule) {
            Schedule::Create([
                'commerce_id' => $commerce_id,
                'day_id' => $schedule->day_id,
                'open' => $schedule->open,
                'close' => $schedule->close,
            ]);
        }

        return redirect()->route('commerce.schedule.index');
    }
}
