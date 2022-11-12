@extends('layouts.default', ['pagetitle' => __('main.random_quote_from_the_movie')])
@section('content')
    @php
        $director = director_info($quote->movie->director_id, 'averything');
    @endphp
<div class="text-center py-4 mt-4">
    <h1>
        <a href="{{ route('view_movie', [$quote->movie->id, (isLang('ka') ? $quote->movie->title_ka : $quote->movie->title_en)]) }}">
            {{ isLang('ka') ? $quote->movie->title_ka : $quote->movie->title_en }}
        </a>
    </h1>
    <p class="mb-0">{{ __('main.director') }}:
        <a href="{{ route('movies_by', [$director->id, (isLang('ka') ? $director->name_ka : $director->name_en)]) }}">
            {{ isLang('ka') ? $director->name_ka : $director->name_en }}
        </a>
    </p>
</div>

<div class="quoteimageMain">
    <div class="ratio ratio-16x9">
        <div class="bg-light rounded-3" style="background-image:url('{{ asset('uploads/quotes/'.$quote->image) }}');background-size:cover;background-position:center;">
            <!--space-->
        </div>
    </div>
</div>

<div class="quotetextContainer pt-4">
    <div class="px-4 pb-4 pt-2 bg-light rounded-3 d-block">
        <div class="quoteBox mt-0">
            <div class="btn-gtu leftDoubleComma">
                <i class="las la-quote-right"></i>
            </div>
            <div class="textindentQuote mt-2">
                {{ isLang('ka') ? $quote->text_ka : $quote->text_en }}
            </div>
            <div class="d-flex justify-content-end">
                <div class="btn-gtu rightDoubleComma">
                    <i class="las la-quote-left"></i>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
