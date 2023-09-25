@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h2 class="mb-0">{{ isset($user) ? 'Edit User' : 'Create New User' }}</h2>
                </div>

                <div class="card-body">
                    <form action="{{ isset($user) ? route('update', $user->id) : route('store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @if(isset($user))
                        @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($user) ? $user->name : '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ isset($user) ? $user->email : '' }}" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                @if(!isset($user)) required @endif>
                        </div>

                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control" id="mobile" name="mobile"
                                value="{{ isset($user) ? $user->mobile : '' }}" required>
                        </div>

                        <!-- Existing Image Preview -->
                        @if(isset($user) && $user->image)
                        <div class="form-group">
                            <label>Existing Profile Image:</label><br>
                            <img src="{{ asset('storage/' . $user->image) }}" alt="Existing Profile Image"
                                class="img-thumbnail" width="100">
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="image">Profile Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary">
                                {{ isset($user) ? 'Update' : 'Submit' }}
                            </button>

                            <a href="{{ route('index') }}" class="btn btn-warning">Back to User List</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
