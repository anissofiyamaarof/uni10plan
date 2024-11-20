<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
    {
            // Fetch all projects
            $projects = Project::all();
            $users = User::all();
            return view('project.index', ['projects' => $projects],['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

            $validated = $request->validate([
                'projectName' => 'required|min:1|string',
                'description' => 'required|min:4|string',
                'targetCompletionDate' => 'required|date',
                'type' => 'required',
                'newPlatform' => 'required_if:type,newSystem',
                'newRequirement' => 'required_if:type,newSystem',
                'existDetail' => 'required_if:type,existingSystem',
                'existFeature' => 'required_if:type,existingSystem',
            ]);

            $project = new Project;

            $project->projectName = $validated['projectName'];
            $project->description = $validated['description'];
            $project->targetCompletionDate = $validated['targetCompletionDate'];
            $project->type = $validated['type'];
            $project->newPlatform = $validated['newPlatform'];
            $project->newRequirement = $validated['newRequirement'];
            $project->existDetail = $validated['existDetail'];
            $project->existFeature = $validated['existFeature'];
            $project->user_id = Auth::id();

            $project->save();

            return redirect()->route('project.index')
                ->withSuccess('New applied project added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id) //show to manager and developer
    {
        $project = Project::with('user')->find($id);
        $users = User::all();
        return view('project.show', ['project' => $project], ['users' => $users]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::with('user')->find($id);
        $users = User::all();
        return view('project.edit', ['project' => $project], ['users' => $users]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'duration' => 'required',
            'system_pic_id' => 'required',
            'lead_developer_id' => 'required',
            'developer_ids' => 'required|array'
        ]);

        $project = Project::findOrFail($id);
        $project->developers()->sync($validated['developer_ids']);
        $project->update($validated);
        return redirect()->route('project.show', ['id' => $id])->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function showToOwner($id)
    {
        $project = Project::with('owner')->find($id);
        return view('project.showToOwner', ['project' => $project]);
    }

    public function acceptance()
    {
        $projects = Project::all(); // Fetch all projects or use your logic to get the projects

        return view('project.acceptance', ['projects' => $projects]);
    }

    public function acceptProject($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        // Update the project application status to "Accepted"
        $project->applicationStatus = 'Accepted';
        $project->save();

        return redirect()->route('project.acceptance', ['id' => $id])
            ->withSuccess('Project accepted');
    }

    public function rejectProject($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        // Update the project application status to "Rejected"
        $project->applicationStatus = 'Rejected';
        $project->save();

        return redirect()->back()->with('success', 'Project rejected successfully');
    }

    public function assignProject(Request $request, $id)
    {

        $validated = $request->validate([
            'system_pic_id' => 'required',
            'lead_developer_id' => 'required',
            'developer_ids' => 'required|array',
            'startDate' => 'required|date',
            'endDate' => 'required|date',
            'duration' => 'required',
        ]);

        $project = Project::findOrFail($id);
        $project->developers()->sync($validated['developer_ids']);

        $project->update([
            'system_pic_id' => $validated['system_pic_id'],
            'lead_developer_id' => $validated['lead_developer_id'],
            'startDate' => $validated['startDate'],
            'endDate' => $validated['endDate'],
            'duration' => $validated['duration'],
        ]);

        $project->save();

        return redirect()->route('project.acceptProject', ['id' => $id]);

    }

    public function assignmentPage($id)
    {

        $project = Project::with('developers')->find($id);
        $users = User::all();
        return view('project.assignment', ['project' => $project, 'users' => $users]);
    }

}
