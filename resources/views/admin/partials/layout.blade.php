<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('assets/css/root-'.(isLang('ka') ? 'ka' : 'en').'.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/breadcrumb.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/dashboard.css') }}">
    <link rel='stylesheet' href='{{ asset('assets/summernote/summernote-lite.min.css') }}'>
    <link href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <script src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
    <link rel="icon" type="image/x-icon" href="{{ asset('/favicon.ico') }}">
</head>
<body>
    @include('admin.partials.header')
    @include('admin.partials.nav')
	<div style="min-height: 120px"></div>

    <div class="bottomResponses error success shadow hide">
        <span class="bottomresponseIcon">
            <i class="las la-check-circle successicon"></i>
            <i class="las la-exclamation-circle warningiconn"></i>
        </span>
        <p class="bottomResponseMessage mb-0">ინფორმაცია წარმატებით განახლდა</p>
    </div>

	<main class="dashboard-conatiner p-3" id="main">
        @yield('content')
    </main>

    <script>
		function LeftmenuTriger(){
			var mq = window.matchMedia( "(max-width: 800px)" );
			if (mq.matches){
				// window width is at less than 570px
			}
			else{
				// window width is greater than 570px
				if($("#header").hasClass("dashboard-conatiner")){
					$("#header").removeClass("dashboard-conatiner");
					$("#main").removeClass("dashboard-conatiner");
				}
				else{
					$("#header").addClass("dashboard-conatiner");
					$("#main").addClass("dashboard-conatiner");
				}
			}

			$('#leftbar_menu').toggle();
		}

        function hideBottomResponse(){
            $('.bottomResponses').fadeOut('normal', () => {
                $('.bottomResponses').addClass('hide');
            });
        }

        $(document).on('click', '.bottomResponses', hideBottomResponse);

        function showBottomResponse(status = 'success', message = `empty response`){
            $('.bottomResponses').removeClass('error success').addClass(status.trim());
            $('.bottomResponseMessage').text(message);

            $('.bottomResponses').fadeIn('normal', () => {
                $('.bottomResponses').removeClass('hide');
            });

            setTimeout(hideBottomResponse, 3200);
        }
	</script>
</body>
</html>
