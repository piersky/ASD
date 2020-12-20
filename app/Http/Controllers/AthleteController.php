<?php

namespace App\Http\Controllers;

use App\Models\GroupComposition;
use Illuminate\Http\Request;
use App\Models\Athlete;
use Illuminate\Support\Facades\DB;
use Auth;
use function PHPUnit\Framework\isEmpty;

class AthleteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $athletes = DB::table('athletes')
            ->leftJoin('group_compositions', 'athletes.id', '=', 'group_compositions.athlete_id')
            ->leftJoin('groups', 'group_compositions.group_id', '=', 'groups.id')
            ->leftJoin('group_translations', 'group_translations.group_id', '=', 'groups.id')
            ->select(
                'athletes.*',
                'group_translations.name as group_name',
                'groups.id as group_id'
            )
            //TODO: use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->orderByDesc('athletes.is_active')
            ->orderBy('athletes.lastname')
            ->orderBy('athletes.firstname')
            ->paginate(50);

        return view('athletes.athletes', ['athletes' => $athletes]);
    }

    public function orderByGroup( $order = 1)
    {
        $queryBuilder = DB::table('athletes')
            ->leftJoin('group_compositions', 'athletes.id', '=', 'group_compositions.athlete_id')
            ->leftJoin('groups', 'group_compositions.group_id', '=', 'groups.id')
            ->join('group_translations', 'groups.id', '=', 'group_translations.group_id')
            ->select(
                'athletes.*',
                'group_translations.name as group_name',
                'groups.id as group_id'
            )
            //TODO: use settings instead
            ->where('group_translations.lang_id', '=', 'it');

        if ($order == 1) $queryBuilder->orderBy('group_translations.name');
        else $queryBuilder->orderByDesc('group_translations.name');

        $queryBuilder->orderBy('athletes.lastname')->orderBy('athletes.firstname');

        $athletes = $queryBuilder->paginate(50);

        $groupOrder = ($order == 1 ? 0 : 1);

        return view('athletes.athletes', ['athletes' => $athletes, 'grouporder' => $groupOrder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $athlete = new Athlete();

        $groups = DB::table('groups AS g')
            ->leftJoin('group_translations AS gt', 'gt.group_id', '=', 'g.id')
            ->select('g.id', 'gt.name')
            ->where('g.is_active', '=', 1)
            //TODO: Use settings instead
            ->where('gt.lang_id', '=', 'it')
            ->get();

        //$parents = Parent::all();

        return view('athletes.createathlete', ['athlete' => $athlete, 'groups' => $groups]);
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
            'lastname'=>'required',
        ]);

        $athlete = new Athlete([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'gender' => $request->get('gender'),
            'date_of_birth' => $request->get('date_of_birth'),
            'birth_municipality' => $request->get('birth_municipality'),
            'birth_province' => $request->get('birth_province'),
            'birth_country' => $request->get('birth_country'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'fiscal_code' => $request->get('fiscal_code'),
            'address' => $request->get('address'),
            'municipality' => $request->get('municipality'),
            'postal_code' => $request->get('postal_code'),
            'province' => $request->get('province'),
            'country' => $request->get('country'),
            //'main_parent_id' => $request->get('main_parent_id'),
            'expiry_medical_certificate_at' => $request->get('expiry_medical_certificate_at'),
            'is_active' => ($request->input('is_active')=='on'?1:0),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'begin_with_us_at' => $request->get('begin_with_us_at'),
            'end_with_us_at' => $request->get('end_with_us_at'),
            'society_come_from' => $request->get('society_come_from')
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            if(!$file->isValid()){
                return false;
            }
            $fileName = $file->store(env('PHOTO_DIR', 'public'));
            $athlete->photo = $fileName;
        }

        $athlete->save();

        $groupcomponent = new GroupComposition();

        if ($request->input('group_id') != "") {
            //TODO: choose year from settings
            $groupcomponent->year = '2020';
            $groupcomponent->athlete_id = $athlete->id;
            $groupcomponent->group_id = $request->input('group_id');
            $groupcomponent->created_by = Auth::user()->id;
            $groupcomponent->updated_by = Auth::user()->id;

            $groupcomponent->save();
        }

        return redirect('/athletes')->with('success', 'Athlete saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $athlete = Athlete::find($id);

        $group = DB::table('groups')
            ->join('group_compositions', 'groups.id', '=', 'group_compositions.group_id')
            ->leftJoin('group_translations', 'group_translations.group_id', '=', 'groups.id')
            ->where('group_compositions.athlete_id', '=', $id)
            //TODO: use settings instead
            ->where('group_translations.lang_id', '=', 'it')
            ->get();

        return view('athletes.show', ['athlete' => $athlete, 'group' => $group]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $athlete = Athlete::find($id);

        return view('athletes.editathlete', ['athlete' => $athlete]);
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
        $athlete = Athlete::find($id);

        $athlete->firstname = $request->get('firstname');
        $athlete->lastname = $request->get('lastname');
        $athlete->date_of_birth = $request->get('date_of_birth');
        $athlete->gender = $request->get('gender');
        $athlete->birth_municipality = $request->get('birth_municipality');
        $athlete->birth_province = $request->get('birth_province');
        $athlete->birth_country = $request->get('birth_country');
        $athlete->phone = $request->get('phone');
        $athlete->fiscal_code = $request->get('fiscal_code');
        $athlete->address = $request->get('address');
        $athlete->municipality = $request->get('municipality');
        $athlete->postal_code = $request->get('postal_code');
        $athlete->province = $request->get('province');
        $athlete->country = $request->get('country');
        //$athlete->main_parent_id = $request->get('main_parent_id');
        $athlete->is_active = ($request->get('is_active')=="on"?1:0);
        $athlete->updated_by = Auth::user()->id;
        $athlete->expiry_medical_certificate_at = $request->get('expiry_medical_certificate_at');
        $athlete->begin_with_us_at = $request->get('begin_with_us_at');
        $athlete->end_with_us_at = $request->get('end_with_us_at');
        $athlete->society_come_from = $request->get('society_come_from');

        $res = $athlete->save();

        $name = request()->input('firstname').' '.$request->input('lastname');
        $messaggio = $res ? 'Athlete   ' . $name . ' Created' : 'Athlete ' . $name . ' was not crerated';
        session()->flash('message', $messaggio);

        return redirect('/athletes')->with('message', 'Athlete updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //TODO: need to be deleted the payments & group compsitions too
        $group_owned = DB::table('group_compositions')
            ->where('athlete_id', '=', $id)
            ->where('year', '=', '2020')
            ->delete();

        $athlete = Athlete::find($id);
        $result = $athlete->delete();

        if (request()->ajax()) return '' . $result;
        else return redirect()->back();
    }

    /**
     * Retrieve all the payments for the selected athlete ID
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function payments($id) {
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

        $check = DB::table('athletes')
            ->rightJoin('group_compositions', 'athletes.id', '=', 'group_compositions.athlete_id')
            ->where('athletes.id', '=', $id)
            ->get();

        $athlete = DB::table('athletes')
            ->leftJoin('group_compositions', 'athletes.id', '=', 'group_compositions.athlete_id')
            ->leftJoin('groups', 'group_compositions.group_id', '=', 'groups.id')
            ->leftJoin('group_translations', 'group_translations.group_id', '=', 'groups.id')
            ->select(
                'athletes.firstname',
                'athletes.lastname',
                'athletes.gender',
                'athletes.date_of_birth',
                'athletes.phone',
                'athletes.email',
                'athletes.fiscal_code',
                'group_translations.name as group_name',
                'athletes.id'
            )
            ->where('athletes.id', '=', $id);

        //TODO: use settings instead
        if (count($check)>0) $athlete = $athlete->where('group_translations.lang_id', '=', 'it');

        $athlete = $athlete->first();

        $payments = DB::table('payments')
            ->select(
                'payment_date',
                'amount',
                'period',
                'method',
                'note',
                'id')
            ->where('athlete_id', '=', $id)
            ->orderBy('period')
            ->get();

        $period_payments = array();
        $total = 0.0;
        if (count($payments) > 0) {
            $i = 0;
            for ($k = 0; $k < count($periods); $k++) {
                if ($i < count($payments)) {
                    if ($payments[$i]->period == $periods[$k]) {
                        $period_payments[$k] = [
                            'amount' => $payments[$i]->amount,
                            'date' => $payments[$i]->payment_date,
                            'id' => $payments[$i]->id
                        ];
                        $total += floatval($payments[$i]->amount);
                        $i++;
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

        return view('athletes.payments', [
                'athlete' => $athlete,
                'payments' => $payments,
                'period_payments' => $period_payments,
                'periods' => $periods,
                'total' => $total
            ])->with('success', 'Athlete deleted.');
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $athletes = Athlete::where('firstname', 'LIKE', '%'.$q.'%')
            ->orWhere('lastname', 'LIKE', '%'.$q.'%')
            ->paginate(50);

        if(count($athletes) > 0) return view('athletes.athletes', ['athletes' => $athletes]);
        else return view ('athletes.athletes')->with('message', 'Sorry, no Athletes found.');
    }
}
