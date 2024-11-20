@extends('layouts.custom')

@section('custom1')
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
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Project 1</h5>
                        <p class="card-text">Project Application Status: </p>
                        <div class="d-flex flex-column">
                            <a href="#" class="btn btn-primary btn-sm mb-2">View Project Details</a>
                            <a href="#" class="btn btn-primary btn-sm mb-2">View Project Progress</a>
                            <a href="#" class="btn btn-primary btn-sm mb-2">Edit Project Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
