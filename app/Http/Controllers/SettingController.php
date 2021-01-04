<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keys = Setting::all();

        return view('settings.index', ['keys' => $keys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    private function getKeys(){
        $sets = DB::table('settings')
            ->get();

        $keys = [];

        foreach ($sets as $set){
            $keys[$set->key] = $set->value;
        }

        return $keys;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $keys = $this->getKeys();

        $user_id = Auth::user()->id;

        return view('settings.edit', ['keys' => $keys, 'user_id' => $user_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $keys = $this->getKeys();

        if ($request->year != $keys['year']) {
            $keys['year'] = $request->year;
        }

        if ($request->lang_id != $keys['lang_id']) {
            $keys['lang_id'] = $request->lang_id;
        }

        if ($request->payment_day_month != $keys['payment_day_month']) {
            $keys['payment_day_month'] = $request->payment_day_month;
        }

        if ($request->send_email_on_new_payment != $keys['send_email_on_new_payment']) {
            $keys['send_email_on_new_payment'] = $request->send_email_on_new_payment;
        }

        return redirect('/settings')->with('message', 'Settings updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
