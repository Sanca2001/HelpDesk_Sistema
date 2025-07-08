<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use App\Models\SystemLog;
use Exception;
use Illuminate\Http\Request;
use PgSql\Lob;

class CategoryController extends Controller
{


    //muestra el listado de las categorias
    public function index()
    {
        try {
            $categories = Category::all();
            return view('categories.index', compact('categories'));
        } catch (Exception $e) {
            Log::error('Error al cargar la lista de categorías: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar las categorías.');
        }
    }


    //muestra el formulario de creacion
    public function create()
    {
        try {
            return view('categories.create');
        } catch (Exception $e) {
            Log::error('Error al mostrar formulario de creación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo cargar el formulario de nueva categoría.');
        }
    }

    //almacena una nueva categoria
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $category =  Category::create($request->only('name', 'description'));

            //registrar en system_log
            SystemLog::register('categories','create','Se creo la categoria: ' . $category->name);


            return redirect()->route('categories.index')->with('success', 'Categoría registrada correctamente.');
        } catch (Exception $e) {
            Log::error('Error al registrar categoría: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al registrar la categoría.');
        }
    }

    public function edit(Category $category)
    {
        try {
            return view('categories.edit', compact('category'));
        } catch (Exception $e) {
            Log::error('Error al cargar formulario de edición: ' . $e->getMessage());
            return redirect()->route('categories.index')->with('error', 'No se pudo cargar el formulario de edición.');
        }
    }

    //actualiza una categoria
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:100, '. $category->id,
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $category->update($request->only('name', 'description'));

            //registrar en system_log
            SystemLog::register('categories','update','Se actualizo la categoria ID: ' . $category->id);


            return redirect()->route('categories.index')
                ->with('success', 'Categoría actualizada correctamente.');
        } catch (Exception $e) {
            Log::error('Error al actualizar categoría: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Ocurrió un error al actualizar la categoría.');
        }
    }

    //eliminar una categoria
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            SystemLog::register('categories','delete','Se elimino la categoria ID: ' . $category->id);


            return response()->json(['success' => true, 'message' => 'Categoría eliminada correctamente.']);
        } catch (Exception $e) {
            Log::error('Error al eliminar categoría: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar la categoría.'
            ], 500);
        }
    }
}
