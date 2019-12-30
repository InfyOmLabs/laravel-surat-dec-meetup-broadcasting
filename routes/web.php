<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (\Illuminate\Http\Request $request) {

    $sessionId = Session::getId();

    $visitor = \App\Visitor::whereSessionId($sessionId)->first();

    if (empty($visitor)) {
        $visitor = new \App\Visitor([
            'session_id' => $sessionId,
            'browser' => Browser::browserName(),
            'ip' => $request->ip(),
            'session_start_time' => \Carbon\Carbon::now(),
        ]);

        $visitor->save();

        $totalVisitors = \App\Visitor::count();

        \App\Events\VisitorsUpdated::dispatch($totalVisitors);

        return view('welcome' , [
            'totalVisitors' => $totalVisitors
        ]);
    }

    return view('welcome' , [
        'activeVisitors' => \App\Visitor::active()->count(),
        'totalVisitors' => \App\Visitor::count()
    ]);
});
