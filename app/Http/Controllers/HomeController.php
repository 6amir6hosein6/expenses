<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Factor;
use App\Models\FactorProduct;
use App\Models\Load;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class HomeController extends Controller
{
    public function home()
    {
        $family_member_count = User::where('family_id', auth()->user()->family_id)->count();

        $total_last_week_transaction = Transaction::where('family_id', auth()->user()->family_id)
            ->whereDate('created_at', '>', Carbon::today()->subDays(8))
            ->sum('price');

        $each_family_user_spend_in_week = Transaction::select([DB::raw("SUM(price) as each_person_total_price"), 'user_id', 'name'])
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->where('transactions.family_id', auth()->user()->family_id)
            ->whereDate('transactions.created_at', '>', Carbon::today()->subDays(8))
            ->groupBy('user_id');

        $most_spender_among_users_in_week = $each_family_user_spend_in_week->orderBy('each_person_total_price', 'DESC')
            ->limit(1)
            ->first();

        $most_expensive_expense = Transaction::where('transactions.family_id', auth()->user()->family_id)
            ->whereDate('transactions.created_at', '>', Carbon::today()->subDays(8))
            ->orderBy('price', 'DESC')
            ->limit(1)
            ->first();


        $transactions_sum_price_day_based = [];

        $last_7_days_transaction = Transaction::orderBy('date', 'DESC')
            ->whereDate('created_at', '>', Carbon::today()->subDays(8))
            ->where('transactions.family_id', auth()->user()->family_id)
            ->get();

        for ($i = 0; $i < 7; $i++) {
            $date = $this->subToday($i);
            $transactions_sum_price_day_based[$date] = 0;
            foreach ($last_7_days_transaction as $transaction) {
                if ($transaction->date == $date) {
                    $transactions_sum_price_day_based[$date] += $transaction->price;
                }
            }
        }

        $transaction_importance_count =
            [
                ['count' => 0, 'kind' => 'خیلی کم'],
                ['count' => 0, 'kind' => 'کم'],
                ['count' => 0, 'kind' => 'متسط'],
                ['count' => 0, 'kind' => 'زیاد'],
                ['count' => 0, 'kind' => 'خیلی زیاد'],
            ];
        $this_week_Transactions = Transaction::where('family_id',auth()->user()->family_id)
            ->whereDate('transactions.created_at', '>', Carbon::today()->subDays(8))->get();
        foreach ($this_week_Transactions as $transaction){
            if ($transaction->importance == 1) $transaction_importance_count[0]['count'] += 1;
            elseif ($transaction->importance == 2) $transaction_importance_count[1]['count'] += 1;
            elseif ($transaction->importance == 3) $transaction_importance_count[2]['count'] += 1;
            elseif ($transaction->importance == 4) $transaction_importance_count[3]['count'] += 1;
            elseif ($transaction->importance == 5) $transaction_importance_count[4]['count'] += 1;
        }
        return view('dashboard.index')
            ->with(
                [
                    'most_expensive_expense' => $most_expensive_expense,
                    'most_spender_among_users_in_week' => $most_spender_among_users_in_week,
                    'total_last_week_transaction' => $total_last_week_transaction,
                    'family_member_count' => $family_member_count,
                    'transaction_importance_count' => json_encode($transaction_importance_count),
                    'transactions_sum_price_day_based' => json_encode(array_reverse($transactions_sum_price_day_based)),
                ]
            );
    }
}
