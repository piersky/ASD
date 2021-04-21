<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Auth;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parents = DB::table('parents', 'p')
            ->leftJoin('parents AS partner', 'partner.id', '=', 'p.partner_id')
            ->select(
                'p.*',
                'partner.firstname AS partner_firstname',
                'partner.lastname AS partner_lastname')
            ->orderByDesc('p.is_active')
            ->orderBy('p.lastname')
            ->orderBy('p.firstname')
            ->paginate(50);

        return view('parents.parents', [
            'parents' => $parents
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent = new Parents();

        return view('parents.createparent', [
            'parent' => $parent
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname'=> 'required',
            'address' => 'required'
        ]);

        $parent = new Parents();
        $parent->firstname = $request->input('firstname');
        $parent->lastname = $request->input('lastname');
        $parent->gender = $request->input('gender');
        $parent->mobile = $request->input('mobile');
        $parent->phone = $request->input('phone');
        $parent->conjugality = $request->input('conjugality');
        $parent->email = $request->input('email');
        $parent->fiscal_code = $request->input('fiscal_code');
        $parent->address = $request->input('address');
        $parent->municipality = $request->input('municipality');
        $parent->postal_code = $request->input('postal_code');
        $parent->province = $request->input('province');
        $parent->country = $request->input('country');
        $parent->wants_tax_certificate = ($request->input('wants_tax_certificate')=='on'?1:0);
        $parent->is_active = ($request->input('is_active')=='on'?1:0);
        $parent->partner_id = $request->input('partner_id');
        $parent->created_by = Auth::user()->id;
        $parent->updated_by = Auth::user()->id;

        $parent->save();

        return redirect('/parents')->with('success', 'Parent saved!');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
