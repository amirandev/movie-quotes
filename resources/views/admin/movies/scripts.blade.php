<script>
    const title_en = $('#title_en');
    const title_ka = $('#title_ka');
    const director = $('#director');
    const thumbnail = $('#thumbnail');

    const load_content = $('#load_content');
    const sort = $('#sort');
    const search = $('#search');

    $(document).on('click', '#letschoose', function(e){
        e.preventDefault();
        e.stopPropagation();
        $('#chooseUploadImage').click();
    });

    $(document).on('click', '#letschoose2', function(e){
        e.preventDefault();
        e.stopPropagation();
        $('#chooseUploadImage2').click();
    });

    const convertBase64 = (file) => {
        return new Promise((resolve, reject) => {
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.onload = () => {
                resolve(fileReader.result);
            };

            fileReader.onerror = (error) => {
                reject(error);
            };
        });
    };

    const uploadImage = async (event) => {
        const file = event.target.files[0];
        const base64 = await convertBase64(file);
        $('#previewImage').css({
            'background-image' : `url('${base64}')`,
            'background-size' : 'cover',
            'background-position' : 'center'
        }).html('<!--nothing-->');

        thumbnail.val(base64);
        document.querySelector('#chooseUploadImage').value = '';
    };

    $(document).on('change', '#chooseUploadImage', function(e){
        if($(this).val() == '') return false;
        uploadImage(e);
    });

    const uploadImage2 = async (event) => {
        const file = event.target.files[0];
        const base64 = await convertBase64(file);
        $('#previewImage2').css({
            'background-image' : `url('${base64}')`,
            'background-size' : 'cover',
            'background-position' : 'center'
        }).html('<!--nothing-->');

        $('#thumbnail2').val(base64);
        document.querySelector('#chooseUploadImage2').value = '';
    };

    $(document).on('change', '#chooseUploadImage2', function(e){
        if($(this).val() == '') return false;
        uploadImage2(e);
    });

    let clearAddForm = () => {
        title_en.val('');
        title_ka.val('');
        director.val('');
    };

    let resetAddImage = () => {
        $('#previewImage').removeAttr('style').html('<div class="noimageText">{{ __('main.image') }}</div>');
    };

    $(document).on('submit', '#addform', function(e){
        e.preventDefault();
        e.stopPropagation();
        let action = $(this).attr('action');

        console.log({
                _token: '{{ csrf_token() }}',
                title_en: title_en.val().trim(),
                title_ka: title_ka.val().trim(),
                thumbnail: thumbnail.val().trim(),
                director: director.val().trim(),
            });

        $.ajax({
            type: 'post',
            url: action,
            data: {
                _token: '{{ csrf_token() }}',
                title_en: title_en.val().trim(),
                title_ka: title_ka.val().trim(),
                thumbnail: thumbnail.val().trim(),
                director: director.val().trim(),
            },
            beforeSend: function(){
                $('#addOrCancel').addClass('hide');
                $('#addloader').removeClass('hide');
            },
            success: function (response, status) {
                showBottomResponse((response.status == 1 ? 'success' : 'error'), response.message);
                $('#addOrCancel').removeClass('hide');
                $('#addloader').addClass('hide');

                if(response.status == 1){
                    clearAddForm();
                    $('#addSection').addClass('hide');
                    $('.filterAndResults').removeClass('hide');
                    loadContent('refresh');
                }
            },
            error: function (response, status) {
                let errResponse = JSON.parse(response.responseText);
                showBottomResponse('error', errResponse.message);
                $('#addOrCancel').removeClass('hide');
                $('#addloader').addClass('hide');
            }
        });
    });

    $(document).on('click', '.canceladd, .canceledit', function(e){
        e.preventDefault();
        e.stopPropagation();
        resetAddImage();
        $('#editSection').html('<!--space-->').addClass('hide');
        $('#addSection').addClass('hide');
        $('.filterAndResults').removeClass('hide');
    });

    $(document).on('click', '.showAdd', function(e){
        e.preventDefault();
        e.stopPropagation();
        clearAddForm();
        $('#addSection').removeClass('hide');
        $('.filterAndResults, #editSection').addClass('hide');
        resetAddImage();
    });


    let nextpage = null;
    let loadContent = (do_what) => {
        let endpoint = load_content.data('source');

        // if refresh required
        if(do_what == 'refresh') load_content.html('<!--make it empty-->');

        $.ajax({
            type: 'get',
            url: (nextpage && do_what == 'next' ? nextpage : endpoint),
            data: {
                sort:sort.val().trim(),
                search:search.val().trim()
            },
            success: function (response, status) {
                load_content.append(response.html);
                nextpage = response.next_page_url;
                if(response.next_page_url){
                    $('#loadmore').removeClass('hide');
                }else{
                    $('#loadmore').addClass('hide');
                }
            }
        });
    };

    window.onload = loadContent();

    document.querySelector('#sort').addEventListener('change', () => {
        loadContent('refresh');
    });

    $(document).on('click', '.askdelete', function(e){
        e.preventDefault();
        e.stopPropagation();
        let select = $(this).closest('.select_item');
        let id = select.data('id');

        if(confirm('{{ __('main.questionDeleteMovie') }}')){
            $.ajax({
                type: 'post',
                url: '{{ route('admin.soft_delete_movie') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    id:id
                },
                beforeSend: function(){
                    select.addClass('animateItemProgress');
                },
                success: function (response, status) {
                    showBottomResponse((response.status == 1 ? 'success' : 'error'), response.message);
                    select.removeClass('animateItemProgress');

                    if(response.status == 1){
                        loadContent('refresh');
                    }
                },
                error: function (response, status) {
                    let errResponse = JSON.parse(response.responseText);
                    showBottomResponse('error', errResponse.message);
                    select.removeClass('animateItemProgress');
                }
            });
        }
    });

    document.querySelector('#search').addEventListener('input', ({target}) => {
        loadContent('refresh');
    });

    $(document).on('click', '.askedit', function(e){
        e.preventDefault();
        e.stopPropagation();

        let select = $(this).closest('.select_item');
        let id = select.data('id');

        $.ajax({
            type: 'get',
            url: '{{ route('admin.themovie.json') }}',
            data: {
                _token: '{{ csrf_token() }}',
                id:id
            },
            beforeSend: function(){
                select.addClass('animateItemProgress');
            },
            success: function (response, status) {
                showBottomResponse((response.status == 1 ? 'success' : 'error'), response.message);
                select.removeClass('animateItemProgress');

                if(response.status == 1){
                    $('#editSection').removeClass('hide').html(response.html);
                    $('.filterAndResults, #addSection').addClass('hide');
                }
            },
            error: function (response, status) {
                let errResponse = JSON.parse(response.responseText);
                showBottomResponse('error', errResponse.message);
                select.removeClass('animateItemProgress');
            }
        });
    });

    $(document).on('submit', '#editform', function(e){
        e.preventDefault();
        e.stopPropagation();
        let action = $(this).attr('action');

        console.log({
                _token: '{{ csrf_token() }}',
                title_en: $('#title_en2').val().trim(),
                title_ka: $('#title_ka2').val().trim(),
                thumbnail: $('#thumbnail2').val().trim(),
                director: $('#director2').val().trim(),
        });

        $.ajax({
            type: 'post',
            url: action,
            data: {
                _token: '{{ csrf_token() }}',
                title_en: $('#title_en2').val().trim(),
                title_ka: $('#title_ka2').val().trim(),
                thumbnail: $('#thumbnail2').val().trim(),
                director: $('#director2').val().trim()
            },
            beforeSend: function(){
                $('#editOrCancel').addClass('hide');
                $('#editloader').removeClass('hide');
            },
            success: function (response, status) {
                showBottomResponse((response.status == 1 ? 'success' : 'error'), response.message);
                $('#editOrCancel').removeClass('hide');
                $('#editloader').addClass('hide');

                if(response.status == 1){
                    $('#editSection').addClass('hide').html('<!--empty-->');
                    $('#addSection').addClass('hide');
                    $('.filterAndResults').removeClass('hide');
                    loadContent('refresh');
                }
            },
            error: function (response, status) {
                let errResponse = JSON.parse(response.responseText);
                showBottomResponse('error', errResponse.message);
                $('#editOrCancel').removeClass('hide');
                $('#editloader').addClass('hide');
            }
        });
    });


    $(document).on('click', '#loadmore', function(e){
        e.preventDefault();
        e.stopPropagation();
        loadContent('next');
    });

</script>
