<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class PaymentGroupExport implements FromCollection, WithMapping
{

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function map(): array
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
            '12th_fee',
            '1ex_fee',
            '2ex_fee',
            '3ex_fee',
            '4ex_fee'
        ];

        $athletes = DB::table('group_compositions')
            ->join('athletes', 'group_compositions.athlete_id', '=', 'athletes.id')
            ->where([
                ['group_compositions.group_id', '=', $this->id],
                ['group_compositions.is_active', '=', '1']
            ])
            ->select(
                'group_compositions.id',
                'athletes.id as athlete_id',
                'athletes.lastname',
                'athletes.firstname'
            )
            ->orderBy('athletes.lastname')
            ->orderBy('athletes.firstname')
            ->get();

        if (count($athletes) > 0)
        {
            for ($i = 0; $i < count($athletes); $i++)
            {
                $payments = DB::table('payments')
                    ->select(
                        'payment_date',
                        'amount',
                        'period',
                        'method',
                        'id'
                    )
                    ->where('athlete_id', '=', $athletes[$i]->athlete_id)
                    // TODO: use settings instead
                    ->where('year', '=', '2020')
                    ->orderBy('period')
                    ->get();

                $period_payments = array();
                $group_payments = array();
                $total = 0.0;
                $offset = 2;
                $period_payments[0] = $athletes[$i]->lastname;
                $period_payments[1] = $athletes[$i]->firstname;

                if (count($payments) > 0)
                {
                    $j = 0;
                    for ($k = 0; $k < count($periods); $k++)
                    {
                        $per = $periods[$j];
                        if ($j < count($payments))
                        {
                            if ($payments[$j]->period == $periods[$k])
                            {
                                $athletes[$i][$per] = $payments[$j]->amount."\n".$payments[$j]->payment_date.
                                    " [".$payments[$j]->method."]";
                                $total += floatval($payments[$j]->amount);
                                $j++;
                            } else
                            {
                                $athletes[$i][$per] = 0;
                            }
                        } else
                        {
                            $athletes[$i][$per] = 0;
                        }
                    }
                } else
                {
                    for ($k = 0; $k < count($periods); $k++) {
                        $per = $periods[$k];
                        $athletes[$i][$per] = 0;
                    }
                }
                //$period_payments[count($periods)+$offset+1] = $total;
                array_push($group_payments, $period_payments);
            }
        }

        return $athletes;
    }
}
