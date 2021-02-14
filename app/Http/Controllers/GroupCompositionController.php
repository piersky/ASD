<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Group;
use App\Models\GroupComposition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class GroupCompositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $groupCompositions = DB::table('group_compositions')
            ->join('athletes', 'group_compositions.athlete_id', '=', 'athletes.id')
            ->select(
                'group_compositions.id',
                'athletes.lastname',
                'athletes.firstname',
                'athletes.id AS athlete_id'
            )
            ->where([
                ['group_compositions.group_id','=', $id],
                ['group_compositions.is_active', '=', '1']
            ])
            ->orderBy('athletes.lastname')
            ->orderBy('athletes.firstname')
            ->get();

        $group = DB::table('groups')
            ->leftJoin('group_translations', 'group_translations.group_id', '=', 'groups.id')
            ->select('groups.id', 'group_translations.name')
            ->where('groups.id', '=', $id)
            //TODO: Use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->first();

        $total_payed = [];
        $total_group_payed = 0.0;
        foreach ($groupCompositions as $group_athlete){
            $total_athlete_payed = DB::table('payments', 'p')
                //TODO: use settings
                ->where('year', '=', '2020')
                ->where('athlete_id', '=', $group_athlete->athlete_id)
                ->sum('p.amount');

            $total_payed[$group_athlete->athlete_id] = $total_athlete_payed;
            $total_group_payed += $total_athlete_payed;
        }

        return view('groups.composition.components', [
            'groupcompositions' => $groupCompositions,
            'group' => $group,
            'total_payed' => $total_payed,
            'total_group_payed' => $total_group_payed
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $groupcomponent = new GroupComposition();

        $group = DB::table('groups')
            ->leftJoin('group_translations', 'group_translations.group_id', '=', 'groups.id')
            ->select('groups.id', 'group_translations.name')
            ->where('groups.id', '=', $id)
            //TODO: Use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->first();

        $athletes = DB::table('athletes')
            ->select(
                'firstname',
                'lastname',
                'id as athlete_id')
            ->whereNotIn('id', function($query){
                $query->select('athlete_id')->from('group_compositions');
            })
            //->where('is_active', '=', 1)
            ->orderBy('lastname')
            ->get();

        $groupcompositions = DB::table('group_compositions')
            ->join('athletes', 'group_compositions.athlete_id', '=', 'athletes.id')
            ->select(
                'group_compositions.id',
                'athletes.lastname',
                'athletes.firstname',
                'athletes.id AS athlete_id'
            )
            ->where([
                ['group_compositions.group_id','=', $id],
                ['group_compositions.is_active', '=', '1']
            ])
            ->orderBy('athletes.lastname')
            ->orderBy('athletes.firstname')
            ->get();

        return view('groups.composition.add', [
            'groupcomponent' => $groupcomponent,
            'group' => $group,
            'athletes' => $athletes,
            'groupcompositions' => $groupcompositions
        ]);
    }

    public function add( Request $request, $id) {
        $groupcomponent = new GroupComposition();

        //TODO: choose year from settings
        $groupcomponent->year = '2020';
        $groupcomponent->athlete_id = $request->input('athlete_id');
        $groupcomponent->group_id = $id;
        $groupcomponent->created_by = Auth::user()->id;
        $groupcomponent->updated_by = Auth::user()->id;

        $groupcomponent->save();

        $groupCompositions = DB::table('group_compositions')
            ->join('athletes', 'group_compositions.athlete_id', '=', 'athletes.id')
            ->select(
                'group_compositions.id',
                'athletes.lastname',
                'athletes.firstname',
                'athletes.id AS athlete_id')
            ->where([
                ['group_compositions.group_id','=', $id],
                ['group_compositions.is_active', '=', '1']
            ])
            ->orderBy('athletes.lastname')
            ->orderBy('athletes.firstname')
            ->get();

        $group = DB::table('groups')
            ->join('group_translations', 'group_translations.group_id', '=', 'groups.id')
            ->select('groups.id', 'group_translations.name')
            ->where('groups.id', '=', $id)
            //TODO: Use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->first();

        return view('groups.composition.components', [
            'groupcompositions' => $groupCompositions,
            'group' => $group
        ])->with('success', 'Componente aggiunto');
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
        $component = GroupComposition::find($id);
        $group_id = $component->group_id;

        $result = $component->delete();

        $groupCompositions = DB::table('group_compositions')
            ->join('athletes', 'group_compositions.athlete_id', '=', 'athletes.id')
            ->where([
                ['group_compositions.group_id','=', $group_id],
                ['group_compositions.is_active', '=', '1']
            ])
            ->select('group_compositions.id', 'athletes.lastname', 'athletes.firstname')
            ->orderBy('athletes.lastname')
            ->orderBy('athletes.firstname')
            ->get();

        $group = Group::find($group_id);

        if (request()->ajax()) return '' . $result;
        else return view('groups.composition.components', [
            'groupcompositions' => $groupCompositions,
            'group' => $group])
            ->with('success', 'Athlete removed from group');
    }
}
