@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Employee</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    {{--                    <a href="{{ route('college.index') }}" class="btn btn-sm btn-primary float-right">ALL</a>--}}
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
                    <a href="{{ route('employee.index',$employee->company_id) }}" class="btn btn-sm btn-primary ">Back to Employees List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.update', $employee->id) }}" method="POST" enctype="multipart/form-data" files="true">
                        @method('PUT')
                        @csrf


                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $employee->first_name }}" required autofocus>
                                    @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $employee->last_name }}" required autofocus>
                                    @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ $employee->email }}" autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $employee->phone }}" autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>


                        </div>

                        <input type="hidden" id="id" name="id" class="form-control" value="{{ $employee->id }}" required>
                        <input type="hidden" id="company_id" name="company_id" class="form-control" value="{{ $employee->company_id }}" required>

                        <input type="submit" value="Submit" class="btn btn-success">
                    </form>
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
