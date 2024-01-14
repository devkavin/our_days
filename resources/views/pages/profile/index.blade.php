@extends('layouts.default')

@section('content')
    <div id="dashboard" class="container my-4">
        <div class="row">
            <div class="col-md-12">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="display-4">Hello, {{ $profile_details['name'] }}!</h1>

                </div>

                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Account Details</span>
                                <a href="{{ route('profile.edit', ['profile' => $profile_details['id'], 'request' => 'edit_profile']) }}"
                                    class="btn btn-outline-primary">Edit</a>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $profile_details['name'] }}</h5>
                                <p class="card-text">{{ $profile_details['email'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 mb-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <span>Manage Photos</span>
                                <a href="{{ route('profile.edit', ['profile' => $profile_details['id'], 'request' => 'edit_photos']) }}"
                                    class="btn btn-outline-primary">Edit</a>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Public Photos: {{ count($photos['public_photos']) }}</p>
                                <p class="card-text">Private Photos: {{ count($photos['private_photos']) }}</p>
                                <p class="card-text">All Photos: {{ count($photos['all_photos']) }}</p>
                                {{-- <a href="{{ route('profile.photos') }}" class="btn btn-outline-danger">Edit Photos</a>
                                Settings</a> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Sections Can Be Added Here -->

            </div>
        </div>
    </div>
@endsection
