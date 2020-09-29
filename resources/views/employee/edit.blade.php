@extends('layouts.master')
@section('title')
  About Us
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Data</h4>

                <form action="{{ url('update-employee/'.$employee->id) }}" method="post">
                    @csrf
                    {{ method_field('put') }}

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-first_name" class="col-form-label">First Name:</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $employee->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="recipient-last_name" class="col-form-label">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $employee->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" name="email" class="form-control" value="{{ $employee->email }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <a href="{{ url('employee') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
