@extends('layouts.default', ['pagetitle' => __('main.top_directors')])
@section('content')
    <div class="text-center py-4 mt-4">
        <h1>{{ __('main.top_directors') }}</h1>
    </div>

    @if ($directors->count())
        @foreach ($directors as $row)
            @if ($row->total_quotes)
                <div class="widerContainer">
                    <div class="d-flex gap-4 p-1 shadow rounded-3 mb-4">
                        <div class="directors2">
                            <div class="p-4">
                                <div class="ratio ratio-1x1 mb-2 directorimageAnimated">
                                    <div class="bg-light rounded-3"
                                        style="background-image:url('{{ asset('uploads/directors/'.$row->image) }}');background-size:cover;background-position: center;">
                                    </div>
                                </div>
                                <a href="#" class="text-dark text-center d-block mt-3">{{ isLang('ka') ? $row->name_ka : $row->name_en }}</a>
                            </div>
                        </div>
                        <div class="quotesBy py-4 w-100 pe-4">
                            <ul class="list-group list-group-numbered">
                                @foreach (director_info($row->id, 'quotes') as $index => $quote)
                                    <li class="list-group-item {{ $index < 1 ? 'active' : null }}">
                                        {{ isLang('ka') ? $quote->text_ka : $quote->text_en }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endsection
