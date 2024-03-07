<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationJob;

class ApplicationJobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try{
        $request->validate([
            'job_id' => 'required|string|max:255',
        ]);

        $existingApplication = ApplicationJob::where('job_id', $request->job_id)
        ->where('candidate_id', auth()->id())
        ->first();

        if ($existingApplication) {
            return response()->json(['message' => 'Ya has aplicado a esta oferta anteriormente.', 'status' => 'warning', "exists" => $existingApplication]); // 409 Conflict
        }

        // else{
            $application  = ApplicationJob::create([
                'job_id' => $request->job_id,
                'candidate_id' => auth()->id(),
                'application_date' =>date("Y-m-d H:i:s"),
            ]);
        // }
        
        return response()->json(['message' => 'Aplicaste a esta oferta!!', 'status' => 'success']);
        

        }catch (\Exception $e) {
            return response()->json(['error' => 'Error al crear la oferta: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ApplicationJob::where('id', $id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
