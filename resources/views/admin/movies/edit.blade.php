<div class="mt-0 parent-gtu">
    <h1>{{ __('main.edit_movie') }}</h1>
</div>
<div class="d-flex gap-4 mt-4">

    <div class="col-4">
        <div class="ratio ratio-16x9 overflow-hidden bg-light border shadow-sm rounded">
            @if ($row->image)
            <div class="d-flex align-items-center justify-content-center fw-bolder"
                style="background:url('{{ asset('uploads/movies/'.$row->image) }}');background-size:cover;background-position:center;"
                id="previewImage2">
                <!--empty-->
            </div>
            @else
            <div class="d-flex align-items-center justify-content-center fw-bolder" id="previewImage2">
                <div class="noimageText">{{ __('main.image') }}</div>
            </div>
            @endif
            <div id="letschoose2" class="hoverupload align-items-center justify-content-center">
                <i class="fas fa-file-upload fz-40 text-white"></i>
            </div>
        </div>
        <div class="lineloader mt-3 hide" id="editloader">
            <div></div>
        </div>
    </div>

    <div class="col">
        <form method="POST" action="{{ route('admin.edit_movie', [$row->id]) }}" id="editform">
            @csrf
            <div class="mb-3">
                <label for="title_en" class="form-label text-muted">
                    <strong>{{ __('main.english_title') }}</strong>
                </label>
                <input type="text" name="title_en" id="title_en2"
                    class="form-control" value="{{ $row->title_en }}"
                    placeholder="{{ __('main.english_title') }}..."
                    required="" autofocus="">
            </div>

            <div class="mb-3">
                <label for="title_ka" class="form-label text-muted">
                    <strong>{{ __('main.georgian_title') }}</strong>
                </label>
                <input type="text" name="title_ka" id="title_ka2"
                    class="form-control" value="{{ $row->title_ka }}"
                    placeholder="{{ __('main.georgian_title') }}..." required="" autofocus="">
            </div>

            <input type="file" class="form-control hide" id="chooseUploadImage2" accept=".png,.jpg"
                aria-label="Upload">
            <textarea name="thumbnail" id="thumbnail2" rows="5" class="form-control mt-4 hide"></textarea>

            <div class="mb-3">
                <label for="title_en" class="form-label text-muted">
                    <strong>{{ __('main.director') }}</strong>
                </label>
                <div class="input-group">
                    <span class="input-group-text px-2 bg-white">
                        <i class="las la-user fz-24"></i>
                    </span>
                    <select class="form-select form-select-lg fz-16" name="director" id="director2">
                        @foreach (allDirectors()->get() as $director)
                        <option value="{{ $director->id }}" {{ $director->id == $row->director_id ? 'selected' : null }}>
                            {{ $director->name_ka }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex" id="editOrCancel">
                <button type="submit" class="btn btn-gtu p-9-15">{{ __('main.save') }}</button>
                <button type="button" class="btn btn-gtu-tomato p-9-15 ms-3 canceledit">{{ __('main.cancel') }}</button>
            </div>
        </form>
    </div>
</div>
