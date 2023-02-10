<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserBalanceRequest;
use App\Http\Requests\UpdateUserBalanceRequest;
use App\Models\UserBalance;
use Illuminate\Support\Facades\Auth;

class UserBalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balannce =UserBalance::where('user_id',Auth::id())->get();
        return view('wallet',['balance'=> $balannce[0]]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserBalanceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserBalanceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBalance  $userBalance
     * @return \Illuminate\Http\Response
     */
    public function show(UserBalance $userBalance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserBalance  $userBalance
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBalance $userBalance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserBalanceRequest  $request
     * @param  \App\Models\UserBalance  $userBalance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserBalanceRequest  $request, UserBalance $userBalance)
    {
        $userBalance->balance = $userBalance->balance + $request->wallet_money;
        $userBalance->save();        
        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserBalance  $userBalance
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBalance $userBalance)
    {
        //
    }
}
