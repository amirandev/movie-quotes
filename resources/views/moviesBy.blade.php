@extends('layouts.default', ['pagetitle' => 'ფილმები რეჟისორისგან'])
@section('content')
<div class="text-center py-4 mt-4">
    <h1>ფილმები რეჟისორისგან</h1>
    <h5 class="text-primary">თეიმურაზ ბაბლუანი</h5>
</div>

<div class="quoteimageMain mb-4 rounded-3 bg-light p-4">
    <div class="ratio ratio-16x9">
        <div class="bg-white rounded-3" style="background-image:url('./assets/images/gela.png');background-size:cover;background-position:center;">
            <!--space-->
        </div>
    </div>
    <div class="mt-4">
        <a href="#" class="text-decoration-none">
            <h5 class="text-dark">მონანიება</h5>
        </a>
    </div>
</div>
@endsection
