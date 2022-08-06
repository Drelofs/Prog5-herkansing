<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user_id = auth()->id();
        // $cars = Car::all();
        $cars = DB::table('cars')->where('user_id', '=', $user_id)->get();
        return view('car.index', compact('cars'));
    }

    public function search(Request $request){
        // Get the search value from the request
        $q = $request->input('search');
    
        // Search in the title and body columns from the posts table
        $cars = Car::query()
            ->where('name', 'LIKE', "%{$q}%")
            ->orWhere('description', 'LIKE', "%{$q}%")
            ->orWhere('model', 'LIKE', "%{$q}%")
            ->orWhere('year', 'LIKE', "%{$q}%")
            // ->join('cars', 'cars.user_id', '=', 'users.id')
            ->get();
    
        // Return the search view with the resluts compacted
        return view('car.search', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required',
            'description'  => 'required',
            'price'  => 'required',
            'user_id' => 'required'

        ]);        
        Car::create($request->all());        
        return redirect()->route('car.index')->with('success', 'Car created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return view('car.show', compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        return view('car.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $request->validate([
            'name' => 'required',
            'model' => 'required',
            'year' => 'required',
            'description'  => 'required',
            'price'  => 'required',
        ]);        
        $car->update($request->all());        
        return redirect()->route('car.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();        
        return redirect()->route('car.index')->with('success', 'Car deleted successfully');
    }
}
