@include('home.blog')

<!-- Include Bootstrap CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- Your Custom CSS -->
<link rel="stylesheet" href="your-custom-styles.css">

<style>
    /* Style for the "Create New User" header */
    .create-user-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    /* Style for the outer box */
    .outer-box {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
    }
</style>

<div class="container mt-5">
    <div class="create-user-header">
        <h2>Create New User</h2>
    </div>
    <div class="outer-box p-4">
        <form action="{{ route('blogstore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($user))
        @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ isset($user) ? $user->name : '' }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ isset($user) ? $user->email : '' }}" required>
                </div>
            </div>
        </div>

        <!-- Password Field -->
        <div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" name="password" id="password" class="form-control"
                @if(!isset($user)) required @endif>
        </div>

        <!-- Hobbies and Gender Fields -->
        <div class="row">
            <div class="col-md-6">

<div class="form-group">
    <label><b>Hobbies</b></label>
    <div class="form-check">
        <input type="checkbox" name="hobbies[]" class="form-check-input" value="reading"
            {{ isset($user) && is_array($user->hobbies) && in_array('reading', $user->hobbies) ? 'checked' : '' }}>
        <label class="form-check-label">Reading</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="hobbies[]" class="form-check-input" value="gaming"
            {{ isset($user) && is_array($user->hobbies) && in_array('gaming', $user->hobbies) ? 'checked' : '' }}>
        <label class="form-check-label">Gaming</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="hobbies[]" class="form-check-input" value="social-media"
            {{ isset($user) && is_array($user->hobbies) && in_array('social-media', $user->hobbies) ? 'checked' : '' }}>
        <label class="form-check-label">Social Media</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="hobbies[]" class="form-check-input" value="coding"
            {{ isset($user) && is_array($user->hobbies) && in_array('coding', $user->hobbies) ? 'checked' : '' }}>
        <label class="form-check-label">Coding</label>
    </div>
</div>

                </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><b>Gender</b></label>
                    <div class="form-check">
                        <input type="radio" name="gender" id="male" class="form-check-input" value="male"
                            {{ isset($user) && $user->gender === 'male' ? 'checked' : '' }} required>
                        <label for="male" class="form-check-label">Male</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="gender" id="female" class="form-check-input" value="female"
                            {{ isset($user) && $user->gender === 'female' ? 'checked' : '' }} required>
                        <label for="female" class="form-check-label">Female</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="gender" id="other" class="form-check-input" value="other"
                            {{ isset($user) && $user->gender === 'other' ? 'checked' : '' }} required>
                        <label for="other" class="form-check-label">Other</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Qualification Field -->
        <div class="form-group">
            <label for="qualification"><b>Qualification</b></label>
            <select name="qualification" id="qualification" class="form-control" required>
                <option value="student"
                    {{ isset($user) && $user->qualification === 'student' ? 'selected' : '' }}>Student
                </option>
                <option value="employee"
                {{ isset($user) && $user->qualification === 'employee' ? 'selected' : '' }}>Employee
            </option>
            <option value="business"
                {{ isset($user) && $user->qualification === 'business' ? 'selected' : '' }}>Business
            </option>
            <option value="others"
                {{ isset($user) && $user->qualification === 'others' ? 'selected' : '' }}>Others
            </option>
            </select>
        </div>

        <!-- Profile Image Field -->
        <div class="form-group">
            <label for="image"><b>Profile Image</b></label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <!-- Buttons for Submit and Cancel -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group text-left mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group text-right mt-3">
                    <a href="{{ route('bloguserlist') }}" class="btn btn-secondary">Back to List Page</a>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>











