@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Company</h1>
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
                    <a href="{{ route('company.index') }}" class="btn btn-sm btn-primary ">Back to Company List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data" files="true">
                        @method('PUT')
                        @csrf


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="college_name">Company Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="{{ $company->name }}" required>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" value="{{ $company->email }}">
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    @if($company->logo!=null)
                                        <img src="{{ URL::asset('/images/'.$company->logo)}}" style="max-height:100px ;max-width: 100px" />
                                    @else
                                        <p>No Logo Saved Yet.</p>
                                    @endif
                                    <input type="file" id="logo" name="logo" class="form-control" value="{{ $company->logo }}" >
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" id="website" name="website" class="form-control" value="{{ $company->website }}" >
                                </div>
                            </div>


                        </div>

                        <input type="hidden" id="id" name="id" class="form-control" value="{{ $company->id }}" required>


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
