<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Factor;
use App\Models\FactorProduct;
use App\Models\Load;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class HomeController extends Controller
{
    public function home()
    {
        $customer_count = Customer::count();
        $factor_count = Factor::count();
        $total_debt_price = Customer::where('debt', '>', 0)->sum('debt');
        $debtor_count = Customer::where('debt', '<', 0)->count();
        $not_ended_loads = Load::where('is_new', 1)->count();

        $factor_count_day_based = [];

        $last_7_days_products = Factor::orderBy('date', 'DESC')
            ->whereDate('created_at', '>', Carbon::today()->subDays(8))
            ->get();

        for ($i = 0; $i < 7; $i++) {
            $date = $this->subToday($i);
            $factor_count_day_based[$date] = 0;
            foreach ($last_7_days_products as $factor) {
                if ($factor->date == $date) {
                    $factor_count_day_based[$date] += 1;
                }
            }
        }

        $customer_count_kind_based =
            [
                ['count' => 0, 'kind' => 'بدهکار'],
                ['count' => 0, 'kind' => 'طلبکار'],
                ['count' => 0, 'kind' => 'بی حساب'],
            ];

        foreach (Customer::all() as $customer){
            if ($customer->debt < 0) $customer_count_kind_based[1]['count'] += 1;
            elseif ($customer->debt > 0) $customer_count_kind_based[0]['count'] += 1;
            else $customer_count_kind_based[2]['count'] += 1;
        }

        return view('dashboard.index')->with(
            [
                'customer_count' => $customer_count,
                'factor_count' => $factor_count,
                'total_debt_price' => $total_debt_price,
                'debtor_count' => $debtor_count,
                'not_ended_loads' => $not_ended_loads,
                'factor_count_day_based' => json_encode(array_reverse($factor_count_day_based)),
                'customer_count_kind_based' => json_encode($customer_count_kind_based)
            ]
        );
    }
}
