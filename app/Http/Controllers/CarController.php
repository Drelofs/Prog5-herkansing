<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use DateTime;


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
    public function store(Request $request)
    {
        // $test = auth()->user()->created_at;
        // $date  = new DateTime;
        // $date->modify('-60 minutes');
        // dd($date);

        if(auth()->user()->login_count->login_count > 5 && auth()->user()->status){
            $request->validate([
                'name' => 'required',
                'model' => 'required',
                'year' => 'required|integer|min:1900|max:2022',
                'description'  => 'required',
                'image' => 'required|mimes:jpeg,jpg,bmp,png|max:16384',
                'price'  => 'required',
                'user_id' => 'required'

            ]);

            $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

            $request->image->move(public_path('images'), $newImageName);

            $car = Car::create([
                'name' => $request->input('name'),
                'model' => $request->input('model'),
                'year' => $request->input('year'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'type' => $request->input('type'),
                'user_id' => auth()->id(),
                'image_path' => $newImageName
            ]);
        }
        else{
            return redirect()->route("car.index")->with("error", "You can't add cars");
        }
             
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
        if (Auth::user()->id === $car->user_id){
            return view('car.edit', compact('car'));
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        if (Auth::user()->id === $car->user_id){
            $request->validate([
                'name' => 'required',
                'model' => 'required',
                'year' => 'required',
                'description'  => 'required',
                'image' => 'mimes:jpeg,jpg,bmp,png|max:16384',
                'price'  => 'required',
            ]);

            if($request->hasFile('image')){
                $imageName = time() . '-' . $request->name . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                File::delete(public_path("images/" . $car->image_path));
            }
            else{
                $imageName = $car->image_path;
            }

            Car::where('id', $car->id)->update([
                'name' => $request->input('name'),
                'model' => $request->input('model'),
                'year' => $request->input('year'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'image_path' => $imageName
            ]);       
            return redirect()->route('car.index')->with('success', 'Car updated successfully.');
        } 
        else {
            return redirect()->route('car.index')->with('failure', "Car is not yours!");
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        File::delete(public_path("images/" . $car->image_path));
        $car->delete();        
        return redirect()->route('car.index')->with('success', 'Car deleted successfully');
    }
}
