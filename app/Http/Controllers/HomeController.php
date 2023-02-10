<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use App\Models\Address;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use App\Models\Category;
use App\Models\UserBalance;
use Illuminate\Console\View\Components\Warn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use function Psy\debug;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    private $date;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $all_bills = [];
        $info = [];
        $this->date = date("Y-m-t");
        $info['paidMonth'] = Bill::select('amount_paid')->where('user_id',Auth::id())->where('due_date','<=',$this->date)->where('due_date','>=',date("Y-m-1"))->sum('amount_paid');
        $info['paidYear'] = Bill::select('amount_paid')->where('user_id',Auth::id())->where('due_date','<=',date("Y-12-t"))->where('due_date','>=',date("Y-1-1"))->sum('amount_paid');
        $info['toBePaid'] = Bill::select('amount')->where('user_id',Auth::id())->where('is_paid', 0)->where('due_date','<=',date("Y-m-t",strtotime(" +1 months")))->where('due_date','>=',date("Y-m-d"))->sum('amount') 
        - Bill::select('amount_paid')->where('user_id',Auth::id())->where('is_paid', 0)->where('due_date','<=',$this->date)->where('due_date','>=',date("Y-m-1"))->sum('amount_paid');
        //dd(Bill::select('amount_paid')->where('user_id',Auth::id())->where('is_paid', 0)->where('due_date','<=',$this->date)->where('due_date','>=',date("Y-m-1"))->toSql());
        //dd(Category::whereHas("bills",function($q){$q->where('user_id', Auth::id())->where('is_paid', 0)->whereDate('due_date','<=',$this->date);})->where('user_id',Auth::id())->toSql());
        foreach (Category::whereHas("bills",function($q){$q->where('user_id', Auth::id())->where('is_paid', 0)->whereDate('due_date','<=',$this->date);})->where('user_id',Auth::id())->get() as $cat){
            $all_bills[$cat->name] = Category::where('user_id',Auth::id())->findOrFail($cat->id)->bills->where('is_paid', 0)->where('user_id',Auth::id())->where('due_date','<=',$this->date);
        }
        $this->date = date("Y-m-1",strtotime(" +1 months"));
        $upcoming_bills =[];
        foreach(Category::whereHas("bills",function($q){$q->where('user_id', Auth::id())->where('is_paid', 0)->whereDate('due_date','>=',$this->date);})->where('user_id',Auth::id())->get() as $cat){
            $upcoming_bills[$cat->name] = Bill::where('is_paid', 0)->where('user_id',Auth::id())->where('due_date','>=',$this->date)->where('category_id',$cat->id)->get();
           // dd($this->date);
        }
        return view('home',['bills' => $all_bills,
        'upcoming_bills'=> $upcoming_bills
        ,'info'=>$info]);
    }

    public function bills()
    {
        $all_bills = [];
        foreach ( Category::whereHas("bills",function($q){$q->where('is_paid', 0)->where('user_id', Auth::id());})->get() as $cat){
            $all_bills[$cat->name] = Category::where('user_id',Auth::id())->find($cat->id)->bills->where('is_paid', 0)->where('user_id',Auth::id());
        }
        return view('bills',['bills' => $all_bills]);
    }

    public function categories()
    {
        return view('categories',['categories' => Category::all()->where('is_valid',1)->where('user_id',Auth::id())]);
    }

    public function addresses()
    {
        return view('addresses',['addresses' => Address::all()->where('user_id',Auth::id())]);
    }

    public function history()
    {
        $all_bills = [];
        foreach ( Category::whereHas("bills",function($q){$q->where('is_paid', 1)->where('user_id', Auth::id());})->get() as $cat){
            $all_bills[$cat->name] = Category::where('user_id',Auth::id())->find($cat->id)->bills->where('is_paid', 1)->where('user_id',Auth::id());
        }
        return view('history',['bills' => $all_bills]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $mailData = [

            'from' => $request->from,

            'body' => $request->body

        ];
        Mail::to('panaite.vladut99@gmail.com')->send(new DemoMail($mailData));
        session()->flash('message', 'Mail sent succesfuly!');
        return view('contact');
    }
    public function wallet()
    {
        $balannce =UserBalance::all()->where('user_id',Auth::id());
        return view('wallet',['balance'=> $balannce[0]]);
    }
}
