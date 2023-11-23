<?php

namespace App\Http\Controllers;
use App\Http\Controllers\QueryBuilder;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\User;


class SensorController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-sensor|crear-sensor|editar-sensor|borrar-sensor')->only('index');
        $this->middleware('permission:crear-sensor', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-sensor', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-sensor', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    //     $sensors = Sensor::paginate(5);
    //     return view('sensors.index', compact('sensors'));
    // }

    // public function index()
    // {
    //     // $user = auth()->user();
    //     // $sensors = $user->User::sensors()->paginate(5);
    //     $user = auth()->user();
    //     $sensors = $user->sensors()->paginate(5);
    
    //     return view('sensors.index', compact('sensors'));


    //     // return view('sensors.index', [
    //     //     'sensors' => (auth()->user())->sensors()->paginate(5)
    //     // ]);
    // }


    public function index()
    {
        // Verificar si el usuario está autenticado
        if (auth()->check()) {
            // Verificar si el usuario tiene el rol 'Administrador'
            if (auth()->user()->hasRole('Administrador')) {
                // Si es administrador, obtener todos los sensores
                $sensors = Sensor::paginate(5);
            } else {
                // Si no es administrador, obtener los sensores del usuario actual
                $user = auth()->user();
                $sensors = $user->sensors()->paginate(5);
            }
    
            return view('sensors.index', compact('sensors'));
        } else {
            // Manejar el caso en que el usuario no está autenticado
            return redirect()->route('login');
        }
    }
    


    //     public function index()
    // {
    //     if (auth()->$user()->hasRole('Administrador')) {
    //         If the user has the 'Administrador' role, show all sensors
    //         $sensors = Sensor::paginate(5);
    //     } else {
    //         If the user doesn't have 'Administrador' role, show their own sensors
    //         $sensors = auth()->user()->sensors()->paginate(5);
    //     }

    //     return view('sensors.index', compact('sensors'));
    // }


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
    // public function store(Request $request)
    // {
    //     $user_id = auth()->user()->id;

    //     request()->validate([
    //         'nombre' => 'required',
    //         'ubicacion' => 'required',
    //         'user_id' => $user_id,
    //     ]);

    //     Sensor::create($request->all());

    //     return redirect()->route('sensors.index');
    // }


    public function store(Request $request)
    {
        $user_id = auth()->user()->id;

        request()->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
        ]);

        // Add the 'usuario' field to the request data
        $requestData = $request->all();
        $requestData['usuario'] = $user_id;

        Sensor::create($requestData);

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
        return view('sensors.editar', compact('sensor'));
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
