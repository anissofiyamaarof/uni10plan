@extends('layouts.custom')

@section('custom1')
    @can('isUser')
        <div class="container mt-4">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="mb-4 display-5 text-center">List of Project Application</h2>
                    <p style="text-align: justify; text-justify: inter-word;" class="text-secondary mb-5 text-center" >
                        Stay informed about the applied project details, and application status of each project.</p>
                    <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container mt-4 mb-4">
            <div class="row">
                @foreach(auth()->user()->appliedProjects as $project)
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $project->projectName }}</h5>
                                <p class="card-text">Application Status: {{ $project->applicationStatus }}</p>
                                <a href="{{ route('project.showToOwner', ['id' => $project->id]) }}" class="btn btn-primary btn-sm">View Project Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elsecan('isManager')
        <div class="container mt-4">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="mb-4 display-5 text-center">List of Project Accepted</h2>
                    <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                @foreach($projects as $project)
                    @if($project->applicationStatus === 'Accepted')
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $project->projectName }}</h5>
                                    <p class="card-text">Project Application Status: {{ $project->applicationStatus }}</p>
                                    <div class="d-flex flex-column">
                                        <a href="{{route('project.show', ['id' => $project->id])}}" class="btn btn-primary btn-sm mb-2">View Project Details</a>
                                        <a href="{{route('progress.show', ['id' => $project->id])}}" class="btn btn-primary btn-sm mb-2">View Progress</a>
                                        <a href="{{route('project.edit', ['id' => $project->id])}}" class="btn btn-primary btn-sm mb-2">Edit Project Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    @elsecan('isDeveloper')
        <div class="container mt-4">
            <div class="row justify-content-md-center">
                <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                    <h2 class="mb-4 display-5 text-center">List of Project Assigned</h2>
                    <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                @foreach($projects as $project)
                    @if($project->applicationStatus === 'Accepted' && ($project->developers->contains(Auth::user()->id) || $project->lead_developer_id == Auth::user()->id))
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                    <h5 class="card-title">{{ $project->projectName }}</h5>
                                    @if ($project->lead_developer_id == Auth::user()->id)
                                        <p class="card-text">Position: Lead Developer </p>
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <a href="{{route('progress.create', ['id' => $project->id])}}" class="btn btn-primary btn-sm btn-block">Create Progress</a>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <a href="{{route('project.show', ['id' => $project->id])}}" class="btn btn-primary btn-sm btn-block">View Project Details</a>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <a href="{{route('progress.show', ['id' => $project->id])}}" class="btn btn-primary btn-sm btn-block">View Progress</a>
                                            </div>
                                        </div>
                                    @elseif ($project->developers->contains(Auth::user()->id) )
                                        <p class="card-text">Position: Developer </p>
                                        <div class="row">
                                            <div class="col-6 mb-2">
                                                <a href="{{route('project.show', ['id' => $project->id])}}" class="btn btn-primary btn-sm btn-block">View Project Details</a>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <a href="{{route('progress.show', ['id' => $project->id])}}" class="btn btn-primary btn-sm btn-block">View Progress</a>
                                            </div>
                                        </div>
                                    @endif
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>

    @else
    @endcan

@endsection
