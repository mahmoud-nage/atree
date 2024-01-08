<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExpensesCategory;
use App\Models\Expenses;
use Auth;
use App\Http\Requests\Dashboard\Expenses\StoreExpensesRequest;
use App\Http\Requests\Dashboard\Expenses\UpdateExpensesRequest;
class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.expenses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ExpensesCategory::all();
        return view('dashboard.expenses.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesRequest $request)
    {
        $expenses = new Expenses;
        $expenses->name = $request->name;
        $expenses->details = $request->details;
        $expenses->money = $request->money;
        $expenses->user_id = Auth::id();
        $expenses->expenses_category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $expenses->image = basename($request->file('image')->store('expenses'));
        }
        $expenses->save();

        return redirect(route('dashboard.expenses.index'))->with('success' , 'تم الاضافه بنجاح' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Expenses $expense)
    {
        return view('dashboard.expenses.show' , compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expense)
    {
        $categories = ExpensesCategory::all();
        return view('dashboard.expenses.edit' , compact('categories'  , 'expense') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesRequest $request, Expenses $expense)
    {

        $expense->name = $request->name;
        $expense->details = $request->details;
        $expense->money = $request->money;
        $expense->expenses_category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $expense->image = basename($request->file('image')->store('expenses'));
        }
        $expense->save();
        return redirect(route('dashboard.expenses.index'))->with('success' , 'تم التعديل بنجاح' );
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
