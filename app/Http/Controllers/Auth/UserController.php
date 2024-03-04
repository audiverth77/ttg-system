<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Mostrar el formulario de registro para empleadores.
     *
     * @return \Illuminate\View\View
     */
    public function viewEmployer()
    {
        return view('auth.register_employer');
    }

    /**
     * Mostrar el formulario de registro para candidatos.
     *
     * @return \Illuminate\View\View
     */
    public function viewCandidate()
    {
        return view('auth.register_candidate');
    }
}
