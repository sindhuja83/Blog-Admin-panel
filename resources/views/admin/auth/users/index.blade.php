@extends('layouts.app')

@section('content')
<style>
    /* Style for the "Create New User" button */
    .btn-create-user {
        margin-top: 10px;
    }

    /* Style for the table container */
    .table-container {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12 mb-0 text-center">
            <h2 class="btn btn-lg btn-warning" style="padding-left: 80px; padding-right:80px;">Users List</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-right">
            <a href="{{ route('create') }}" class="btn btn-primary btn-create-user">Create New User</a>
        </div>
    </div>

    @if(session('success'))
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row table-container">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered datatable" style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            {{-- <th>Password</th> --}}
                            <th>Mobile</th>
                            <th>Profile Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Table rows will be populated via JavaScript (DataTable) -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    var table = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('getUser') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            // { data: 'password', name: 'password' }, 
            { data: 'mobile', name: 'mobile' },
            {
                data: 'image',
                name: 'image',
                render: function (data, type, full, meta) {
                    return data
                        ? '<img src="{{ asset('storage') }}/' + data + '" style="margin-left:70px;" alt="Profile Image" height="40" width="40">'
                        : 'No Image';
                },
            },
            { data: 'action', name: 'action' },
        ],
        paging: true,
        pageLength: 10,
        ordering: true,
        order: [[0, 'asc']],
        lengthMenu: [10, 25, 50, 100],
        language: {
            lengthMenu: 'Show _MENU_ entries per page',
            info: 'Showing page _PAGE_ of _PAGES_',
            infoEmpty: 'No records available',
            search: 'Search:',
            zeroRecords: 'No matching records found',
            paginate: {
                first: 'First',
                last: 'Last',
                next: '&rarr;',
                previous: '&larr;',
            },
        },
    });

    // Add event handler for edit button
    $('.datatable tbody').on('click', '.edit', function() {
        var data = table.row($(this).closest('tr')).data();
        window.location.href = "{{ url('edit') }}/" + data.id;
    });

    // Add event handler for delete button
    $('.datatable tbody').on('click', '.delete', function(event) {
        event.preventDefault(); // Prevent the default link behavior

        var data = table.row($(this).closest('tr')).data();
        var userId = data.id;

        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                url: "{{ url('delete') }}/" + userId,
                type: 'POST', // Change this to DELETE
                data: {
                    _token: "{{ csrf_token() }}",
                    _method: "DELETE" // Include the method override
                },
                success: function(response) {
                    table.ajax.reload();
                    alert('User deleted successfully.');
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('An error occurred while deleting the user.');
                }
            });
        }
    });
});
</script>

<style>
    .table th, .table td {
        padding: 0.25rem;
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        font-size: 14px;
    }
    
    .image {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

@endsection
