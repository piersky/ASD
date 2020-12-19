<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $last_payment = DB::table('payments')
            ->join('athletes', 'payments.athlete_id', '=', 'athletes.id')
            ->select(
                'payment_date',
                'amount',
                'athletes.firstname',
                'athletes.lastname')
            ->orderByDesc('payment_date')
            ->limit(1)
            ->get();

        $total_athletes = DB::table('athletes')
            ->where('is_active', '=', '1')
            ->get();

        return view('home', ['last_payment' => $last_payment, 'total_athletes' => count($total_athletes)]);
    }
}
