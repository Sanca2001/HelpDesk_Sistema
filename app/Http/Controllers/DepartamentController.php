<?php

namespace App\Http\Controllers;

use App\Models\Departament;
use App\Models\Log;
use App\Models\SystemLog;
use Exception;
use Illuminate\Http\Request;

class DepartamentController extends Controller
{
    //muestra el listado de las departamentos
    public function index()
    {
        try {
            $departaments = Departament::all();
            return view('departaments.index', compact('departaments'));
        } catch (Exception $e) {
            Log::error('Error al cargar la lista de departamentos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar los departamentos.');
        }
    }

    //muestra el formulario de creacion
    public function create()
    {
        try {
            return view('departaments.create');
        } catch (Exception $e) {
            Log::error('Error al mostrar formulario de creación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo cargar el formulario de nuevo departamento.');
        }
    }

    //almacena un nuevo departamentos
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        try {
            $departament =  Departament::create($request->only('name'));

            //registrar en system_log
            SystemLog::register('departaments','create','Se creo el departamentos: ' . $departament->name);


           return redirect()->route('departaments.index')->with('success', 'Departamento registrado correctamente.');
        } catch (Exception $e) {
            Log::error('Error al registrar departamento: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el departamento.');
        }
    }

    public function edit(Departament $departament)
    {
        try {
            return view('departaments.edit', compact('departament'));
        } catch (Exception $e) {
            Log::error('Error al cargar formulario de edición: ' . $e->getMessage());
            return redirect()->route('departaments.index')->with('error', 'No se pudo cargar el formulario de edición.');
        }
    }

   //actualiza un departamento
    public function update(Request $request, Departament $departament)
    {
        $request->validate([
            'name' => 'required|string|max:100, '. $departament->id,
        ]);

        try {
            $departament->update($request->only('name'));

            //registrar en system_log
            SystemLog::register('departaments','update','Se actualizo el departamento ID: ' . $departament->id);


            return redirect()->route('departaments.index')
                ->with('success', 'Departamento actualizado correctamente.');
        } catch (Exception $e) {
            Log::error('Error al actualizar departamento: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Ocurrió un error al actualizar el departmento.');
        }
    }


    //eliminar una departamentos
    public function destroy(Departament $departament)
    {
        try {
            $departament->delete();

            SystemLog::register('departaments','delete','Se elimino el departamentos ID: ' . $departament->id);


            return response()->json(['success' => true, 'message' => 'Departamento eliminado correctamente.']);
        } catch (Exception $e) {
            Log::error('Error al eliminar departamentos: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar el departamento'
            ], 500);
        }
    }






}
