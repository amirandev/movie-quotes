@extends('layouts.default')
@section('content')
    <div class="text-center py-4 mt-4">
        <h1>ციტატები ფილმიდან: მონანიება</h1>
        <p class="mb-0">რეჟისორი: <a href="{{ route('movies_by', [1, 'თეიმურაზ ბაბლუანი']) }}">თეიმურაზ ბაბლუანი</a></p>
    </div>

    <div class="quoteimageMain mb-4 rounded-3 bg-light p-4">
        <div class="ratio ratio-16x9">
            <div class="bg-light rounded-3" style="background-image:url('./assets/images/gela.png');background-size:cover;background-position:center;">
                <!--space-->
            </div>
        </div>
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

    <div class="quoteimageMain mb-4 rounded-3 bg-light p-4">
        <div class="ratio ratio-16x9">
            <div class="bg-light rounded-3" style="background-image:url('./assets/images/gela.png');background-size:cover;background-position:center;">
                <!--space-->
            </div>
        </div>
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
