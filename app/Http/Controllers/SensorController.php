<?php

namespace App\Http\Controllers;

use App\Http\Controllers\QueryBuilder;

use Illuminate\Http\Request;
use App\Models\Sensor;
use App\Models\User;
use App\Models\Ubicaciones;


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


    public function index()
    {
        // Verificar si el usuario está autenticado
        if (auth()->check()) {
            $ubicacion = Ubicaciones::all(); 
            // Verificar si el usuario tiene el rol 'Administrador'
            if (auth()->user()->hasRole('Administrador')) {
                // Si es administrador, obtener todos los sensores
                $sensors = Sensor::paginate(5);
                
            } else {
                // Si no es administrador, obtener los sensores del usuario actual
                $user = auth()->user();
                $sensors = $user->sensors()->paginate(5);
            }

            return view('sensors.index', compact('sensors', 'ubicacion'));
        } else {
            // Manejar el caso en que el usuario no está autenticado
            return redirect()->route('login');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::pluck('email', 'id')->all();
        $ubicaciones = Ubicaciones::all();
        return view('sensors.crear', compact('usuarios', 'ubicaciones'));
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
            'code_sensor' => 'required',
            'name_aparato' => 'required',
            'usuario' => 'required',
         ]);

        $ubicacion = intval($request->input('ubicaciones'));

        Sensor::create([
            'code_sensor' => $request->input('code_sensor'),
            'name_aparato' => $request->input('name_aparato'),
            'usuario' => $request->input('usuario'),
            'ubicacion' => $ubicacion
        ]);

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
        $usuarios = User::pluck('email', 'id')->all();
        $ubicaciones = Ubicaciones::all();

        return view('sensors.editar', compact('sensor', 'usuarios', 'ubicaciones'));
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
            'code_sensor' => 'required',
            'name_aparato' => 'required',
            'usuario' => 'required', // Asegúrate de que el campo user_id sea requerido
        ]);
        $ubicacion = intval($request->input('ubicaciones'));
        $sensor->update([
            'code_sensor' => $request->input('code_sensor'),
            'name_aparato' => $request->input('name_aparato'),
            'usuario' => $request->input('usuario'),
            'ubicacion' => $ubicacion
        ]);

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
