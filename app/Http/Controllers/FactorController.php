<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactorRequest;
use App\Models\Customer;
use App\Models\Factor;
use App\Models\FactorProduct;
use App\Models\Load;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FactorController extends Controller
{
    public function index()
    {
        $factors = Factor::orderBy('id', 'DESC')->get();
        foreach ($factors as $factor) {
            $factor_products_total = FactorProduct::where('factor_id', $factor->id)
                ->sum(DB::raw('weight * count * fee'));
            $factor->total = $factor_products_total + $factor->worker_paid;
        }
        return view('dashboard.factors.factors')->with('factors', $factors);
    }


    public function create()
    {
        $date = $this->getToday();
        $customers = Customer::where('kind', 'خریدار')->get();
        $products = Product::all();
        $loads = Load::where('is_new', 1)->get();

        return view('dashboard.factors.create_factor',
            [
                'date' => $date,
                'customers' => $customers,
                'loads' => $loads,
                'products' => $products
            ]);
    }

    public function createFactorProducts($products_data, $factor_id)
    {
        $total_price = 0;
        $products_data = json_decode($products_data);
        foreach ($products_data as $product) {
            FactorProduct::create([
                'factor_id' => $factor_id,
                'product_id' => $product->product_id,
                'product_name' => $product->product_name,
                'weight' => $product->weight,
                'count' => $product->count,
                'fee' => $product->fee,
            ]);
            $total_price += $product->fee * $product->count * $product->weight;
        }
        return $total_price;
    }


    public function store(FactorRequest $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();
        $factor = Factor::create($request->all());
        $total_price = $this->createFactorProducts($request->products_data, $factor->id);
        $customer = Customer::find($request->customer_id);
        $new_debt = $customer->debt + $total_price - $request->paid + $request->worker_paid;
        $customer->update(['debt' => $new_debt]);

        DB::commit();

        $phone = $customer->phone;
        if ($phone) {
            $this->sendFactorSMS($phone, $customer->name, $request->date, $total_price,$factor->id);
            return Redirect::route('factors.index')->with(
                [
                    'status' => 'فاکتور با موفقیت اضافه شد',
                    'sms_success' => 'پیامک با موفقیت ارسال شد'
                ]);
        } else {
            return Redirect::route('factors.index')->with(
                [
                    'status' => 'فاکتور با موفقیت اضافه شد',
                    'sms_failed' => 'پیامک به علت عدم ثبت شماره مشتری ارسال نشد'
                ]);
        }
    }


    public function edit($id)
    {
        $factor = Factor::find($id);
        $factor_products = json_encode(FactorProduct::where('factor_id', $factor->id)->get());

        $customers = Customer::where('kind', 'خریدار')->get();
        $products = Product::all();
        $loads = Load::where('is_new', 1)->get();

        return view('dashboard.factors.update_factor')->with(
            [
                'factor' => $factor,
                'factor_products' => $factor_products,
                'customers' => $customers,
                'loads' => $loads,
                'products' => $products,
            ]);
    }


    public function update(FactorRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        $factor = Factor::find($id);

//        $last_factor_for_this_user = Factor::where('customer_id', $factor->customer_id)->max('id');
//        if ($last_factor_for_this_user != $id) {
//            return Redirect::route('factors.index')->with('error', 'غیر قابل ویرایش ، زیرا فاکتور جدیدتری برای این مشتری وجود دارد');
//        }

        $old_factor_products = FactorProduct::where('factor_id', $id);
        $new_factor_products = json_decode($request->products_data);

        $old_products_total_price = $old_factor_products->sum(DB::raw('weight * count * fee'));

        $new_products_total_price = 0;
        foreach ($new_factor_products as $product) {
            $new_products_total_price += $product->weight * $product->count * $product->fee;
        }

        $difference = $new_products_total_price - $old_products_total_price;
        $difference -= $request->paid - $factor->paid;
        $difference += $request->worker_paid - $factor->worker_paid;

        $factor->update([
            'date' => $request->date,
            'paid' => $request->paid,
            'load_description' => $request->load_description,
            'load_id' => $request->load_id
        ]);

        $old_factor_products->delete();

        $this->createFactorProducts($request->products_data, $factor->id);

        $customer = Customer::find($factor->customer_id);
        $customer->update(['debt' => $customer->debt + $difference]);

        DB::table('factors')
            ->where('created_at', '>', $factor->created_at)
            ->update(array(
                'last_debt' => DB::raw('last_debt +' . $difference),
            ));

        $factor->update($request->all());

        DB::commit();

        return Redirect::route('factors.index')->with('status', 'فاکتور با موفقیت ویرایش شد');
    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {

        DB::beginTransaction();

        $factor = Factor::find($id);

//        $last_factor_for_this_user = Factor::where('customer_id', $factor->customer_id)->max('id');
//        if ($last_factor_for_this_user != $id) {
//            return Redirect::route('factors.index')->with('error', 'غیر قابل حذف ، زیرا فاکتور جدیدتری برای این مشتری وجود دارد');
//        }

        $old_factor_products = FactorProduct::where('factor_id', $id);

        $old_products_total_price = $old_factor_products->sum(DB::raw('weight * count * fee'));
        $difference = -$old_products_total_price;
        $difference -= -$factor->paid;
        $difference -= $factor->worker_paid;

        $customer = Customer::find($factor->customer_id);
        $customer->update(['debt' => $customer->debt + $difference]);

        DB::table('factors')
            ->where('created_at', '>', $factor->created_at)
            ->update(array(
                'last_debt' => DB::raw('last_debt +' . $difference),
            ));

        $old_factor_products->delete();
        $factor->delete();

        DB::commit();

        return Redirect::route('factors.index')->with('status', 'فاکتور با موفقیت حذف شد');
    }

    public function search(Request $request)
    {
        $factors = Factor::where('customer_name', 'like', '%' . $request->keyword . '%')
            ->orWhere('id', $request->keyword)
            ->orderBy('id', 'DESC')
            ->get();
        return view('dashboard.factors.factors')->with(['factors' => $factors, 'keyword' => $request->keyword]);

    }

    public function print($id)
    {
        $factor = Factor::find($id);
        $factor_products = FactorProduct::where('factor_id', $factor->id);

        return view('dashboard.factors.print_factor', [
            'factor' => $factor,
            'factor_products' => $factor_products->get(),
            'total_products_price' => $factor_products->sum(DB::raw('weight * count * fee')),
            'total_products_count' => $factor_products->sum(DB::raw('count')),
            'total_products_weight' => $factor_products->sum(DB::raw('weight')),
        ]);

    }

    public function sendFactorSMS($phone, $name, $date, $price, $number)
    {

        $url = "https://api.sms.ir/v1/send/verify";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "X-API-KEY: XMNvSzRUrAvmLPR4Kxi4CY8KirC6TCIJ9dZhhMY9EUCCcoDJyWeOQ7lXxvVS2v3J",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $data = '
        {
            "mobile": "' . $phone . '",
            "templateId": 795597,
            "parameters": [
              {
                "name": "NAME",
                "value": "' . $name . '"
              },
                     {
                "name": "NUMBER",
                "value": "' . $number . '"
              },
                     {
                "name": "DATE",
                "value": "' . $date . '"
              },
                     {
                "name": "PRICE",
                "value": "' . number_format($price) . '"
              },
                     {
                "name": "LINK",
                "value": "' . asset('factor/print/'.$number) . '"
              }
            ]
        }';

        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }
}
