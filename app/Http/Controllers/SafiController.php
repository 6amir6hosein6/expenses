<?php

namespace App\Http\Controllers;

use App\Http\Requests\FactorRequest;
use App\Http\Requests\SafiRequest;
use App\Models\Customer;
use App\Models\Factor;
use App\Models\FactorProduct;
use App\Models\Load;
use App\Models\Product;
use App\Models\Safi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SafiController extends Controller
{
    public function index()
    {
        $safis = Safi::orderBy('id', 'DESC')->where('is_saved',1)->get();
        foreach ($safis as $safi) {
            $safi_products_total = FactorProduct::where('safi_id', $safi->id)
                ->sum(DB::raw('weight * count * fee'));
            $safi->total_price =
                $safi_products_total -
                ($safi->do_price + $safi->hire + $safi->discharge + $safi->weighbridge + $safi->handy);
        }
        return view('dashboard.safis.safis')->with('safis', $safis);
    }


    public function create()
    {
        $date = $this->getToday();
        $products = Product::all();
        $loads = Load::where('is_new',1)->get();

        return view('dashboard.safis.create_safi',
            [
                'date' => $date,
                'loads' => $loads,
                'products' => $products,
            ]);
    }

    public function getProductJsonData($load_id,$product_id): \Illuminate\Http\JsonResponse
    {
        $products_data = [];
        $factors = Factor::where('load_id',$load_id)->get();
        foreach ($factors as $factor){
            $factor_products = FactorProduct::where('factor_id',$factor->id)->get();
            foreach ($factor_products as $product){
                if ($product->product_id == $product_id and is_null($product->safi_id)){
                    array_push($products_data,$product);
                }
            }
        }

        return response()->json($products_data);
    }


    public function store(SafiRequest $request): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();
        $safi = Safi::create($request->all());
        $safi_products = json_decode($request->products_data);
        foreach ($safi_products as $product){
            FactorProduct::find($product->id)->update(['safi_id' => $safi->id]);
        }
        DB::commit();

        return Redirect::route('safis.index')->with('status', 'فاکتور صافی با موفقیت اضافه شد');

    }


    public function edit($id)
    {
        $safi = Safi::find($id);
        $safi_products = json_encode(FactorProduct::where('safi_id', $safi->id)->get());

        $products = Product::all();
        $loads = Load::where('is_new',1)->get();

        return view('dashboard.safis.update_safi')->with(
            [
                'safi' => $safi,
                'safi_products' => $safi_products,
                'loads' => $loads,
                'products' => $products,
            ]);
    }


    public function update(SafiRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        DB::beginTransaction();

        $safi = Safi::find($id);

        FactorProduct::where('safi_id',$safi->id)->update(['safi_id'=>null]);

        $safi_products = json_decode($request->products_data);
        foreach ($safi_products as $product){
            FactorProduct::find($product->id)->update(['safi_id' => $safi->id]);
        }

        $safi->update($request->all());
        DB::commit();

        return Redirect::route('safis.index')->with('status', 'فاکتور صافی با موفقیت ویرایش شد');
    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {

        DB::beginTransaction();

        DB::commit();

        return Redirect::route('safis.index')->with('status', 'فاکتور صافی با موفقیت حذف شد');
    }


    public function search(Request $request)
    {
        $safis = Factor::orderBy('id', 'DESC')
            ->where('is_saved',1)
            ->get();

        $safis->where(function ($query) use ($request) {
            $query->where('load_owner_name', 'like', '%' . $request->keyword . '%')
                ->orWhere('id', $request->keyword);
        });

        return view('dashboard.safis.safis')->with(['safis' => $safis, 'keyword' => $request->keyword]);

    }

    public function print($id)
    {
        $safi = Safi::find($id);
        $safi_products = FactorProduct::where('safi_id',$safi->id);
        return view('dashboard.safis.print_safi', [
            'safi' => $safi,
            'safi_products' => $safi_products->get(),
            'total_products_price' => $safi_products->sum(DB::raw('weight * count * fee')),
            'total_products_count' => $safi_products->sum(DB::raw('count')),
            'total_products_weight' => $safi_products->sum(DB::raw('weight')),
        ]);

    }
}
