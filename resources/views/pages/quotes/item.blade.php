@if ($data->count())
    @foreach ($data as $row)
        <div class="shadow rounded-3 bg-white select_item movieimageAnimated position-relative" data-id="{{ $row->id }}">
            <div class="px-3 mt-3">
                <div class="ratio ratio-16x9 mb-2">
                    <div class="bg-light rounded-3"
                        style="background-image:url('{{ asset('uploads/quotes/'.$row->image) }}');background-size:cover;background-position: center;">
                    </div>
                </div>
            </div>

            <div class="px-4 pb-4 pt-2">

                <div class="px-4 pb-4 pt-2 bg-light rounded-3 d-block">
                    <div class="quoteBox">
                        <div class="btn-gtu leftDoubleComma">
                            <i class="las la-quote-right"></i>
                        </div>
                        <div class="textindentQuote mt-2 fz-15-5">
                            {{ $row->text_ka }}
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="btn-gtu rightDoubleComma">
                                <i class="las la-quote-left"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center py-3">
                    <a href="#" class="text-dark text-center">{{ isLang('ka') ? $row->movie->title_ka : $row->movie->title_en }}</a>
                    <div class="mb-0 smalltextAuthor">{{ __('main.director') }}:
                        <a href="#" class="fz-14">{{ isLang('ka') ? movie_info($row->movie->id, 'director')->name_ka : movie_info($row->movie->id, 'director')->name_en }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="shadow p-4 d-flex align-items-center justify-content-center">
        {{ __('main.noresults_found') }}
    </div>
@endif
