@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Employees of {{ $company->name }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('employee.create',$company->id) }}" class="btn btn-sm btn-primary ">Add New Employee</a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    @if(count($employees))
                        <table id="example" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{$employee->first_name}} {{$employee->last_name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                    <td>
                                        <div class="row">

                                            <a class="btn btn-info btn-sm" href="{{ route('employee.edit', $employee->id) }}">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>

                                            <form method="POST" action="{{ route('employee.delete',$employee->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class='btn btn-danger' type='submit' value='submit' onclick= "return confirm('Are You Sure Want to Delete?')">
                                                    <i class='fa fa-trash'> </i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        <h3>No Data to Dispalay</h3>
                    @endif
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $employees->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </section>

    <!-- /.content -->
@endsection

@section('styles')

@endsection


@section('scripts')
@endsection
