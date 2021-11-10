<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Programa;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $programas = Programa::all();

        $estudiantes = Estudiante::with('Programa');

        if (!empty($request->nombres)) {
            $estudiantes = $estudiantes->where('nombres', 'LIKE', '%' . $request->nombres . '%');
        }

        if (!empty($request->apellidos)) {
            $estudiantes = $estudiantes->where('apellidos', 'LIKE', '%' . $request->apellidos . '%');
        }

        if (!empty($request->email)) {
            $estudiantes = $estudiantes->where('email', 'LIKE', '%' . $request->email . '%');
        }

        if (!empty($request->tel)) {
            $estudiantes = $estudiantes->where('tel', 'LIKE', '%' . $request->tel . '%');
        }

        if (!empty($request->programa_id)) {
            $estudiantes = $estudiantes->where('programa_id', 'LIKE', '%' . $request->programa_id . '%');
        }

        return view('estudiantes.lista', ['estudiantes' => $estudiantes->paginate(5), 'programas' => $programas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programas = Programa::all();

        return view('estudiantes.registro', ['programas' => $programas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Estudiante::updateOrCreate(['email' => $request->email], $request->all());

        return redirect()->route("home")->with('success', 'Se registro exitosamente...');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show(Estudiante $estudiante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit(Estudiante $estudiante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $estudiante = Estudiante::find($request->id);
        $estudiante->update($request->all());

        return response()->json(["msg" => 'Estudiante actualizado con exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estudiante $estudiante)
    {
        //
    }
}
