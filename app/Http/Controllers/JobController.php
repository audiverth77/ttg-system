<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::where('employer_id', auth()->id())->get();
        return view('employer.dashboard', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'tittle' => 'required|string|max:255',
                'description' => 'required|string',
                'state' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                // 'state' => 'required|in:disponible,cerrado',
                // 'location' => 'required|in:remoto,presencial',
                'salary' => 'required|string|max:255',
            ]);

            if (!auth()->check()) {
                return redirect()->route('login')->with('error', 'Debe estar autenticado para crear una oferta.');
            }

            // dd($employer);
            $job = Job::create([
                'tittle' => $request->tittle,
                'description' => $request->description,
                'employer_id' => auth()->id(),
                'state' => $request->state,
                'location' => $request->location,
                'salary' => $request->salary,
            ]);

            // return response()->json(['message' => 'Oferta creada exitosamente']);
            return redirect()->route('jobs.list')->with('success', 'Job created successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la oferta: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return Job::where('id', $id)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $job = Job::findOrFail($id);
            $job->update($request->all());

            return response()->json(['message' => 'Oferta actualizada con éxito', 'job' => $job]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la oferta: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $job = Job::findOrFail($id);
            $job->delete();
            return response()->json(['message' => 'Oferta eliminada exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la oferta: ' . $e->getMessage()], 500);
        }
    }

}
