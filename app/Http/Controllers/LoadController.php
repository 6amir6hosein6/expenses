<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoadRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Customer;
use App\Models\Load;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Morilog\Jalali\Jalalian;

class LoadController extends Controller
{
    public function index()
    {
        return view('dashboard.loads.loads')->with('loads', Load::orderBy('id','DESC')->get());
    }



    public function create()
    {
        $date = $this->getToday();
        $customers = Customer::where('kind','صاحب بار')->orWhere('kind','کشاورز')->get();
        return view('dashboard.loads.create_load',['date'=>$date,'customers'=>$customers]);
    }


    public function store(LoadRequest $request): \Illuminate\Http\RedirectResponse
    {
        Load::create($request->all());
        return Redirect::route('loads.index')->with('status', 'بار با موفقیت اضافه شد');

    }

    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        Load::find($id)->delete();
        return Redirect::route('loads.index')->with('status', 'بار با موفقیت حذف شد');
    }

    public function search(Request $request)
    {
        $loads = Load::where('owner_name', 'like', '%' . $request->keyword . '%')->orderBy('id','DESC')->get();
        return view('dashboard.loads.loads')->with(['loads'=> $loads,'keyword'=>$request->keyword]);
    }

    public function getNewLoads()
    {
        $new_loads = Load::where('is_new',1)->get();
        return view('dashboard.loads.new_loads')->with(['new_loads' => $new_loads]);
    }

    public function searchNewLoads(Request $request)
    {
        $loads = Load::where('owner_name', 'like', '%' . $request->keyword . '%')
            ->where('is_new',1)
            ->orderBy('id','DESC')->get();
        return view('dashboard.loads.new_loads')->with(['new_loads'=> $loads,'keyword'=>$request->keyword]);
    }

    public function unsetIsNew($load_id = null): \Illuminate\Http\RedirectResponse
    {
        if ($load_id){
            Load::find($load_id)->update(['is_new'=>0]);
            $message = "بار با موفقیت تایید شد";
        }else{
            Load::where('is_new',1)->update(['is_new'=>0]);
            $message = "بار ها با موفقیت تایید شدند";
        }
        return Redirect::route('loads.new-loads')->with('status', $message);

    }
}
