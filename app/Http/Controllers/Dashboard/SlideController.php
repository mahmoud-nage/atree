<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Http\Requests\Dashboard\Slides\StoreSlideRequest;
use App\Http\Requests\Dashboard\Slides\UpdateSlideRequest;
use App\Jobs\DeleteImagesFromAWSJob;
class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.slides.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideRequest $request)
    {
        $slide = new Slide;
        if(!$slide->add($request->all()))
            return back()->with('error' , trans('slides.adding_error'));

        $slide->image = basename($request->file('image')->store('slides'));
        $slide->save();

        return redirect(route('dashboard.slides.index'))->with('success' , trans('slides.adding_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        $slide->load('user');
        return view('dashboard.slides.show' , compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('dashboard.slides.edit' , compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
    {
         if(!$slide->edit($request->all()))
            return back()->with('error' , trans('slides.editing_error'));

        if ($request->hasFile('image')) {
            $image = 'slides/'.$slide->image;
            DeleteImagesFromAWSJob::dispatch($image);
            $slide->image = basename($request->file('image')->store('slides'));
            $slide->save();
        }

        return redirect(route('dashboard.slides.index'))->with('success' , trans('slides.editing_success'));
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
