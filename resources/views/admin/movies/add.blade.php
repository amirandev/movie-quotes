<style>
    .fz-16{
        font-size: 16px;
    }
</style>

<div class="mt-0 parent-gtu">
    <h1>{{ __('main.add_movie') }}</h1>
</div>
<div class="d-flex gap-4 mt-4">

    <div class="col-4">
        <div class="ratio ratio-16x9 overflow-hidden bg-light border shadow-sm rounded">
            <div class="d-flex align-items-center justify-content-center fw-bolder" id="previewImage">
                <div class="noimageText">{{ __('main.image') }}</div>
            </div>
            <div id="letschoose" class="hoverupload align-items-center justify-content-center">
                <i class="fas fa-file-upload fz-40 text-white"></i>
            </div>
        </div>
        <div class="lineloader mt-3 hide" id="addloader">
            <div></div>
        </div>
    </div>

    <div class="col">
        <form method="POST" action="{{ route('admin.add_movie') }}" id="addform">
            @csrf
            <div class="mb-3">
                <label for="title_en" class="form-label text-muted">
                    <strong>{{ __('main.english_title') }}</strong>
                </label>
                <input type="text" name="title_en" id="title_en" class="form-control"
                    placeholder="{{ __('main.english_title') }}..." required="" autofocus="">
            </div>

            <div class="mb-3">
                <label for="title_ka" class="form-label text-muted">
                    <strong>{{ __('main.georgian_title') }}</strong>
                </label>
                <input type="text" name="title_ka" id="title_ka" class="form-control"
                    placeholder="{{ __('main.georgian_title') }}..." required="" autofocus="">
            </div>

            <input type="file" class="form-control hide" id="chooseUploadImage" accept=".png,.jpg"
                aria-label="Upload">
            <textarea name="thumbnail" id="thumbnail" rows="5" class="form-control mt-4 hide"></textarea>


            <div class="mb-3">
                <label for="title_en" class="form-label text-muted">
                    <strong>{{ __('აირჩიეთ რეჟისორი') }}</strong>
                </label>
                <div class="input-group">
                    <span class="input-group-text px-2 bg-white" id="basic-addon1">
                        <i class="las la-user fz-24"></i>
                    </span>
                    <select class="form-select form-select-lg fz-16" name="director" id="director">
                        @foreach (allDirectors()->get() as $director)
                        <option value="{{ $director->id }}">{{ $director->name_ka }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex" id="addOrCancel">
                <button type="submit" class="btn btn-gtu p-9-15">{{ __('main.submit') }}</button>
                <button type="button" class="btn btn-gtu-tomato p-9-15 ms-3 canceladd">{{ __('main.cancel') }}</button>
            </div>
        </form>
    </div>
</div>
