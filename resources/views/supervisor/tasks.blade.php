@extends('layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Supervisor Tasks</h1>
        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i>
            Generate Report
        </a> --}}
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
        <div class="col-xl-12 col-md-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tasks Set</h6>
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
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-container">
                            <table class="table table-borderless datatable dataTable-table">
                                <thead>
                                    <tr>
                                        <th scope="col" data-sortable="" >
                                            #
                                        </th>
                                        <th scope="col" data-sortable="" >
                                            Firstname
                                        </th>
                                        <th scope="col" data-sortable="" >
                                            Lastname
                                        </th>
                                        <th scope="col" data-sortable="">
                                            Task
                                        </th>
                                        <th scope="col" data-sortable="">
                                            Status
                                        </th>
                                        <th scope="col" data-sortable="">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach ($tasks as $item)
                                        <tr>
                                            <th scope="row">
                                                <a href="#">
                                                    @php
                                                        $count++;
                                                        echo $count;
                                                    @endphp
                                                </a>
                                            </th>
                                            <td>{{ $item->firstname }}</td>
                                            <td>{{ $item->lastname }}</td>
                                            <td>{{ $item->task }}</td>
                                            <td>
                                                @if ($item->done)
                                                    <span class="badge bg-success">completed</span>
                                                @else
                                                    <span class="badge bg-warning">not complete</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (!$item->done)
                                                    <a href="{{ route('supervisor-approve-task', $item->id) }}" class="btn btn-success btn-sm">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="dataTable-bottom">
                            <div class="dataTable-info">

                            </div>
                            <nav class="dataTable-pagination">
                                <ul class="dataTable-pagination-list"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection