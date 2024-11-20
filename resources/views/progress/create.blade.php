@extends('layouts.custom2')

@section('custom2')

    <div class="container mt-4">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <h2 class="mb-4 display-5 text-center">Create Project Progress</h2>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="card mb-3 card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <form action="{{route('progress.store', ['id' => $project->id])}}" method="post">
                                @csrf
                                <div class="text-muted overflow-hidden flex-nowrap">
                                    <div class="mb-2 small">
                                        <label for="progressStatus" class="form-label">Status:</label>
                                        <select class="form-control" id="progressStatus" name="progressStatus" required>
                                            <option value="ahead">Ahead of Schedule</option>
                                            <option value="on_schedule">On Schedule</option>
                                            <option value="delayed">Delayed</option>
                                            <option value="completed">Completed</option>
                                        </select>
                                    </div>
                                    <div class="mb-2 small">
                                        <label for="progressDate" class="form-label">Progress Date:</label>
                                        <input type="date" class="form-control" id="progressDate" name="progressDate" value="" required>
                                    </div>
                                    <div class="mb-2 small">
                                        <label for="progressDescription" class="form-label">Progress Description:</label>
                                        <textarea class="form-control" id="progressDescription" name="progressDescription" rows="3" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn btn-primary btn-md" type="submit">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection




