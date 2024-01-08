<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\BankAccounts\StoreBankAccountRequest;
use App\Http\Requests\Dashboard\BankAccounts\UpdateBankAccountRequest;
use App\Models\BankAccount;
class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.bank_accounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.bank_accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankAccountRequest $request)
    {
        $account = new BankAccount;
        if(!$account->add($request->all()))
            return back()->with('error' , trans('bank_accounts.adding_error'));

        return redirect(route('dashboard.bank_accounts.index'))->with('success' , trans('bank_accounts.adding_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(BankAccount $bank_account)
    {
        return view('dashboard.bank_accounts.show' , compact('bank_account') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccount $bank_account)
    {
        return view('dashboard.bank_accounts.edit' , compact('bank_account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankAccountRequest $request, BankAccount $bank_account)
    {
        if(!$bank_account->edit($request->all()))
            return back()->with('error' , trans('bank_accounts.editing_error'));

        return redirect(route('dashboard.bank_accounts.index'))->with('success' , trans('bank_accounts.editing_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
