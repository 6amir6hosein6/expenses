<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function transactionReportsWeekly(Request $request)
    {
        $transactions = Transaction::orderBy('date', 'DESC')
            ->whereDate('transactions.created_at', '>', Carbon::today()->subDays(8))
            ->where('transactions.family_id', auth()->user()->family_id);


        if ($request->for_what != "همه"){
            $transactions->where('for_what',$request->for_what);
        }
        if ($request->for_what_sub != "همه"){
            $transactions->where('for_what_sub',$request->for_what_sub);
        }

        $transactions->join('users','users.id','=','transactions.user_id')
            ->select(['transactions.*','users.name']);

        return view('dashboard.reports.transaction-reports')->with([
            'transactions' => $transactions->get(),
            'for_what' => $request->for_what,
            'for_what_sub' => $request->for_what_sub,
            'title' => 'هفتگی'

        ]);
    }

    public function transactionReportsMonthly(Request $request)
    {
        $transactions = Transaction::orderBy('date', 'DESC')
            ->whereDate('transactions.created_at', '>', Carbon::today()->subMonth(1))
            ->where('transactions.family_id', auth()->user()->family_id);


        if ($request->for_what != "همه"){
            $transactions->where('for_what',$request->for_what);
        }
        if ($request->for_what_sub != "همه"){
            $transactions->where('for_what_sub',$request->for_what_sub);
        }

        $transactions->join('users','users.id','=','transactions.user_id')
            ->select(['transactions.*','users.name']);

        return view('dashboard.reports.transaction-reports')->with([
            'transactions' => $transactions->get(),
            'for_what' => $request->for_what,
            'for_what_sub' => $request->for_what_sub,
            'title' => 'ماهانه'
        ]);
    }

}
