@extends('admin.partials.layout')
@section('content')
    <div class="breadcrumb-container overflow-auto">
        <div class="btn-group btn-breadcrumb">
            <a href="{{ route('dashboard') }}" class="btn btn-default"><i class="las la-home"></i></a>
            <a href="{{ route('dashboard') }}" class="btn btn-default">{{ __('main.dashboard') }}</a>
        </div>
    </div>

    <section class="widgets_grid">
        <div class="widget bg-white mb-3 mt-2">
            <div class="widget-left">
                <div class="widgrt-number acidtext"> {{ stats('directors') }} </div>
                <div class="widgrt-title"> {{ __('main.directors') }} </div>
            </div>
            <div class="widget-iconside acidbg">
                <i class="las la-users"></i>
            </div>
        </div>

        <div class="widget bg-white mb-3 mt-2">
            <div class="widget-left">
                <div class="widgrt-number ccbluetext"> {{ stats('movies') }} </div>
                <div class="widgrt-title"> {{ __('main.movies') }} </div>
            </div>
            <div class="widget-iconside ccbluebg">
                <i class="las la-film"></i>
            </div>
        </div>

        <div class="widget bg-white mb-3 mt-2">
            <div class="widget-left">
                <div class="widgrt-number text-warning"> {{ stats('quotes') }} </div>
                <div class="widgrt-title"> {{ __('main.quotes') }} </div>
            </div>
            <div class="widget-iconside bg-warning">
                <i class="las la-quote-right"></i>
            </div>
        </div>



    </section>


@endsection
