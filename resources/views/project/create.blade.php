@extends('layouts.custom')

@section('custom1')

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                <h2 class="mb-4 display-5 text-center">Project Inquiry</h2>
                <p style="text-align: justify; text-justify: inter-word;" class="text-secondary mb-5 text-center" >
                    Looking to streamline your operations with a custom system solution? We're here to help.
                    Complete the form below to tell us about your system needs. Whether it's a fresh build or enhancements to an existing platform,
                    our team is ready to manage and bring your project to life. Submit your inquiry today, and let's get started on transforming your
                    ideas into reality.</p>
                <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-lg-center">
            <div class="col-12 col-lg-9">
                <div class="bg-white border rounded shadow-sm overflow-hidden">



                    <form method="POST" action="{{route('project.store')}}">
                        @csrf
                        <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                            <div class="col-12">
                                <label for="projectName" class="form-label">Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="projectName" name="projectName" value="" required>
                            </div>
                            <div class="col-12">
                                <label for="projectDescription" class="form-label">Project Description <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="projectDescription" name="description" rows="3" required></textarea>
                            </div>

                            <div class="col-12">
                                <label for="targetDate" class="form-label">Target Completion Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="targetDate" name="targetCompletionDate" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Project Type <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="newSystem" value="newSystem" required>
                                    <label class="form-check-label" for="newSystem">New System</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="type" id="existingSystem" value="existingSystem" required>
                                    <label class="form-check-label" for="existingSystem">Enhancement of Existing System</label>
                                </div>
                            </div>

                            <div class="col-12" id="newSystemFields" style="display: none;">
                                <label for="platformTechnology" class="form-label">Platform Technology</label>
                                <input type="text" class="form-control" id="platformTechnology" name="newPlatform">

                                <label for="integrationRequirement" class="form-label">Integration Requirement</label>
                                <input type="text" class="form-control" id="integrationRequirement" name="newRequirement">
                            </div>

                            <div class="col-12" id="existingSystemFields" style="display: none;">
                                <label for="existingSystemDetails" class="form-label">Provide details about the existing system being enhanced</label>
                                <textarea class="form-control" id="existingSystemDetails" name="existDetail" rows="3"></textarea>

                                <label for="enhancementDetails" class="form-label">Describe the specific areas or features of the existing system that require enhancement</label>
                                <textarea class="form-control" id="enhancementDetails" name="existFeature" rows="3"></textarea>
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn btn-primary btn-md" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
