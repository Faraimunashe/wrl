@extends('layouts.main')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Supervisor Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-1"></i>
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Students</h6>
                </div>
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
                                            Reg Number
                                        </th>
                                        <th scope="col" data-sortable="">
                                            Phone
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
                                    @foreach (my_students() as $item)
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
                                            <td>{{ $item->regnum }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>
                                                <a href="{{ route('supervisor-usertasks', $item->id) }}" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('supervisor-logbook', $item->id) }}" class="btn btn-outline-warning btn-sm">
                                                    <i class="fas fa-file-pdf"></i>
                                                </a>
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
    </div>

@endsection
