@extends('layouts.app')  {{-- You may need to adjust the layout based on your application structure --}}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Category</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('storecategory') }}"> {{-- Adjust the route to your needs --}}
                        @csrf

                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" class="form-control @error('categoryName') is-invalid @enderror" id="categoryName" name="categoryName" required>
                            @error('categoryName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
