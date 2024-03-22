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
        $user = auth()->user();

        return view('employer.dashboard', [
            'jobs' => $user->jobs
        ]);
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
                'salary' => 'required|numeric|max:100000000',
            ]);

            Job::create([
                'tittle' => $request->tittle,
                'description' => $request->description,
                'employer_id' => auth()->id(),
                'state' => $request->state,
                'location' => $request->location,
                'salary' => $request->salary,
            ]);

            return redirect()->route('jobs.list')->with('success', 'Job created successfully.');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la oferta: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(Job $job)
    {
        return $job;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        try {
            $job->update($request->all());

            return response()->json(['message' => 'Oferta actualizada con éxito', 'job' => $job]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la oferta: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        try {
            $job->delete();
            return response()->json(['message' => 'Oferta eliminada exitosamente']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar la oferta: ' . $e->getMessage()], 500);
        }
    }
}
