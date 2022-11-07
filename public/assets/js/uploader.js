$(document).on('click', '.attachmentfailed', function(e){
    e.preventDefault();
    $('.attachmentfailed').fadeOut();
});

$(document).on('click', '#browseFiles', function(e){
    $('#fileuploadInput').click();
});

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};

$(document).on('change', '#fileuploadInput', function(e){
    e.preventDefault();
    let filesArray = e.target.files;
    let index = 0;
    for (index = 0; index < filesArray.length; index++) {
        let file = e.target.files[index]; 
        if(file){
            // Getting file name
            let fileName = file.name;
            let randomString = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            let attachment_id = 'attachment_'+randomString;
            
            let title = $('#title').val().trim();
            if(title == ""){
                $('#title').val(fileName.replaceAll('_',' ').split('.').slice(0, -1).join('.'));
            }
            
            // Calling uploadFile with passing file name as an argument
            uploadFile(fileName, attachment_id, index, file); 
        }
        
    }
});


// file upload function
function uploadFile(name, attachment_id, index, file){
    let setId = '#'+attachment_id;
    let myformdata = new FormData();
    //const fileInput = document.querySelector("#fileuploadInput");
    myformdata.append('upload_file', file);
    
    $.ajax({
        xhr: function() {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function(event){ 
                $(setId+' .percentage').text(Math.floor((event.loaded / event.total) * 100));
                $(setId+' .uploadedFileName').text(name);
                $(setId+' .uploadedfileSize').text((Math.floor(event.total / 1000) < 1024) ? Math.floor(event.total / 1000)+" KB" : (event.loaded / (1024*1024)).toFixed(2)+" MB");
            }, false);
            
            return xhr;
        },
        type: "POST",
        url: "/add/post_add/upload_track",
        data: myformdata,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#auidcbc').addClass('hide');
            $('#albc').removeClass('hide');
        
            let attachmentHTML = `<div class="attachment attachmentDone bg-light rounded" id="${attachment_id}"><div class="attachmentFlex">`;
            attachmentHTML += `<div class="attchmentPulse"><div class="percentage">0%</div></div>`;
            attachmentHTML += `<div class="fileRight"><div class="uploadedFileName">Please wait...</div>`;
            attachmentHTML += `<div class="uploadedfileSize"><!--size--></div></div>`;
            attachmentHTML += `<div class="attchmentArrowIcon"><i class="fas fa-angle-down"></i></div></div>`;
            attachmentHTML += `<div class="attachmentActions" style="display:none;">`;
            attachmentHTML += `<div class="attachmentCopyLinkButton"><i class="fas fa-link"></i> Copy URL</div>`;
            attachmentHTML += `<div class="attachmentRemoveButton"><i class="fas fa-minus-circle"></i> Delete</div>`;
            attachmentHTML += `</div></div>`;
            $('#attachmentsList').html(attachmentHTML);
        }
    })
    .done(function(response, textStatus, jqXHR) {
        console.log(response);
        $('#fileuploadInput').val();
        if(response.status === 1){
            $(setId).addClass('attachmentDone').attr({'data-url':response.upload.url, 'data-new_name':response.upload.newName, 'data-id':response.upload.id});
            $(setId+' .percentage').html('<i class="fas fa-check"></i>');
            let getSizeBack = $(setId+' .uploadedfileSize').text().trim();
            $('#file_id').val(`${response.upload.id}`);
            $('#duration').val(`${response.upload.duration}`);
            return false;
        }
        
        $(setId).addClass('attachmentfailed');
        $(setId+' .percentage').html('<i class="fas fa-exclamation-triangle"></i>');
        $(setId+' .attchmentArrowIcon').html('<i class="fas fa-minus-circle text-red"></i>');
        $('#auidcbc').removeClass('hide');
        $('#albc').addClass('hide');
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        console.log({jqXHR, textStatus, errorThrown});
    });
}

let copyToClipboard = (text) => {
    const elem = document.createElement('textarea');
    elem.value = text;
    document.body.appendChild(elem);
    elem.select();
    document.execCommand('copy');
    document.body.removeChild(elem);
}

$(document).on('click', '.attachmentCopyLinkButton', function(e){
    e.preventDefault();
    e.stopPropagation();
    
    let getParent = $(this).closest('.attachmentDone');
    let url = getParent.data('url');
    $(this).html('<i class="fas fa-check-circle"></i> URL copied');
    copyToClipboard(url);
    
    setTimeout(() => { 
        $(this).html('<i class="fas fa-link"></i> Copy URL');
    }, 2000);
});

$(document).on('click', '.attachmentRemoveButton', function(e){
    e.preventDefault();
    e.stopPropagation();
    let getParent = $(this).closest('.attachmentDone');
    let id = getParent.data('id');
    
    $.ajax({
        type: "post",
        url: "/add/post_remove/delete_file",
        data: {file_id: id},
        success: function (response, status) {
            console.log(response);
            getParent.fadeOut().remove();
            $('#file_id').val('');
            $('#albc').addClass('hide');
            $('#auidcbc').removeClass('hide');
            
        }
    });
});

$(document).on('click', '.attachmentDone', function(e){
    let getFileId = '#'+$(this).attr('id');
    $(getFileId+' .attchmentArrowIcon i').toggleClass('fa-angle-down fa-angle-up');
    $(getFileId+' .attachmentActions').toggle();
});