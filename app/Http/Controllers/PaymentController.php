<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = $this->getPayments();

        return view('payments.payments', ['payments' => $payments]);
    }

    private function getPayments(){
        return DB::table('payments')
            ->join('athletes', 'payments.athlete_id', '=', 'athletes.id')
            ->select(
                'payments.*',
                'athletes.id AS athlete_id',
                'athletes.firstname',
                'athletes.lastname'
            )
            ->orderByDesc('payments.payment_date')
            //TODO: change the year with settings
            ->where('payments.year', '=', '2020')
            ->paginate(50);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $athletes = DB::table('athletes')
            ->where('is_active','=', '1')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();

        $payment = new Payment();

        return view('payments.createpayment', [
            'athletes' => $athletes,
            'payment' => $payment]);
    }

    public function duplicate($id) {
        $athletes = DB::table('athletes')
            ->where('is_active','=', '1')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();

        $payment = new Payment();

        $payment_old = Payment::find($id);

        return view('payments.createpayment', [
            'athletes' => $athletes,
            'payment' => $payment,
            'payment_old' => $payment_old
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
            'payment_date' => 'required',
            'athlete_id' => 'required',
            'period' => 'required',
            'amount' => 'required'
        ]);

        $payment = new Payment([
            //TODO: change the year with settings
            'year' => '2020',
            'payment_date' => $request->get('payment_date'),
            'athlete_id' => $request->get('athlete_id'),
            'amount' => $request->get('amount'),
            'period' => $request->get('period'),
            'method' => $request->get('method'),
            'note' => $request->get('note'),
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id
        ]);

        //Check if exists a similar payment
        $exists_payment_period = DB::table('payments')
            ->where('athlete_id', '=', $request->get('athlete_id'))
            ->where('period', '=', $request->get('period'))
            //TODO: change the year with settings
            ->where('year', '=', '2020')
            ->get();

        if (count($exists_payment_period) == 0) {
            $payment->save();
            return view('payments.payments', [
                'payments' => $this->getPayments(),
                'payment_old' => $payment->id
            ])->with('success', 'Payment saved');
        } else {
            return redirect('/payments')->with('error', 'Pagamento già presente per il periodo e l\'atleta');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        $athlete = DB::table('athletes')
            ->where('id','=', $payment->athlete_id)
            ->select('lastname', 'firstname')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();

        return view('payments.show', ['payment' => $payment, 'athlete' => $athlete]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $athletes = DB::table('athletes')
            ->where('is_active','=', '1')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();

        $payment = Payment::find($id);

        return view('payments.editpayment', ['payment' => $payment, 'athletes' => $athletes]);
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
        $payment = Payment::find($id);

        $rules = [
            'amount' => 'numeric|gt:0'
        ];

        $messages = [
            'amount.gt:0' => 'Amount must be grater then zero.'
        ];

        $this->validate($request, $rules, $messages);

        $payment->payment_date = $request->get('payment_date');
        $payment->athlete_id = $request->get('athlete_id');
        $payment->amount = $request->get('amount');
        $payment->period = $request->get('period');
        $payment->method = $request->get('method');
        $payment->note = $request->get('note');
        $payment->updated_by = Auth::user()->id;

        //Check if exists a similar payment
        $exists_payment_period = DB::table('payments')
            ->where('athlete_id', '=', $request->get('athlete_id'))
            ->where('period', '=', $request->get('period'))
            //TODO: change the year with settings
            ->where('year', '=', '2020')
            ->get();

        if (count($exists_payment_period) == 0) {
            $payment->save();
            return view('payments.payments', [
                'payments' => $this->getPayments(),
                'payment_old' => $payment
            ])->with('success', 'Payment saved');
        } else {
            return redirect('/payments')->with('error', 'Pagamento già presente per il periodo e l\'atleta');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "NO DESTROY POSSIBLE";
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $payments = DB::table('payments')
            ->join('athletes', 'payments.athlete_id', '=', 'athletes.id')
            ->where('athletes.firstname', 'LIKE', '%'.$q.'%')
            ->orWhere('athletes.lastname', 'LIKE', '%'.$q.'%')
            ->paginate(50);

        if (count($payments)>0) return view('payments.payments', ['payments' => $payments]);
        else return view('payments.payments')->with('message', 'Sorry no payments found ('.$q.')');
    }
}
