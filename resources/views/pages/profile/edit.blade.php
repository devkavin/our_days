@extends('layouts.default')

@section('content')
    <div id="profile" class="container mt-4">
        <div class="row">
            <div class="col-md-12">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-4">Hello, {{ $profile_details['name'] }}!</h1>
                    <a href="{{ route('profile.edit', $profile_details['id']) }}" class="btn btn-primary">Edit Profile</a>
                </div>

                <div class="card mb-4">
                    <div class="card-header">Account Details</div>
                    <div class="card-body">
                        <p class="card-text">Name: {{ $profile_details['name'] }}</p>
                        <p class="card-text">Email: {{ $profile_details['email'] }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Update Profile</div>
                    <div class="card-body">
                        <form action="{{ route('profile.update', $profile_details['id']) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ $profile_details['name'] }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    value="{{ $profile_details['email'] }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
