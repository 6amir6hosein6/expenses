<?php

namespace App\Http\Controllers;

use App\Http\Requests\MemberRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Family;
use App\Models\Factor;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions= Transaction::join('users','users.id','=','transactions.user_id')
            ->orderBy('transactions.id', 'DESC')
            ->get();
        return view('dashboard.transactions.transactions')->with(['transactions' => $transactions]);
    }

    public function myTransactions()
    {
        $transactions= Transaction::where('user_id',auth()->user()->id)
            ->orderBy('transactions.id', 'DESC')
            ->get();
        return view('dashboard.transactions.myTransactions')->with(['transactions' => $transactions]);
    }


    public function create()
    {
        $date = $this->getToday();
        return view('dashboard.transactions.create_transaction')->with(['date'=>$date]);
    }

    public function store(TransactionRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        $data["family_id"] = auth()->user()->family_id;
        Transaction::create($data);
        return Redirect::route('my-transactions')->with('status', 'تراکنش با موفقیت اضافه شد');

    }


    public function edit($id)
    {
        return view('dashboard.transactions.update_transaction')->with('transaction', Transaction::find($id));
    }


    public function update(TransactionRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $data = $request->all();
        $data["user_id"] = auth()->user()->id;
        $data["family_id"] = auth()->user()->family_id;
        Transaction::find($id)->update($data);

        return Redirect::route('my-transactions')->with('status', 'تراکنش با موفقیت ویرایش شد');

    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Transaction::find($id)->delete();
        return Redirect::route('my-transactions')->with('status', 'تراکنش با موفقیت حذف شد');
    }

}
