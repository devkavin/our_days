@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($photos->isNotEmpty())
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
                @endif
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
                <div class="scrollable-playlist">
                    @foreach ($spotify_playlists as $spotify_playlist)
                        <div class="playlist-item">
                            <iframe style="border-radius:12px"
                                src="https://open.spotify.com/embed/playlist/{{ $spotify_playlist['src'] }}?utm_source=generator"
                                width="90%" height="352" frameBorder="0" allowfullscreen=""
                                allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                                loading="lazy"></iframe>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    </div>

    <!-- Photo Modal -->
    <div id="photoModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="fullSizeImage">
    </div>

    <!-- JavaScript for Modal -->

    <style>
        .scrollable-playlist {
            display: flex;
            overflow-x: auto;
        }

        .playlist-item {
            flex: 0 0 60%;
            /* padding-right: 5%; */
        }
    </style>
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
