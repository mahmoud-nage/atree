<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\UnitConversion;

use App\Http\Requests\Dashboard\Units\StoreUnitRequest;
use App\Http\Requests\Dashboard\Units\UpdateUnitRequest;
class UnitController extends Controller
{
    public function index()
    {
        return view('dashboard.units.index');
    }



    public function create()
    {
        $units = Unit::all();
        return view('dashboard.units.create' , compact('units'));
    }



    public function store(StoreUnitRequest $request)
    {
        $unit = new Unit;
        if(!$unit->add($request->all()))
            return redirect()->back()->with('error' , trans('units.adding_error'));

        if ($request->filled('unit_id')) {
            $factors = [];
            $factors[] = new UnitConversion([
                'main_unit_id' => $unit->id , 
                'factor' => $request->number , 
                'unit_id' => $request->unit_id , 
            ]);
            $unit->conversions()->saveMany($factors);
        }
        return redirect(route('dashboard.units.index'))->with('success' , trans('units.adding_success'));
    }


    public function show(Unit $unit)
    {
        $unit->load(['user' , 'conversions' , 'conversions.unit']);
        return view('dashboard.units.show' , compact('unit') );
    }

    public function edit(Unit $unit)
    {
        $units = Unit::all();
        return view('dashboard.units.edit' , compact('units' , 'unit'));
    }


    public function update(UpdateUnitRequest $request , Unit $unit)
    {
         if(!$unit->edit($request->all()))
            return redirect()->back()->with('error' , trans('units.editing_error'));

        if ($request->filled('unit_id')) {
            $unit->conversions()->delete();
            $factors = [];
            $factors[] = new UnitConversion([
                'main_unit_id' => $unit->id , 
                'factor' => $request->number , 
                'unit_id' => $request->unit_id , 
            ]);
            $unit->conversions()->saveMany($factors);
        }
        return redirect(route('dashboard.units.index'))->with('success' , trans('units.editing_success'));
    }

}
