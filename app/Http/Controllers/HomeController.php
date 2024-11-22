<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OfertaLaboral;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // Método para la página principal (home)
    public function index()
    {
        return view('home'); 
    }

    // Método para la vista de "Ofertas Laborales"
    public function arca()
    {
        $ofertas = OfertaLaboral::all();
        return view('arca.index', compact('ofertas'));
  
    }

  
    


    public function infolaboral()
    {
        $user = Auth::user();
        
        $infoLaborales = $user->infoLaborals;  

        return view('arca.infolaboral', compact('infoLaborales', 'user'));
    }
    
    


    


    

    // Método para la vista de "Información Personal"
    public function infopersonal()
    {
        return view('arca.infopersonal'); 
    }
}
