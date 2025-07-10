<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use PgSql\Lob;

class UserController extends Controller
{

    //muestra el listado de las departamentos
    public function index()
    {
        try {
            $users = User::all();
            return view('users.index', compact('users'));
        } catch (Exception $e) {
            Log::error('Error al cargar la lista de usuarios: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar los usuarios.');
        }
    }

    //muestra el formulario de creacion
    public function create()
    {
        try {
            return view('users.create');
        } catch (Exception $e) {
            Log::error('Error al mostrar formulario de creación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo cargar el formulario de nuevo usuario.');
        }
    }

    //almacena un nuevo departamentos
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:100',
        // ]);

        // try {
        //     $departament =  Departament::create($request->only('name'));

        //     //registrar en system_log
        //     SystemLog::register('departaments','create','Se creo el departamentos: ' . $departament->name);


        //    return redirect()->route('departaments.index')->with('success', 'Departamento registrado correctamente.');
        // } catch (Exception $e) {
        //     Log::error('Error al registrar departamento: ' . $e->getMessage());
        //     return redirect()->back()->with('error', 'Ocurrió un error al registrar el departamento.');
        // }
    }

    public function edit(User $user)
    {
        // try {
        //     return view('departaments.edit', compact('departament'));
        // } catch (Exception $e) {
        //     Log::error('Error al cargar formulario de edición: ' . $e->getMessage());
        //     return redirect()->route('departaments.index')->with('error', 'No se pudo cargar el formulario de edición.');
        // }
    }

    //actualiza un departamento
    public function update(Request $request, User $user)
    {
        // $request->validate([
        //     'name' => 'required|string|max:100, '. $departament->id,
        // ]);

        // try {
        //     $departament->update($request->only('name'));

        //     //registrar en system_log
        //     SystemLog::register('departaments','update','Se actualizo el departamento ID: ' . $departament->id);


        //     return redirect()->route('departaments.index')
        //         ->with('success', 'Departamento actualizado correctamente.');
        // } catch (Exception $e) {
        //     Log::error('Error al actualizar departamento: ' . $e->getMessage());

        //     return redirect()->back()
        //         ->with('error', 'Ocurrió un error al actualizar el departmento.');
        // }
    }


    //eliminar una departamentos
    public function destroy(User $user)
    {
        // try {
        //     $departament->delete();

        //     SystemLog::register('departaments','delete','Se elimino el departamentos ID: ' . $departament->id);


        //     return response()->json(['success' => true, 'message' => 'Departamento eliminado correctamente.']);
        // } catch (Exception $e) {
        //     Log::error('Error al eliminar departamentos: ' . $e->getMessage());

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'No se pudo eliminar el departamento'
        //     ], 500);
        // }
    }
}
