@extends('layouts.custom')

@section('custom1')
    <div class="container mt-4">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <h2 class="mb-4 display-5 text-center">Project Details</h2>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-12 col-lg-9">
                <div class="bg-white border rounded shadow-sm overflow-hidden">

                    <form action="#!">
                        <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                            <div class="col-12">
                                <label for="application_status" class="form-label">Project Application Status <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="application_status" name="application_status" value="{{ $project->applicationStatus }}" required readonly>
                            </div>
                            <div class="col-12">
                                <label for="fullname" class="form-label">Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ $project->projectName }}" required readonly>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label">Project Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="message" name="message" rows="3" required readonly>{{ $project->description }}</textarea>
                            </div>
                            <div class="col-12">
                                <label for="fullname" class="form-label">Requestor Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{ Auth::user()->name }}" required readonly>
                            </div>
                            <div class="col-12">
                                <label for="requestDate" class="form-label">Target Completion Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="requestDate" name="requestDate" value="{{ $project->targetCompletionDate }}" required readonly>
                            </div>



                            <div class="col-12">
                                <label class="form-label">Project Type <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="projectType" id="newSystem" value="newSystem" {{ $project->type === 'newSystem' ? 'checked readonly' : '' }}>
                                    <label class="form-check-label" for="newSystem">New System</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="projectType" id="existingSystem" value="existingSystem" {{ $project->type === 'existingSystem' ? 'checked readonly' : '' }}>
                                    <label class="form-check-label" for="existingSystem">Enhancement of Existing System</label>
                                </div>
                            </div>

                            <div class="col-12" id="newSystemFields" style="{{ $project->type === 'newSystem' ? '' : 'display: none;' }}">
                                <label for="platformTechnology" class="form-label">Platform Technology</label>
                                <input type="text" class="form-control" id="platformTechnology" name="platformTechnology" value="{{ $project->newPlatform }}" readonly>

                                <label for="integrationRequirement" class="form-label">Integration Requirement</label>
                                <input type="text" class="form-control" id="integrationRequirement" name="integrationRequirement" value="{{ $project->newRequirement }}" readonly>
                            </div>

                            <div class="col-12" id="existingSystemFields" style="{{ $project->type === 'existingSystem' ? '' : 'display: none;' }}">
                                <label for="existingSystemDetails" class="form-label">Provide details about the existing system being enhanced</label>
                                <textarea class="form-control" id="existingSystemDetails" name="existingSystemDetails" rows="3" readonly>{{ $project->existDetail }}</textarea>

                                <label for="enhancementDetails" class="form-label">Describe the specific areas or features of the existing system that require enhancement</label>
                                <textarea class="form-control" id="enhancementDetails" name="enhancementDetails" rows="3" readonly>{{ $project->existFeature }}</textarea>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
