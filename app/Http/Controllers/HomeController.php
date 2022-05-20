<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Models\Order;
use Illuminate\Http\Request;
use App\Models\Models\Payment;
use App\Models\Models\Product;
use App\Models\Models\Customer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
     {   
        $orders = Order::with(['items', 'payments'])->get();
        $customers_count = Customer::count();
        $orders_o = Order::latest()->take(3)->get();
        
        $producti = Product::latest()->take(3)->get(); 
        $total = $orders->map(function($i){
            return $i->total();
        })->sum();
        //total income
        $total_income = $orders->map(function($i){
            if($i->recivedAmount() > $i->total()){
                return $i->total();
            }
            return $i->recivedAmount();
        })->sum();
        //Count orders
        $count_order=$orders->count();
        //Income today sales
        $income_today = $orders->where('created_at', '>=', date('Y-m-d').' 00:00:00')->map(function($i) {
            if($i->recivedAmount() > $i->total()) {
                return $i->total();
            }
            return $i->recivedAmount();
        })->sum();
        
        //Data Chart sales 
        $data = Payment::select('id','created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        $months =[];
        $monthCount = [];
        foreach($data as $month => $values){
            $months[] = $month;
            $monthCount[]=count($values);
        }
        return view('home',['orders_o'=>$orders_o,'producti'=>$producti,'orders_count'=>$orders->count(),'total_income'=>$total_income,'income_today'=>$income_today,'customers_count'=>$customers_count,'data'=>$data,'months'=>$months,'monthCount'=>$monthCount]);
    }
}