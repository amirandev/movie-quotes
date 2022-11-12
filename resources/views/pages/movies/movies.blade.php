@extends('layouts.default', ['pagetitle' => __('main.movies')])
@section('content')
    <div class="text-center py-4 mt-4">
        <h1>{{ __('main.movies') }}</h1>
    </div>

    <div class="widerContainer">

        <section class="bg-white py-2 mt-1 filterAndResults">
            <div class="partners_filter d-flex align-items-center justify-content-center gap-4">
                <div class="input-group2">
                    <span class="input-group-text px-2 bg-white rounded-right-0 border-right-0" id="basic-addon1">
                        <i class="las la-sort-numeric-up-alt fz-24"></i>
                    </span>
                    <select class="form-select rounded-left-0 form-select-lg minimisedSelect" name="sort" id="sort">
                        <option value="1">{{ __('main.date') }} ({{ __('main.ascending') }})</option>
                        <option value="2" selected="">{{ __('main.date') }} ({{ __('main.descending') }})</option>
                        <option value="3">{{ __('main.name') }} ({{ __('main.ascending') }})</option>
                        <option value="4">{{ __('main.name') }} ({{ __('main.descending') }})</option>
                    </select>
                </div>
                <div>
                    <input type="text" name="search" id="search" class="form-control" placeholder="{{ __('main.search') }}...">
                </div>
            </div>
        </section>


        <section class="filterAndResults">
            <div class="movies mt-3" id="load_content" data-source="{{ route('movies.json') }}">
                <!--results here-->
            </div>
            <div class="d-flex align-items-center justify-content-center p-4">
                <div class="btn btn-gtu py-2 hide" id="loadmore">{{ __('main.show_more') }}</div>
            </div>
        </section>

        <div class="p-4">
            <!--nothing here-->
        </div>
    </div>

    <script src="{{ asset('assets/js/loadContent.js') }}"></script>
@endsection
