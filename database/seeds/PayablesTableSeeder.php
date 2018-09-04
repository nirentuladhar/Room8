<?php

use Illuminate\Database\Seeder;
use App\Payable;
use App\Transaction;
use App\House;

class PayablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //to make sure we only calculate if the group has more than 1 user
        $done = false;
        while (!$done) {
            $house = House::all()->random();
            $group = $house->groups->random();
            if (count($group->users) > 1) {
                $payables = array();
                $finalAssesment = array();
                $grand_total = 0;
                $per_person = 0;
                $receiver = 0;
            //get grand total
                foreach ($group->transactions as $transaction) {
            //note:dont forget to check if transaction is already calculated (is_calculated)
                    if (!$transaction->is_calculated) {
                        $grand_total += $transaction->amount;
                        if (array_key_exists($transaction->user_id, $payables)) {
                            $payables[$transaction->user_id] += $transaction->amount;
                        } else {
                            $payables[$transaction->user_id] = $transaction->amount;
                        }
                        $transaction->is_calculated = 1;
                        $transaction->save();
                    }
                }
            //perperson
                $per_person = round($grand_total / count($payables), 2);
            //calculate payables value - per_person (order is imp)
                foreach ($payables as $user => $amount) {
                    $payables[$user] = ($amount - $per_person);
                    if ($payables[$user] > 0) {
                        $receiver = $user;
                    }
                }

            //for each payable insert into payable table
                foreach ($payables as $user => $amount) {
                    if ($amount < 0 && $amount != 0) {
                        $toPay = new Payable;
                        $toPay->payer_id = $user;
                        $toPay->receiver_id = $receiver;
                        $toPay->group_id = $group->id;
                        $toPay->amount_due = abs($amount);
                        $toPay->is_paid = 0;
                        $toPay->save();
                    }
                }
                $done = true;
            }

        }

    }
}
