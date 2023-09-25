    @include('home.blog')
    <style>
        /* Style for the "Create New User" button */
        .btn-create-user {
            margin-top: 10px;
        }

        /* Style for the table container */
        .table-container {
            margin-top: 20px;
        }

        .image {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .custom-container {
            max-width: 80%; /* Set your preferred width here */
            margin: 0 auto; /* Center the container horizontally */
        }

    </style>

    <div class="custom-container mt-5" style="margin-left: 150px;">
        <div class="row">
            <div class="col-md-12 mb-0 text-center">
                <h2 class="btn btn-lg btn-warning" style="padding-left: 80px; padding-right: 80px;">Users List</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
                <a href="{{ route('blogcreate') }}" class="btn btn-primary btn-create-user">Create New User</a>
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
                    <table class="table table-striped table-bordered datatable" style="font-size: 12px; width: 100%;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Hobbies</th>
                                <th>Qualification</th>
                                <th>Profile Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div style="position: fixed; bottom: 20px; right: 20px;">
        <a href="{{route('home')}}" class="btn btn-secondary">Back</a>
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
            ajax: "{{ route('bloggetUser') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'gender', name: 'gender' },
                { data: 'hobbies', name: 'hobbies' },
                { data: 'qualification', name: 'qualification' },
                {
                    data: 'image',
                    name: 'image',
                    render: function (data, type, full, meta) {
                        return data
                            ? '<div class="image"><img src="{{ asset('storage') }}/' + data + '" alt="Profile Image" height="40" width="40"></div>'
                            : 'No Image';
                    },
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false, // Make this column not sortable
                    searchable: false // Hide the search input for this column
                },
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
            window.location.href = "{{ url('blogedit') }}/" + data.id;
        });

        // Add event handler for delete button
// Add event handler for delete button
$('.datatable tbody').on('click', '.delete', function(event) {
    event.preventDefault(); // Prevent the default link behavior

    var data = table.row($(this).closest('tr')).data();
    var userId = data.id;

    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: "{{ url('blogdelete') }}/" + userId, // Update the URL to use DELETE method
            type: 'DELETE', // Use DELETE method
            data: {
                _token: "{{ csrf_token() }}",
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
