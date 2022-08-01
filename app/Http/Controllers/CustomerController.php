<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use function Composer\Autoload\includeFile;
use function PHPUnit\Framework\isNull;

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
            $photo = base64_encode(file_get_contents($request->file('photo')->path()));
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
