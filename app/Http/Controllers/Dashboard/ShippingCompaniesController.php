<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Shipping_companies\StoreShippingCompaniesRequest;
use App\Http\Requests\Dashboard\Shipping_companies\UpdateShippingCompaniesRequest;
use App\Models\ShippingCompanies;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class ShippingCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('dashboard.shipping_companies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('dashboard.shipping_companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShippingCompaniesRequest $request
     * @return Application
     */
    public function store(StoreShippingCompaniesRequest $request)
    {
        $record = new ShippingCompanies();
        $record->setTranslation('name' , 'ar' , $request->name_ar );
        $record->setTranslation('name' , 'en' , $request->name_en );
        $record->is_active = $request->filled('is_active') ? 1 : 0;
        $record->save();

        return redirect(route('dashboard.shipping_companies.index'))->with('success', __('messages.created_successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $record = ShippingCompanies::findOrFail($id);
        return view('dashboard.shipping_companies.show' , compact('record') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $record = ShippingCompanies::findOrFail($id);
        return view('dashboard.shipping_companies.edit' , compact('record') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateShippingCompaniesRequest $request
     * @param $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateShippingCompaniesRequest $request, $id)
    {
        $record = ShippingCompanies::findOrFail($id);
        $record->setTranslation('name' , 'ar' , $request->name_ar );
        $record->setTranslation('name' , 'en' , $request->name_en );
        $record->is_active = $request->filled('is_active') ? 1 : 0;
        $record->save();
        return redirect(route('dashboard.shipping_companies.index'))->with('success', __('messages.updated_successfully'));
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
