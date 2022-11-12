@extends('admin.partials.layout', ['pagetitle' => __('main.directors')])
@section('content')
    <div class="breadcrumb-container overflow-auto">
        <div class="btn-group btn-breadcrumb">
            <a href="{{ route('dashboard') }}" class="btn btn-default"><i class="las la-home"></i></a>
            <a href="{{ route('admin.directors') }}" class="btn btn-default">{{ __('main.directors') }}</a>
        </div>
    </div>

    <section class="p-normal bg-white mt-3 hide" id="addSection">
        @include('admin.directors.add')
    </section>

    <section class="p-normal bg-white mt-3 hide" id="editSection">
        <!--editSection-->
    </section>

    <section class="p-normal bg-white mt-3 filterAndResults">
        <div class="mt-0 parent-gtu">
            <h1>{{ __('main.manage_directors') }}</h1>
            <div class="text-muted">
                {{ __('main.manage_directors_mutedText') }}
            </div>
            <div class="pt-3">
                <a href="javascript:void" class="btn btn-gtu-green p-9-15 text-white showAdd">{{ __('main.add') }}</a>
            </div>
        </div>
    </section>

    <section class="bg-white py-2 mt-1 filterAndResults">
        <div class="partners_filter d-flex align-items-center justify-content-start">
            <div class="ms-3 me-3">
                <div class="input-group">
                    <span class="input-group-text px-2 bg-white" id="basic-addon1">
                        <i class="las la-sort-numeric-up-alt fz-24"></i>
                    </span>
                    <select class="form-select form-select-lg minimisedSelect" name="sort" id="sort">
                        <option value="1">{{ __('main.date') }} ({{ __('main.ascending') }})</option>
                        <option value="2" selected="">{{ __('main.date') }} ({{ __('main.descending') }})</option>
                        <option value="3">{{ __('main.name') }} ({{ __('main.ascending') }})</option>
                        <option value="4">{{ __('main.name') }} ({{ __('main.descending') }})</option>
                    </select>
                </div>
            </div>
            <div class="ms-3 me-3">
                <input type="text" name="search" id="search" class="form-control" placeholder="{{ __('main.search') }}...">
            </div>
        </div>
    </section>


    <section class="filterAndResults">
        <div class="directors mt-3" id="load_content" data-source="{{ route('admin.directors.json') }}">
            <!--results here-->
        </div>
        <div class="d-flex align-items-center justify-content-center p-4">
            <div class="btn btn-gtu py-2 hide" id="loadmore">{{ __('main.show_more') }}</div>
        </div>
    </section>

    <div class="p-4"><!--nothing here--></div>

    @include('admin.directors.scripts')
@endsection
