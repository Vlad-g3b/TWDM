<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Support\Facades\Log;

use App\Models\Bill;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\UserBalance;
use Illuminate\Support\Facades\Auth;

use function Psy\bin;

class BillsController extends Controller
{


    public function main(Request $request)
    {        
        if($request->has("add_bill")){
            return $this->to_add_bill($request);
        } 
        else  if($request->has("update_bill")) {
            return $this->update($request);
        }

    }

    public function to_add_bill()
    {
        Log::debug("to add bill");
        $cat = Category::all()->where('is_valid',1)->where('user_id',Auth::id());
        $address_list = Address::where('user_id',Auth::id())->get();
        $addresses = array();
        foreach ($address_list as $key => $value) {
            $addresses[$value->id]=$value->address;
        }
        $categories = array();
        Log::debug($cat);
        foreach ($cat as $key => $value) {
            Log::debug($value->name);
            $categories[$value->id] = $value->name;
        } 
        return view('bills.add',['categories' => $categories,
        'addresses' => $addresses ]);
    }
    public function add(Request $request)
    {   $periods = ["M" => 1,"S"=>2,"A" => 12,'N'=>0];
        Log::debug("add bill");
        $bill = new Bill();
        $bill->user_id = Auth::id();
        $bill->name = $request->name;
        $bill->address_id = $request->address;
        $bill->amount = $request->amount;
        $bill->category_id = $request->category_id;
        $bill->period =  $periods[$request->period];
        $months = $periods[$request->period];
        $day = $request->day;
        $date = date("Y-m-$day h:i:s",strtotime(" +$months months"));
        $bill->due_date = $date;
        $bill->is_paid = 0;
        $bill->amount_paid= 0;
        $bill->save();
        return redirect()->to('bills');
    }

    public function update(Request $request)
    {
         return redirect()->to('categories');
    }

    public function details(Bill $bill)
    {
        $category_name = Category::where('user_id',Auth::id())->find($bill->category_id)->name;
        
        return view('bills.details',['bill'=>$bill,
        'category_name' => $category_name]);
    }

    public function delete(Bill $bill)
    {
        $bill->delete();
        return redirect()->to('bills');
    }
    
    private $have_to_pay;
    public function pay(Bill $bill)
    {
        $category_name = Category::where('user_id',Auth::id())->find($bill->category_id)->name;
        $balannce = UserBalance::where('user_id',Auth::id())->get();
        return view('bills.pay',['bill'=>$bill,
        'category_name' => $category_name,
        'balance' => $balannce[0],
        'have_to_pay'=> $this->have_to_pay]);
    }

    private function pay_from_wallet($amount){
        $bal = UserBalance::find(Auth::id());
        $have_to_pay = 0;
            if(isset($bal)){
                $dif = $bal->balance - $amount;        
                if($dif <= 0){
                    $bal->balance = 0;
                    $have_to_pay = abs($dif);
                } else {
                    $bal->balance = $dif;
                    $have_to_pay = 0;
                }
            }
            $bal->save();
        return ['dif'=>$have_to_pay];
    }

    public function submit_pay(Bill $bill, Request $request)
    {
        $ret = $this->pay_from_wallet($request->amount);
        $this->have_to_pay = $ret['dif'];
        $bill->amount_paid = $bill->amount_paid + $request->amount;
        
        if($bill->amount_paid >= $bill->amount){
            $newBill = $bill->replicate();
            $newBill->amount_paid = 0;
            $newBill->due_date = date("Y-m-d",strtotime(" +$bill->period months",strtotime("$bill->due_date")));
            $bill->is_paid = 1;
            $bill->date_paid =date('Y-m-d');
            if($bill->period != 0){
                $newBill->is_paid = 0;
                $newBill->save();
            }
        }
        if($bill->amount_paid > $bill->amount){
            $balance = UserBalance::find(Auth::id());        
            if($balance == null){
                $balance = new UserBalance();
                $balance->user_id = Auth::id();
            }
            if($bill->is_paid == 1){
                $balance->balance = $balance->balance + $bill->amount_paid - $bill->amount;
                $balance->save();     
            }
        }
        $bill->save();
        return $this->pay(Bill::find($bill->id));
    }

}
