<?php

namespace App\Http\Controllers\Authenticated\Calendar\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\Admin\CalendarView;
use App\Calendars\Admin\CalendarSettingView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use Carbon\Carbon;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        $reserve = ReserveSettings::with('users');
        return view('authenticated.calendar.admin.calendar', compact('calendar'));
    }

    public function reserveDetail($date, $part){
        $reservePersons = ReserveSettings::with('users')->where('setting_reserve', $date)->where('setting_part', $part)->get();
$reserveDate = Carbon::parse($date)->format('Y年m月d日');
        return view('authenticated.calendar.admin.reserve_detail', compact('reservePersons', 'reserveDate', 'part'));
    }

    public function reserveSettings(){
        $calendar = new CalendarSettingView(time());
        return view('authenticated.calendar.admin.reserve_setting', compact('calendar'));
    }

    public function updateSettings(Request $request){
        $reserveDays = $request->input('reserve_day');
        foreach($reserveDays as $day => $parts){
            foreach($parts as $part => $frame){
                ReserveSettings::updateOrCreate([
                    'setting_reserve' => $day,
                    'setting_part' => $part,
                ],[
                    'setting_reserve' => $day,
                    'setting_part' => $part,
                    'limit_users' => $frame,
                ]);
            }
        }
        return redirect()->route('calendar.admin.setting', ['user_id' => Auth::id()]);
    }
}
