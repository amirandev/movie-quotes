@extends('layouts.default', ['pagetitle' => 'შემთხვევითი ციტატა ფილმიდან'])
@section('content')
<div class="text-center py-4 mt-4">
    <h1><a href="{{ route('view_movie', [1, 'მონანიება']) }}">მონანიება</a></h1>
    <p class="mb-0">რეჟისორი: <a href="{{ route('movies_by', [1, 'თეიმურაზ ბაბლუანი']) }}">თეიმურაზ ბაბლუანი</a></p>
</div>

<div class="quoteimageMain">
    <div class="ratio ratio-16x9">
        <div class="bg-light" style="background-image:url('./assets/images/gela.png');background-size:cover;background-position:center;">
            <!--space-->
        </div>
    </div>
</div>

<div class="quotetextContainer pt-4">
    <div class="quoteBox mt-4">
        <div class="btn-gtu leftDoubleComma">
            <i class="las la-quote-right"></i>
        </div>
        <div class="textindentQuote mt-4">
            არაფერი არ მოიპარო, შიმშილით რომ კვდებოდე მაინც. იცოდე, სხვისი არაფერი შეგშურდეს მამა. და იცოდე, ყველა ადამიანს აქვს რაღაც ისეთის რის გამოც შეიძლება გიყვარდეს ან გეცოდებოდეს მაინც...
        </div>
        <div class="d-flex justify-content-end">
            <div class="btn-gtu rightDoubleComma">
                <i class="las la-quote-left"></i>
            </div>
        </div>
    </div>
</div>
@endsection
