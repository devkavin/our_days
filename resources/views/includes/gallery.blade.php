<div class="card">
    <div class="card-header">Your Photos</div>
    <div class="card-body">
        <!-- Photo Gallery -->
        <div class="row">
            @foreach ($photos as $photo)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset($photo->url) ?? '' }}" alt="{{ $photo->name ?? '' }}"
                        class="img-fluid photo-thumbnail" style="cursor: pointer;" data-photo-id="{{ $photo->id }}"
                        data-photo-public="{{ $photo->is_public }}">
                </div>
            @endforeach
        </div>
        <!-- End Photo Gallery -->
    </div>
</div>
