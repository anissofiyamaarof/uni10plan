<?php

namespace App\Http\Controllers;

use App\Models\Progress;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
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
    public function create($id)
    {
        $project = Project::find($id);
        if (!$project) {
            // Handle the case where the project is not found, e.g., redirect or show an error
            return redirect()->route('projects.index')->with('error', 'Project not found');
        }

        return view('progress.create', compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $project)
    {
        $validated = $request->validate([
            'progressStatus' => 'required|in:ahead,on_schedule,delayed,completed',
            'progressDate' => 'required|date',
            'progressDescription' => 'required|string',
        ]);

        $progress = new Progress;
        $progress->progressStatus = $validated['progressStatus'];
        $progress->progressDate = $validated['progressDate'];
        $progress->progressDescription = $validated['progressDescription'];
        $progress->project_id = $project;

        $progress->save();

        return redirect()->route('project.index')->with('success', 'Progress created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($projectId)
    {
        $progresses = Progress::where('project_id', $projectId)->get();
        return view('progress.show', compact('progresses'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Progress $progress)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Progress $progress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        //
    }
}
