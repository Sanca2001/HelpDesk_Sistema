<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Log;
use App\Models\SystemLog;
use Exception;
use Illuminate\Http\Request;
use PgSql\Lob;

class FaqController extends Controller
{

    //muestra el listado de las categorias
    public function index()
    {
        try {
            $faqs = Faq::all();
            return view('faqs.index', compact('faqs'));
        } catch (Exception $e) {
            Log::error('Error al cargar la lista de faqs: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar los faqs');
        }
    }

    //muestra el formulario de creacion
    public function create()
    {
        try {
            return view('faqs.create');
        } catch (Exception $e) {
            Log::error('Error al mostrar formulario de creación: ' . $e->getMessage());
            return redirect()->back()->with('error', 'No se pudo cargar el formulario de nuevo faqs.');
        }
    }

    //almacena una nueva categoria
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $faq =  Faq::create($request->only('title', 'description'));

            //registrar en system_log
            SystemLog::register('faqs', 'create', 'Se creo el faqs: ' . $faq->name);

            return redirect()->route('faqs.index')->with('success', 'FAQ registrado correctamente.');
        } catch (Exception $e) {
            Log::error('Error al registrar faq: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al registrar el faq.');
        }
    }

    public function edit(Faq $faq)
    {
        try {
            return view('faqs.edit', compact('faq'));
        } catch (Exception $e) {
            Log::error('Error al cargar formulario de edición: ' . $e->getMessage());
            return redirect()->route('faqs.index')->with('error', 'No se pudo cargar el formulario de edición.');
        }
    }


    //actualiza una categoria
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'title' => 'required|string|max:100, '. $faq->id,
            'description' => 'nullable|string|max:255',
        ]);

        try {
            $faq->update($request->only('title', 'description'));

            //registrar en system_log
            SystemLog::register('faqs','update','Se actualizo el FAQ ID: ' . $faq->id);


            return redirect()->route('faqs.index')
                ->with('success', 'FAQ actualizado correctamente.');
        } catch (Exception $e) {
            Log::error('Error al actualizar el FAQ: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Ocurrió un error al actualizar el FAQ.');
        }
    }

    //eliminar una categoria
    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            SystemLog::register('faqs','delete','Se elimino el FAQ ID: ' . $faq->id);

            return response()->json(['success' => true, 'message' => 'FAQ eliminado correctamente.']);
        } catch (Exception $e) {
            Log::error('Error al eliminar el FAQ: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'No se pudo eliminar el FAQ.'
            ], 500);
        }
    }






}
