<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarsRequest;
use App\Http\Requests\UpdateCarsRequest;
use App\Models\Cars;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Cars::all();
        return view('cars.index', compact('cars')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarsRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);        
        Cars::create($request->all());        
        return redirect()->route('cars.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function show(Cars $cars)
    {
        return view('cars.show', compact('cars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function edit(Cars $cars)
    {
        return view('cars.edit', compact('cars'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarsRequest  $request
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarsRequest $request, Cars $cars)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);        
        $cars->update($request->all());        
        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cars  $cars
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cars $cars)
    {
        $cars->delete();        
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully');
    }
}
