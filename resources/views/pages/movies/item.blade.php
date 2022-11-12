@if ($data->count())
    @foreach ($data as $row)
        <div class="shadow rounded-3 bg-white select_item movieimageAnimated" data-id="{{ $row->id }}">
            <div class="px-3 mt-3">
                <div class="ratio ratio-16x9 mb-2">
                    <div class="bg-light rounded-3"
                        style="background-image:url('{{ asset('uploads/movies/'.$row->image) }}');background-size:cover;background-position: center;">
                    </div>
                </div>
            </div>

            <div class="px-4 pb-4 pt-2">
                <div class="text-center">
                    <div class="mt-0">
                        <a href="#" class="text-dark text-center">{{ isLang('ka') ? $row->title_ka : $row->title_en }}</a>
                    </div>
                    <div class="mb-0 smalltextAuthor">{{ __('main.director') }}:
                        <a href="#" class="fz-14">{{ isLang('ka') ? $row->director->name_ka : $row->director->name_en }}</a>
                    </div>
                </div>

                <div class="mt-3 d-flex align-items-center justify-content-center fst-normal">
                    <a href="{{ route('view_movie', [$row->id, isLang('ka') ? $row->title_ka : $row->title_en]) }}" class="btn btn-primary fz-14-important textLowCase askedit">{{ __('more') }}</a>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="shadow p-4 d-flex align-items-center justify-content-center">
        {{ __('main.noresults_found') }}
    </div>
@endif
