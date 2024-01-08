<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Branch;
use App\Models\BranchWarehouse;
use App\Http\Requests\Dashboard\Branches\StoreBranchRequest;
use App\Http\Requests\Dashboard\Branches\UpdateBranchRequest;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.branches.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        return view('dashboard.branches.create' , compact('warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBranchRequest $request)
    {
        $branch = new Branch;
        if(!$branch->add($request->all()))
            return redirect()->back()->with('error' , trans('branches.adding_error'));

        if($request->filled('warehouses')) {

            $warehouses = [];
            for ($i = 0; $i <count($request->warehouses) ; $i++) {
                $warehouses[] = new BranchWarehouse([
                    'brand_id' => $branch->id , 
                    'warehouse_id' => $request->warehouses[$i] , 
                ]);
            }
            $branch->warehouses()->saveMany($warehouses);
        }

        return redirect(route('dashboard.branches.index'))->with('success' , trans('branches.adding_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Branch $branch)
    {
        $branch->load('warehouses');
        return view('dashboard.branches.show' , compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Branch $branch)
    {
        $warehouses = Warehouse::all();
        $branch_warehouses = $branch->warehouses()->pluck('warehouse_id')->toArray();
        return view('dashboard.branches.edit' , compact('warehouses' , 'branch' , 'branch_warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBranchRequest $request, Branch $branch)
    {
        if(!$branch->edit($request->all()))
            return redirect()->back()->with('error' , trans('branches.editing_error'));

        if($request->filled('warehouses')) {
            $branch->warehouses()->delete();
            $warehouses = [];
            for ($i = 0; $i <count($request->warehouses) ; $i++) {
                $warehouses[] = new BranchWarehouse([
                    'brand_id' => $branch->id , 
                    'warehouse_id' => $request->warehouses[$i] , 
                ]);
            }
            $branch->warehouses()->saveMany($warehouses);
        }

        return redirect(route('dashboard.branches.index'))->with('success' , trans('branches.editing_success'));
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
