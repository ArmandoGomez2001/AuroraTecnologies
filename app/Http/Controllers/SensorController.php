<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sensor;

class SensorController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-sensor|crear-sensor|editar-sensor|borrar-sensor')->only('index');
        $this->middleware('permission:crear-sensor', ['only' => ['create','store']]);
        $this->middleware('permission:editar-sensor', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-sensor', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sensors = Sensor::paginate(5);
         return view('sensors.index',compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('sensors.crear');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
        ]);
    
        Sensor::create($request->all());
    
        return redirect()->route('sensors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sensor $sensor)
    {
        return view('sensors.editar',compact('sensor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sensor $sensor)
    {
        request()->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
        ]);
    
        $sensor->update($request->all());
    
        return redirect()->route('sensors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();
    
        return redirect()->route('sensors.index');
    }
}
