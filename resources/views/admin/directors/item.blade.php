@if ($data->count())
    @foreach ($data as $row)
        <div class="shadow rounded-3 p-4 bg-white select_item" data-id="{{ $row->id }}">
            <div class="ratio ratio-1x1 mb-2 directorimageAnimated">
                <div class="bg-light rounded-3"
                    style="background-image:url('{{ asset('uploads/directors/' . $row->image) }}');background-size:cover;background-position: center;">
                </div>
            </div>
            <div class="mt-3 text-center">
                <a href="#" class="text-dark text-center">{{ isLang('ka') ? $row->name_ka : $row->name_en }}</a>
            </div>
            <div class="mt-3 d-flex align-items-center justify-content-between">
                <button type="button" class="btn btn-primary fz-14 askedit">{{ __('main.edit') }}</button>
                <button type="button" class="btn btn-danger fz-14 askdelete">X</button>
            </div>
        </div>
    @endforeach
@endif
