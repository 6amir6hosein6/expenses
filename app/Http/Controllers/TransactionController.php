<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::orderBy('id', 'DESC')->get();
        return view('dashboard.transactions.transactions')->with(['transactions'=> $transactions,'category_type' => 0]);
    }

    public function create($type)
    {
        if (!in_array($type,['پرداخت وجه به مشتری','دریافت وجه از مشتری'])){
            abort(404);
        }

        $customers = Customer::all();
        $date = $this->getToday();
        return view('dashboard.transactions.create_transaction')->with(
            [
                'date' => $date,
                'customers' => $customers,
                'type' => $type,
            ]
        );
    }

    public function store(TransactionRequest $request,$type)
    {
        if (!in_array($type,['پرداخت وجه به مشتری','دریافت وجه از مشتری'])){
            abort(404);
        }

        DB::beginTransaction();

        $request->price = ($type == 'پرداخت وجه به مشتری')? $request->price : -$request->price;

        $data = $request->all();
        $data['type'] = $type;
        Transaction::create($data);

        $customer = Customer::find($request->customer_id);
        $customer->update(['debt'=>$customer->debt + $request->price]);

        DB::commit();

        return Redirect::route('transactions.index')->with('status', 'تراکنش با موفقیت انجام شد');
    }

    public function destroy($transaction_id)
    {
        DB::beginTransaction();

        $transaction = Transaction::find($transaction_id);

        $price = ($transaction->type == 'پرداخت وجه به مشتری')? -$transaction->price : $transaction->price;

        $customer = Customer::find($transaction->customer_id);
        $customer->update(['debt'=>$customer->debt + $price]);

        $transaction->delete();

        DB::commit();

        return Redirect::route('transactions.index')->with('status', 'تراکنش با موفقیت حذف شد');
    }

    public function customerTransactions($customer_id)
    {
        $customer = Customer::find($customer_id);

        $transactions = Transaction::where('customer_id',$customer_id)->orderBy('id', 'DESC')->get();
        return view('dashboard.transactions.transactions')->with(['transactions'=> $transactions,'keyword'=>$customer->name,'category_type' => 0]);
    }

    public function search(Request $request){
        $transactions = Transaction::orderBy('id', 'DESC');

        $categorized = "";
        if ($request->type == 1){
            $transactions->where('type','پرداخت وجه به مشتری');
            $categorized = 'پرداخت وجه';
        }elseif ($request->type == 2){
            $transactions->where('type','دریافت وجه از مشتری');
            $categorized = 'دریافت وجه';
        }

        $transactions->where(function ($query) use ($request) {
            $query->where('customer_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('id', 'like', '%' . $request->keyword . '%');
        });

        return view('dashboard.transactions.transactions')->with(
            [
                'transactions' => $transactions->get(),
                'keyword' => $request->keyword,
                'categorized' => $categorized,
                'category_type' => $request->type
            ]);
    }

    public function print($category_type, $keyword = null)
    {
        $transactions = Transaction::orderBy('id', 'DESC');
        $title = "";

        if ($category_type == 2) {
            $transactions->where('type', 'دریافت وجه از مشتری');
            $title = "ی دریافت وجه";
        } elseif ($category_type == 1) {
            $transactions->where('type', 'پرداخت وجه به مشتری');
            $title = "ی پرداخت وجه";
        } elseif ($category_type == 3) {
            $title = "";
        }

        $transactions->where(function ($query) use ($keyword) {
            $query->where('customer_name', 'like', '%' . $keyword . '%')
                ->orWhere('id', 'like', '%' . $keyword . '%');
        });

        return view('dashboard.transactions.print_transactions',
            [
                'transactions' => $transactions->get(),
                'title' => $title,
                'keyword' => $keyword
            ]);
    }
}
