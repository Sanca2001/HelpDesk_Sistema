<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Log;
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






}
