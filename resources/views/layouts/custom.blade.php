<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Uni10Plan</title>

    <!--below loc is nav bar-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/contacts/contact-1/assets/css/contact-1.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<div id="custom">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('project.index') }}">
            <img src="{{ asset('icons/logo.png') }}" alt="Custom Icon" height="30" class="mr-2">
            Uni10Plan
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                @can('isUser')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project.create') }}"> Project Inquiry</a>
                    </li>
                @elsecan('isManager')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project.acceptance') }}">Accept Project</a>
                    </li>
                @elsecan('isDeveloper')
                @endcan

                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <main class="py-4">
        @yield('custom1')
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
{{--<script src="{{ asset('build/assets/js/main.js') }}"></script>--}}

<script>
    $(document).ready(function() {
        // Initial setup on page load
        checkRadioButtons();

        // Handle radio button change event
        $('input[name="type"]').change(function() {
            checkRadioButtons();
        });

        // Function to show/hide fields based on the selected radio button
        function checkRadioButtons() {
            var selectedValue = $('input[name="type"]:checked').val();

            // Hide all fields initially
            $('#newSystemFields, #existingSystemFields').hide();

            // Show fields based on the selected radio button
            if (selectedValue === 'newSystem') {
                $('#newSystemFields').show();
            } else if (selectedValue === 'existingSystem') {
                $('#existingSystemFields').show();
            }
        }
    });
</script>

<script>
    // JavaScript to show/hide fields based on selected project type
    document.addEventListener('DOMContentLoaded', function () {
        var newSystemFields = document.getElementById('newSystemFields');
        var existingSystemFields = document.getElementById('existingSystemFields');

        document.querySelectorAll('input[name="projectType"]').forEach(function (radio) {
            radio.addEventListener('change', function () {
                if (this.value === 'newSystem') {
                    newSystemFields.style.display = 'block';
                    existingSystemFields.style.display = 'none';
                } else if (this.value === 'existingSystem') {
                    newSystemFields.style.display = 'none';
                    existingSystemFields.style.display = 'block';
                }
            });
        });
    });
</script>

<script>
    // Wait for the DOM to be ready
    $(document).ready(function () {
        // Attach change event listeners to start and end date inputs
        $('#startDate, #endDate').change(function () {
            // Get the values of start and end date inputs
            var startDate = new Date($('#startDate').val());
            var endDate = new Date($('#endDate').val());

            // Check if both start and end dates are valid
            if (!isNaN(startDate.getTime()) && !isNaN(endDate.getTime())) {
                // Calculate the difference in days
                var timeDiff = Math.abs(endDate.getTime() - startDate.getTime());
                var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

                // Set the calculated duration in the duration input
                $('#duration').val(diffDays);
            } else {
                // If dates are not valid, clear the duration input
                $('#duration').val('');
            }
        });
    });
</script>

</body>
</html>
