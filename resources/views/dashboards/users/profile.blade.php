<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Results</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f8f9fa; /* Light background for contrast */
        }
        .card {
            border: none; /* Remove default card border */
            border-radius: 10px; /* Rounded corners for the card */
        }
        .table th, .table td {
            text-align: center; /* Center text in table cells */
        }
        .table thead th {
            background-color: #343a40; /* Dark background for the header */
            color: white; /* White text for header */
        }
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Light gray background on hover */
        }
    </style>
</head>
<body>

<main class="bmd-layout-content">
    <div class="container-fluid">
        <div class="col-xs-1 col-sm-1 col-md-12 col-lg-12 p-2">
            <div class="card shade h-100">
                <div class="card-body text-center"> <!-- Align body text to the right -->
                    <h4>Hi user: {{ Auth::user()->name }}</h4>
                    <hr>
                    <h5>Your Results</h5>
                    <div class="table-responsive"> <!-- Make table responsive -->
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">نمره</th>
                                    <th scope="col">جواب غلط</th>
                                    <th scope="col">جواب درست</th>
                                    <th scope="col">نام امتحان</th>
                                    <th scope="col">شماره</th> <!-- Number header moved to the last -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->points }}</td>
                                    <td>{{ $result->incorrectanswer }}</td>
                                    <td>{{ $result->correctanswer }}</td>
                                    <td>{{ $result->exam ? $result->exam->sub_name : 'N/A' }}</td>
                                    <th scope="row">{{ $loop->iteration }}</th> <!-- Number moved to the last -->
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center"> <!-- Align pagination to the right -->
                            {{-- Pagination if needed  --}}
                             {{ $results->links() }}
                        </div>
                        <div class="text-end">
                            <a href="{{ route('admin.index') }}" class="btn btn-primary">برگشت به صفحه امتحانات</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>