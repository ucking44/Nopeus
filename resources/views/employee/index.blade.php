@extends('layouts.master')
@section('title')
  Employee
@endsection

@section('content')

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('save-employee') }}" method="post">
            @csrf

            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-first_name" class="col-form-label">First Name:</label>
                    <input type="text" name="first_name" class="form-control" id="recipient-first_name" required>
                </div>
                <div class="form-group">
                    <label for="recipient-last_name" class="col-form-label">Last Name:</label>
                    <input type="text" name="last_name" class="form-control" id="recipient-last_name" required>
                </div>
                <div class="form-group">
                    <lable for="company_id">Company</lable>
                    <select name="company_id" id="company_id" class="form-control">
                        @foreach ($company as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email:</label>
                    <input type="email" name="email" class="form-control" id="recipient-email" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-form-label">Phone:</label>
                    <input type="number" name="phone" class="form-control" id="recipient-phone" required>
                </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  {{-- DELETE MODAL --}}
  <!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}

  <!-- Modal -->
  <div class="modal fade" id="deletemodalpopup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="delete_modal_form" method="post">
            @csrf
            {{ method_field('delete') }}

        <div class="modal-body">
            <input type="hidden" id="delete_employee_id">
            <h5>Are you sure.? you want to want to delete this Data ?</h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Yes Delete</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">About Employee
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">ADD</button>
                </h4>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <style>
                .w-10p{
                    width: 10% !important;
                }
            </style>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead class="text-primary">
                            <th class="w-10p">ID</th>
                            <th class="w-10p">First Name</th>
                            <th class="w-10p">Last Name</th>
                            <th class="w-10p">Email</th>
                            <th class="w-10p">Phone</th>
                            <th class="w-10p">Edit</th>
                            <th class="w-10p">Delete</th>
                        </thead>
                        <tbody>

                            @foreach ($employee as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->first_name }}</td>
                                <td>{{ $data->last_name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>
                                    <a href="{{ url('edit-employee/'.$data->id) }}" class="btn btn-default">Edit</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger deletebtn">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $employee->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();


            $('#datatable').on('click', '.deletebtn', function () {
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                // console.log(data);

                $('#delete_employee_id').val(data[0]);

                $('#delete_modal_form').attr('action', '/delete-employee/'+data[0]);

                $('#deletemodalpopup').modal('show');
            });

        });

    </script>
@endsection


