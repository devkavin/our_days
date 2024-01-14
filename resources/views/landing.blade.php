@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-secondary mb-3">
                    <div class="card-header">{{ __('Photo Gallery') }}</div>
                    <div class="card-body">
                        <div class="gallery-grid">
                            @foreach ($photos as $photo)
                                <div class="gallery-item">
                                    <img src="{{ asset($photo->url) }}" class="photo-thumbnail" alt="{{ $photo->name }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header">{{ __('Photo Gallery') }}</div>

                    <div class="card-body">
                        <div class="gallery-grid">
                            @foreach ($photos as $photo)
                                <div class="gallery-item">
                                    <img src="{{ $photo }}" class="photo-thumbnail" alt="Photo">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Photo Modal -->
    <div id="photoModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="fullSizeImage">
    </div>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var modal = document.getElementById("photoModal");
            var modalImg = document.getElementById("fullSizeImage");
            var closeModal = document.getElementsByClassName("close")[0];

            document.querySelectorAll(".photo-thumbnail").forEach(img => {
                img.onclick = function() {
                    modal.style.display = "block";
                    modalImg.src = this.src;
                }
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
