@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0">Edit Profile</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if(isset($user) && $user->image)
                            <div class="form-group">
                                <label>Profile Image:</label><br>
                                <img src="{{ asset('storage/' . $user->image) }}" alt="Existing Profile Image"
                                    class="img-thumbnail" width="100">
                            </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <form action="{{ route('updateProfile', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label for="name">User Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="profile_image">Profile Image:</label>
                                    <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
