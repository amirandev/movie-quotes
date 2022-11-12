<style>
    .specialMenu{
        position: fixed;
        left: 100px;
        min-height: 300px;
        min-width: 250px;
        max-width: 250px;

        z-index: 30;

        top: calc(50% - 150px);

        display: flex;
        align-items: center;
        justify-content: flex-start;
    }


    .specialMenu a{
        display: block;
        padding: 11px 15px;
        line-height: 1;
        color: #333;
        text-decoration: none;
        border-radius: 7px;
    }

    .specialMenu a:hover{
        background: #00d13f;
        color: #fff;
    }

    .specialMenu .active{
        color: #00d13f;
    }

    .animateShowMenu{
        background: rgba(255, 255, 255, 1);
        animation: showMenu .7s;
    }

    @keyframes showMenu{
        from {
            left: 80px;
            background: #f2f2f2;
        }

        to{
            left: 100px;
            background: rgba(255, 255, 255, 1);
        }
    }

    .animateHideMenu{
        animation: hideMenu .7s;
    }


    @keyframes hideMenu{
        from{
            left: 100px;
            background: rgba(255, 255, 255, 1);
        }

        to {
            left: 80px;
            background: #f2f2f2;
        }
    }
</style>

<div class="specialMenu shadow rounded-3 p-4 hide" id="themenu">
    <nav class="m-0 w-100">
        <a href="{{ route('home') }}" class="{{ routeActive('home') }}">{{ __('main.home') }}</a>
        <a href="{{ route('quotes') }}" class="{{ routeActive('quotes') }}">{{ __('main.quotes') }}</a>
        <a href="{{ route('movies') }}" class="{{ routeActive('movies') }}">{{ __('main.movies') }}</a>
        <a href="{{ route('directors') }}" class="{{ routeActive('directors') }}">{{ __('main.directors') }}</a>
        <a href="{{ route('top_directors') }}" class="{{ routeActive('top_directors') }}">{{ __('main.top_directors') }}</a>
    </nav>
</div>

<script>
    $(document).on('click', '#openthemenu', function(e){
        e.preventDefault();
        e.stopPropagation();
        let menu = $('#themenu');
        if(menu.hasClass('hide')){
            $('#themenu').removeClass('hide animateHideMenu').addClass('animateShowMenu');
        }else{
            $('#themenu').addClass('animateHideMenu').removeClass('animateShowMenu');
            setTimeout(() => {
                $('#themenu').removeClass('animateHideMenu').addClass('hide');
            }, 300);
        }

    });
</script>


