<div class="mt-0 parent-gtu">
    <h1>{{ __('main.edit_director') }}</h1>
</div>
<div class="d-flex gap-4 mt-4">

    <div class="col-2">
        <div class="ratio ratio-1x1 overflow-hidden bg-light border shadow-sm rounded">
            @if ($row->image)
            <div class="d-flex align-items-center justify-content-center fw-bolder"
                style="background:url('{{ asset('uploads/directors/'.$row->image) }}');background-size:cover;background-position:center;"
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
        <form method="POST" action="{{ route('admin.edit_director', [$row->id]) }}" id="editform">
            @csrf
            <div class="mb-3">
                <label for="name_en" class="form-label text-muted">
                    <strong>{{ __('main.english_name') }}</strong>
                </label>
                <input type="text" name="name_en" id="name_en2"
                    class="form-control" value="{{ $row->name_en }}"
                    placeholder="{{ __('main.english_name') }}..."
                    required="" autofocus="">
            </div>

            <div class="mb-3">
                <label for="name_ka" class="form-label text-muted">
                    <strong>{{ __('main.georgian_name') }}</strong>
                </label>
                <input type="text" name="name_ka" id="name_ka2"
                    class="form-control" value="{{ $row->name_ka }}"
                    placeholder="{{ __('main.georgian_name') }}..." required="" autofocus="">
            </div>

            <input type="file" class="form-control hide" id="chooseUploadImage2" accept=".png,.jpg"
                aria-label="Upload">
            <textarea name="director_image" id="director_image2" rows="5" class="form-control mt-4 hide"></textarea>

            <div class="d-flex" id="editOrCancel">
                <button type="submit" class="btn btn-gtu p-9-15">{{ __('main.save') }}</button>
                <button type="button" class="btn btn-gtu-tomato p-9-15 ms-3 canceledit">{{ __('main.cancel') }}</button>
            </div>
        </form>
    </div>
</div>
