<?php

namespace App\Http\Controllers\Auth;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    /**
     * Aplicar a oferta
     * @param Request $request
     * @param Job $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function applyToJob(Request $request, Job $job)
    {
        try {
            $user = auth()->user();

            if ($user->applications->contains($job)) {
                return response()->json(['message' => 'Ya aplicaste a esta oferta!!', 'status' => 'error']);
            }

            $user->applications()->attach($job->id);

            return response()->json(['message' => 'Aplicaste a esta oferta!!', 'status' => 'success']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al aplicar a la oferta: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Retirar aplicación a oferta
     * @param Request $request
     * @param Job $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function withDrawApplication(Request $request, Job $job)
    {
        try {
            $user = auth()->user();
            $user->applications()->detach($job->id);

            return response()->json(['message' => 'Retiraste tu aplicación a esta oferta!!', 'status' => 'success']);
        } catch (\Throwable $e) {
            return response()->json(['error' => 'Error al retirar tu aplicación a la oferta: ' . $e->getMessage()], 500);
        }
    }
}
