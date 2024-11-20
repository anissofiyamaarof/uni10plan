@extends('layouts.custom')

@section('custom1')
    <div class="container mt-4">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <h2 class="mb-4 display-5 text-center">Accept or Reject Project</h2>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
    </div>

    <!--List started here-->
    <div class="container">
        <div class="row">
            <div class="col-12 mb-3 mb-lg-5">
                <div class="overflow-hidden card table-nowrap table-card">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="small text-uppercase bg-body text-muted">
                            <tr>
                                <th>Project Name</th>
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr class="align-middle">
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="h6 mb-0 lh-1">{{ $project->projectName }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $project->created_at->format('d M, Y') }}</td>
                                    <td>
                                        @if($project->applicationStatus === 'In review')
                                            <a href="{{ route('project.showToOwner', ['id' => $project->id]) }}" class="btn btn-primary btn-sm">Review</a>
                                            <a href="{{ route('project.assignmentPage', ['id' => $project->id]) }}" class="btn btn-success btn-sm">Accept</a>
                                            <form action="{{ route('project.rejectProject', ['id' => $project->id]) }}" method="get" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                            </form>
                                        @else
                                            {{ $project->applicationStatus }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
