<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\Factor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    public function index()
    {
        return view('dashboard.customers.customers')->with(['customers' => Customer::orderBy('id', 'DESC')->get(), 'category_type' => 0]);
    }


    public function create()
    {
        return view('dashboard.customers.create_customer');
    }

    public function dataGeneration(Request $request): array
    {
        $photo = null;
        if (isset($request->photo)) {
            $image = $request->file('photo');

            $img = Image::make($image->getRealPath());
            if ($img->getHeight() > $img->getWidth()){
                $img->resize($img->getWidth() * (500 / $img->getHeight()), 500, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }else{
                $img->resize(500, $img->getHeight() * (500 / $img->getWidth()), function ($constraint) {
                    $constraint->aspectRatio();
                });
            }

            $photo = (string)$img->encode('data-url');

        }
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'debt' => (int)$request->debt * (int)$request->debt_kind,
            'kind' => $request->kind,
            'photo' => $photo
        ];

        return $data;
    }


    public function store(CustomerRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $this->dataGeneration($request);
        Customer::create($data);
        return Redirect::route('customers.index')->with('status', 'مشتری با موفقیت اضافه شد');

    }


    public function edit($id)
    {
        return view('dashboard.customers.update_customer')->with('customer', Customer::find($id));
    }


    public function update(CustomerRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $customer = Customer::find($id);
        $data = $this->dataGeneration($request);
        $customer->update($data);
        return Redirect::route('customers.index')->with('status', 'مشتری با موفقیت ویرایش شد');
    }


    public function destroy($id): \Illuminate\Http\RedirectResponse
    {

        if (!is_null(Factor::where('customer_id',$id)->first())){
            return Redirect::route('customers.index')->with('customer_delete', 'امکان حذف مشتری به علت وجود فاکتور وجود ندارد');
        }
        if (!is_null(Transaction::where('customer_id',$id)->first())){
            return Redirect::route('customers.index')->with('customer_delete', 'امکان حذف مشتری به علت وجود تراکنش وجود ندارد');
        }
        Customer::find($id)->delete();
        return Redirect::route('customers.index')->with('status', 'مشتری با موفقیت حذف شد');
    }

    public function search(Request $request)
    {
        $customers = Customer::where('name', 'like', '%' . $request->keyword . '%')->orderBy('id', 'DESC');
        $category_type = $request->type;

        if ($category_type == 3) {
            $customers->where('debt', 0);
            $categorized = "بی حساب";
        } elseif ($category_type == 1) {
            $customers->where('debt', '>', 0);
            $categorized = "بدهکار";

        } elseif ($category_type == 2) {
            $customers->where('debt', '<', 0);
            $categorized = "بستانکار";
        } else {
            $categorized = "";
        }

        return view('dashboard.customers.customers')->with(
            [
                'customers' => $customers->get(),
                'keyword' => $request->keyword,
                'categorized' => $categorized,
                'category_type' => $category_type
            ]);

    }

    public function print($category_type, $keyword = null)
    {
        $customers = Customer::where('name', 'like', '%' . $keyword . '%');
        $title = "";

        if ($category_type == 1) {
            $customers->where('debt', '>', 0);
            $title = "بدهکار";
        } elseif ($category_type == 2) {
            $customers->where('debt', '>', 0);
            $title = "بستانکار";
        } elseif ($category_type == 3) {
            $customers->where('debt', '=', 0);
            $title = "بی حساب";
        }

        return view('dashboard.customers.print_customers',
            [
                'customers' => $customers->get(),
                'title' => $title,
                'keyword' => $keyword
            ]);

    }
}
