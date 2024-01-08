<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Governorate;
use App\Models\WarehouseGovernorate;
use App\Http\Requests\Dashboard\Warehouses\StoreWarehouseRequest;
use App\Http\Requests\Dashboard\Warehouses\UpdateWarehouseRequest;
use App\Exports\WarehouseProductsExport;
use Excel;
use Auth;
use App\Models\User;
class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.warehouses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('type' , '!='  , User::MARKETER )->get();
        $governorates = Governorate::all();
        return view('dashboard.warehouses.create' , compact('governorates' , 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseRequest $request)
    {
        $warehouse = new Warehouse;
        if(!$warehouse->add($request->all()))
            return back()->with('error' , trans('warehouses.adding_error')); 

        $warehouse_governorates = [];
        if ($request->governorates) {
            for ($i=0; $i <count($request->governorates) ; $i++) { 
                $warehouse_governorates[] = new WarehouseGovernorate([
                    'user_id' => Auth::id() , 
                    'warehouses_id' => $warehouse->id , 
                    'governorate_id' => $request->governorates[$i] , 
                ]);
            }
            $warehouse->governorates()->saveMany($warehouse_governorates);
        }

        return redirect(route('dashboard.warehouses.index'))->with('success' , trans('warehouses.adding_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        return view('dashboard.warehouses.show' , compact('warehouse') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        $users = User::where('type' , '!='  , User::MARKETER )->get();
        $governorates = Governorate::all();
        $warehouse_governorates = $warehouse->governorates()->pluck('governorate_id')->toArray();

        return view('dashboard.warehouses.edit' , compact('warehouse' , 'warehouse_governorates' , 'governorates' , 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseRequest $request, Warehouse $warehouse)
    {

        if(!$warehouse->edit($request->all()))
            return back()->with('error' , trans('warehouses.editing_error')); 

        $warehouse_governorates = [];
        if ($request->governorates) {
            $warehouse->governorates()->delete();
            for ($i=0; $i <count($request->governorates) ; $i++) { 
                $warehouse_governorates[] = new WarehouseGovernorate([
                    'user_id' => Auth::id() , 
                    'warehouses_id' => $warehouse->id , 
                    'governorate_id' => $request->governorates[$i] , 
                ]);
            }
            $warehouse->governorates()->saveMany($warehouse_governorates);
        }
        return redirect(route('dashboard.warehouses.index'))->with('success' , trans('warehouses.editing_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function excel($warehouse)
    {
        return Excel::download(new WarehouseProductsExport($warehouse), 'warehouse_products.xlsx');
    }
}
