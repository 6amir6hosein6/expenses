<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerReportRequest;
use App\Models\Customer;
use App\Models\Factor;
use App\Models\FactorProduct;
use App\Models\Load;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getBuyerCustomers()
    {
        $date = $this->getToday();

        return view('dashboard.reports.buyer_customers.get_customer')->with(['customers' => Customer::orderBy('id', 'DESC')->get(),'date'=>$date]);
    }

    public function getBuyerCustomerReports(CustomerReportRequest $request,$print = null){
        $factors_products = Factor::orderBy('factors.id', 'DESC')
            ->where('customer_id',$request->customer_id)
            ->where('date','<=',$request->until)
            ->where('date','>=',$request->since)
            ->join('factor_products','factors.id', '=', 'factor_products.factor_id')
            ->get();

        $transactions = Transaction::orderBy('id', 'DESC')
            ->where('customer_id',$request->customer_id)
            ->where('date','<=',$request->until)
            ->where('date','>=',$request->since)
            ->get();

        $customer = Customer::find($request->customer_id);

        if ($print == 1){
            return view('dashboard.reports.buyer_customers.print_customer_reports')->with(
                [
                    'factors_products' => $factors_products,
                    'transactions'=>$transactions,
                    'since' => $request->since,
                    'until' => $request->until,
                    'customer_name' => $request->customer_name,
                    'customer_id' => $request->customer_id,
                    'customer_image' => $customer->photo,
                ]);
        }

        return view('dashboard.reports.buyer_customers.customer_reports')->with(
            [
                'factors_products' => $factors_products,
                'transactions'=>$transactions,
                'since' => $request->since,
                'until' => $request->until,
                'customer_name' => $request->customer_name,
                'customer_id' => $request->customer_id,
                'customer_image' => $customer->photo,
            ]);
    }


    public function getOwnerCustomers()
    {
        $date = $this->getToday();

        return view('dashboard.reports.owner_customers.get_customer')->with(['customers' => Customer::where('kind','کشاورز')->orWhere('kind','صاحب بار')->orderBy('id', 'DESC')->get(),'date'=>$date]);
    }

    public function getOwnerCustomerReports(CustomerReportRequest $request,$print = null){
        $factors_products = Load::select('factors.customer_name as buyer','factors.date as date','product_name','weight','fee','count')
            ->orderBy('factors.id', 'DESC')
            ->where('owner_id',$request->customer_id)
            ->join('factors','factors.load_id' , '=' , 'loads.id')
            ->join('factor_products','factors.id', '=', 'factor_products.factor_id')
            ->where('factors.date','<=',$request->until)
            ->where('factors.date','>=',$request->since)
            ->get();

        $customer = Customer::find($request->customer_id);

        if ($print == 1){
            return view('dashboard.reports.owner_customers.print_customer_reports')->with(
                [
                    'factors_products' => $factors_products,
                    'since' => $request->since,
                    'until' => $request->until,
                    'customer_name' => $request->customer_name,
                    'customer_id' => $request->customer_id,
                    'customer_image' => $customer->photo,
                ]);
        }

        return view('dashboard.reports.owner_customers.customer_reports')->with(
            [
                'factors_products' => $factors_products,
                'since' => $request->since,
                'until' => $request->until,
                'customer_name' => $request->customer_name,
                'customer_id' => $request->customer_id,
                'customer_image' => $customer->photo,
            ]);
    }




}
