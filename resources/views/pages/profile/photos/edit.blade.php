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
                    <div class="card-header">Upload Photo</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.photos.store', $profile_details['id']) }}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="photo" required>
                            <!-- Toggle for is_public -->
                            <div class="form-check form-switch mt-3">
                                <input type="hidden" name="is_public" value="0">
                                <input type="hidden" name="photo_type" value="3">

                                <input type="checkbox" class="form-check-input" id="isPublicToggle" name="is_public"
                                    value="1">
                                <label class="form-check-label" for="isPublicToggle">Make Photo Public</label>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                            @if ($errors->has('photo'))
                                <div class="alert alert-danger mt-2">
                                    {{ $errors->first('photo') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mt-2">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Your Photos</div>
                    <div class="card-body">
                        <!-- Photo Gallery -->
                        <div class="row">
                            @foreach ($photos as $photo)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ asset($photo->url) ?? '' }}" alt="{{ $photo->name ?? '' }}"
                                        class="img-fluid photo-thumbnail" style="cursor: pointer;"
                                        data-photo-id="{{ $photo->id }}" data-photo-public="{{ $photo->is_public }}">

                                    <!-- Delete Photo Form -->
                                    <form {{-- action="{{ route('profile.photos.destroy', ['profile' => $profile_details['id'], 'photo' => $photo->id]) }}" --}} action="{{ route('photos.destroy', $photo->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this photo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                        <!-- End Photo Gallery -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Photo Viewer Modal -->
    <div id="photoModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="fullSizeImage">
        <form id="photoOptionsForm" method="POST" action="{{ route('photos.update', $photo->id) }}"
            enctype="multipart/form-data">
            <input type="hidden" name="is_public" value="{{ $photo->is_public ?? '' }}">
            @csrf
            @method('POST')
            <div class="modal-options">
                <label for="isPublicToggle">Make Photo Public</label>
                <input type="checkbox" class="form-check-input" id="isPublicToggle" name="is_public"
                    value="{{ $photo->is_public ?? '' }}">
                <button type="submit" class="btn btn-success">Save Changes</button>
            </div>
        </form>
    </div>

    <!-- Custom JavaScript for the Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("photoModal");
            var modalImg = document.getElementById("fullSizeImage");
            var closeModal = document.getElementsByClassName("close")[0];


            document.querySelectorAll(".photo-thumbnail").forEach(img => {
                img.onclick = function() {
                    modal.style.display = "block";
                    modalImg.src = this.src;
                };
            });

            closeModal.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>
@endsection
