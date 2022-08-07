@extends('layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Dashboard</h1>
        @if (is_null($placement))
            <a href="{{ route('student-placement-details') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i>
                Add Placement
            </a>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ Session::get('success') }}
                </div>
            @endif
        </div>
        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Placement Information</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @if (is_null($placement))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            You are not registered to any placement yet! Click <a href="{{ route('student-placement-details') }}">here</a> to add.
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-6">
                                <div class="small text-gray-500">Engagement Date: </div>
                                <span class="font-weight-bold">{{ $placement->engagement }}</span>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-gray-500">Supervisor's Name: </div>
                                <span class="font-weight-bold">{{ my_supervisor($placement->supervisor_id)->firstname." ".my_supervisor($placement->supervisor_id)->lastname }}</span>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-gray-500">Company Name: </div>
                                <span class="font-weight-bold">{{ $placement->company_name }}</span>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-gray-500">Company Phone: </div>
                                <span class="font-weight-bold">{{ $placement->company_phone }}</span>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-gray-500">Company Address: </div>
                                <span class="font-weight-bold">{{ $placement->company_address }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Student Information</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="small text-gray-500">Firstname: </div>
                            <span class="font-weight-bold">{{ $student->firstname }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="small text-gray-500">Lastname: </div>
                            <span class="font-weight-bold">{{ $student->lastname }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="small text-gray-500">Reg Number: </div>
                            <span class="font-weight-bold">{{ $student->regnum }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="small text-gray-500">Phone Number: </div>
                            <span class="font-weight-bold">{{ $student->phone }}</span>
                        </div>
                        <div class="col-md-6">
                            <div class="small text-gray-500">Email Address: </div>
                            <span class="font-weight-bold">{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
