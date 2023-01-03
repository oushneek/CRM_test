@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Create New Company</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
{{--                    <a href="{{ route('company.index') }}" class="btn btn-sm btn-primary float-right">ALL</a>--}}
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">

                <div class="card-header" >
                    <a href="{{ route('company.index') }}" class="btn btn-sm btn-primary ">Back to Companies List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data" files="true">
                        @csrf

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="name">Company Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Company Name" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Company Email" autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="logo">Company Logo <span class="text-muted" >(Image Size Minimum 100*100)</span></label>
                                    <input type="file" id="logo" name="logo" class="form-control" value="{{ old('logo') }}" autofocus>
                                    @if ($errors->has('logo'))
                                        <span class="text-danger">{{ $errors->first('logo') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" id="website" name="website" class="form-control" value="{{ old('website') }}" placeholder="Company Website" autofocus>
                                    @if ($errors->has('website'))
                                        <span class="text-danger">{{ $errors->first('website') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div>
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
