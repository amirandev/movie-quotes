    <div class="mt-0 parent-gtu">
        <h1>{{ __('main.add_director') }}</h1>
    </div>
    <div class="d-flex gap-4 mt-4">

        <div class="col-2">
            <div class="ratio ratio-1x1 overflow-hidden bg-light border shadow-sm rounded">
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
            <form method="POST" action="{{ route('admin.add_director') }}" id="addform">
                @csrf
                <div class="mb-3">
                    <label for="name_en" class="form-label text-muted">
                        <strong>{{ __('main.english_name') }}</strong>
                    </label>
                    <input type="text" name="name_en" id="name_en" class="form-control"
                        placeholder="{{ __('main.english_name') }}..." required="" autofocus="">
                </div>

                <div class="mb-3">
                    <label for="name_ka" class="form-label text-muted">
                        <strong>{{ __('main.georgian_name') }}</strong>
                    </label>
                    <input type="text" name="name_ka" id="name_ka" class="form-control"
                        placeholder="{{ __('main.georgian_name') }}..." required="" autofocus="">
                </div>

                <input type="file" class="form-control hide" id="chooseUploadImage" accept=".png,.jpg"
                    aria-label="Upload">
                <textarea name="director_image" id="director_image" rows="5" class="form-control mt-4 hide"></textarea>

                <div class="d-flex" id="addOrCancel">
                    <button type="submit" class="btn btn-gtu p-9-15">{{ __('main.submit') }}</button>
                    <button type="button" class="btn btn-gtu-tomato p-9-15 ms-3 canceladd">{{ __('main.cancel') }}</button>
                </div>
            </form>
        </div>
    </div>
