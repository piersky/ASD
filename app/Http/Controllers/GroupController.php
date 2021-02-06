<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupTranslation;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = DB::table('groups')
            ->join('group_translations', 'groups.id', '=', 'group_translations.group_id')
            ->select(['groups.id', 'group_translations.name'])
            ->where('groups.is_active', '=', 1)
            //TODO: Use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->orderBy('group_translations.name')
            ->get();

        for ($i = 0; $i < count($groups); $i++) {
            $n = DB::table('group_compositions')
                ->where('group_id', '=', $groups[$i]->id)
                ->get();

            $groups[$i]->total = count($n)>0?count($n):0;
        }

        return view('groups.groups', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group = new Group();

        return view('groups.creategroup', ['group' => $group]);
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
            'name' => 'required'
        ]);

        $group = new Group([
            'is_active' => ($request->input('is_active')=='on'?true:false),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ]);

        $group->save();

        $group_translation = new GroupTranslation([
            'group_id' => $group->id,
            'name' => $request->input('name'),
            'lang_id' => 'it',//env('APP_LOCAL', 'en'),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ]);

        $group_translation->save();

        return redirect('groups')->with('success', 'Group inserted: '.$group->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = DB::table('groups')
            ->join('group_translations', 'groups.id', '=', 'group_translations.group_id')
            ->select(['groups.id', 'group_translations.name', 'groups.is_active'])
            ->where('groups.id', '=', $id)
            ->get();

        return view('groups.show', ['group' => $group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = DB::table('groups')
            ->join('group_translations', 'groups.id', '=', 'group_translations.group_id')
            ->select(['groups.id', 'group_translations.name', 'groups.is_active'])
            ->where('groups.id', '=', $id)
            //TODO: use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->get();

        return view('groups.editgroup', ['group' => $group]);
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
        $group = Group::find($id);
        $group->is_active = $request->get('is_active')?true:false;
        $group->updated_by = Auth::user()->id;

        $group->save();

        DB::table('group_translations')
            ->where('group_id', '=', $id)
            //TODO: use settings instead
            ->where('lang_id', '=', 'it')
            ->update([
                'name' => $request->get('name'),
                'updated_by' => Auth::user()->id
            ]);

        return redirect('/groups')->with('success', 'Groups updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('group_translations')
            ->where('group_id', '=', $id)
            //TODO: use settings instead
            ->where('lang_id', '=', 'it')
            ->delete();

        $group = Group::find($id);
        $result = $group->delete();

        if (request()->ajax()) return '' . $result;
        else return redirect('/groups')->with('success', 'Group deleted');
    }

    public function composition($id)
    {
        $group = Group::find($id);

        return view('groups.composition.components', ['group'=> $group]);
    }

    public function payments($id)
    {
        list($athletes, $payments, $group) = $this->paymentsCalculator($id);

        return view('groups.payments', [
            'athletes' => $athletes,
            'group' => $group,
            'payments' => $payments
        ]);
    }

    public function paymentsPDF($id)
    {
        list($athletes, $payments, $group) = $this->paymentsCalculator($id);

        view()->share([
            'athletes' => $athletes,
            'group_name' => $group->name,
            'payments' => $payments
        ]);

        $pdf = PDF::loadView('groups.paymentsPDF', [
            'athletes' => $athletes,
            'group_name' => $group->name,
            'payments' => $payments
        ]);

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('payments_'.$group->name.'.pdf');
    }

    public function pdf($id)
    {
        $groupcomponents = DB::table('group_compositions AS g')
            ->join('athletes AS a', 'g.athlete_id', '=', 'a.id')
            ->select(
                'g.id',
                'a.*',
                'a.id AS athlete_id'
            )
            ->where([
                ['g.group_id','=', $id],
                ['g.is_active', '=', '1']
            ])
            ->orderBy('a.lastname')
            ->orderBy('a.firstname')
            ->get();

        $group = DB::table('groups AS g')
            ->leftJoin('group_translations AS gt', 'gt.group_id', '=', 'g.id')
            ->select('g.id', 'gt.name')
            ->where('g.id', '=', $id)
            //TODO: Use settings instead
            ->where('gt.lang_id', '=', 'it')
            ->first();

        $pdf = PDF::loadView('groups.pdf', [
            'group_name' => $group->name,
            'groupcomponents' => $groupcomponents
        ]);

        $pdf->setPaper('A4', 'portrait');

        //return view('groups.pdf', ['group_name' => $group->name, 'groupcomponents' => $groupcomponents]);
        return $pdf->download('group_'.$group->name.'.pdf');
    }

    /**
     * @param $id
     * @return array
     */
    public function paymentsCalculator($id): array
    {
        $periods = [
            'Enrollment',
            '1st_fee',
            '2nd_fee',
            '3rd_fee',
            '4th_fee',
            '5th_fee',
            '6th_fee',
            '7th_fee',
            '8th_fee',
            '9th_fee',
            '10th_fee',
            '11th_fee',
            '12th_fee'
        ];

        $athletes = DB::table('group_compositions')
            ->join('athletes', 'group_compositions.athlete_id', '=', 'athletes.id')
            ->where([
                ['group_compositions.group_id', '=', $id],
                ['group_compositions.is_active', '=', '1']
            ])
            ->select(
                'group_compositions.id',
                'athletes.lastname',
                'athletes.firstname',
                'athletes.id as athlete_id'
            )
            ->orderBy('athletes.lastname')
            ->orderBy('athletes.firstname')
            ->get();

        if (count($athletes) > 0) {
            for ($i = 0; $i < count($athletes); $i++) {
                $payments = DB::table('payments')
                    ->select(
                        'payment_date',
                        'amount',
                        'period',
                        'method',
                        'id'
                    )
                    ->where('athlete_id', '=', $athletes[$i]->athlete_id)
                    ->orderBy('period')
                    ->get();

                $period_payments = array();
                $total = 0.0;
                if (count($payments) > 0) {
                    $j = 0;
                    for ($k = 0; $k < count($periods); $k++) {
                        if ($j < count($payments)) {
                            if ($payments[$j]->period == $periods[$k]) {
                                $period_payments[$k] = [
                                    'amount' => $payments[$j]->amount,
                                    'date' => $payments[$j]->payment_date,
                                    'id' => $payments[$j]->id,
                                    'method' => $payments[$j]->method
                                ];
                                $total += floatval($payments[$j]->amount);
                                $j++;
                            } else {
                                $period_payments[$k] = 0;
                            }
                        } else {
                            $period_payments[$k] = 0;
                        }
                    }
                } else {
                    for ($k = 0; $k < count($periods); $k++) {
                        $period_payments[$k] = 0;
                    }
                }
                $athletes[$i]->period_payments = $period_payments;
                $athletes[$i]->total = $total;
            }
        } else {
            $athletes = array();
            $payments = array();
        }

        $group = DB::table('groups')
            ->leftJoin('group_translations', 'group_translations.group_id', '=', 'groups.id')
            ->select('groups.id', 'group_translations.name')
            ->where('groups.id', '=', $id)
            //TODO: Use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->first();

        return array($athletes, $payments, $group);
    }
}
