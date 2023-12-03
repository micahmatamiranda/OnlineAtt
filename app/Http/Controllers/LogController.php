<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function index(){
        $user = Auth::user();
        $serverDT = Carbon::now();

        $google_id = $user->google_id;
        $date = $serverDT->toDateString();

        return view('dashboard', ['logs' => DB::table('logs')
                                                    ->where('google_id', '=', $google_id)
                                                    ->where('date', '=', $date)
                                                    ->get()]);
    }

    public function store(Request $request){
        $serverDT = Carbon::now();

        $date = $serverDT->toDateString();
        $time = $serverDT->toTimeString();

        $log                  = new Log;
        $log->google_id       = $request->google_id;
        $log->date            = $date;
        $log->time            = $time;
        $log->save();

        return redirect()->to('dashboard')->with('message', 'Your log has been saved.');
    }
}
