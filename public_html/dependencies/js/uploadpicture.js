
$(document).on("click","#uploadfile",(function() {
    console.log('attempting to upload picture');
    var file_data = $('#fileToUpload').prop('files')[0];
    var form_data = new FormData();
    form_data.append('fileToUpload', file_data);
    form_data.append('promoid',$("#promotion-view-modal").data('promo-id'));
    console.log('Promoid:'+$("#promotion-view-modal").data('promo-id'));

    $.ajax({
        url: '../../dependencies/php/uploadpictures.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',
        error: function () {
            console.log('error withpicture');
        },
        success: function(php_script_response){
            console.log(php_script_response); // display response from the PHP script, if any

            switch(parseInt(php_script_response)){
                case 0:
                    console.log('Failure: 0');
                    break;
                case 1:
                    $('#lblResponse').text('File Uploaded Successfully .');
                    loadPictures($("#promotion-view-modal").data('promo-id'));
                    break;
                case 5:
                    console.log('Failure: 5');
                    $('#lblResponse').text('Sorry, your file is too large.');
                    break;
                case 3:
                    console.log('Failure: 3');
                    $('#lblResponse').text('Sorry, File is not an image.');
                    break;
                case 4:
                    console.log('Failure: 4 - File Already Exists');
                    $('#lblResponse').text('Sorry, File Already Exists.');
                    break;
            }
        }
    });
}));/**
 * Created by Mathew on 5/25/2017.
 */
var i=0;
$(document).on("textInput input",".picviewduration",(function() {
if($(this).val()>0){
    $(this).closest('td').css({'background-color': '#0066cc'});
    console.log("blue")
}else{
    $(this).val('0')
    $(this).closest('td').css({'background-color': '#800000'});
    console.log("red")
    }
    $.ajax({
        url: 'controllers/promotioncontrollers/picviewercontroller.php',
        type: 'post',
        data: {action:'changeDuration',pictureid:$(this).data('picid'),newduration:$(this).val()},
        cache: false,
        global: false,
        success: function (html) {
            //console.log(html);
        },
        error: function (xhr, desc, err) {
            //console.log(xhr + "\n" + err);
        }
    });
}));
$(document).on("textInput input",".picvieworder",(function() {
    if($(this).val()>0){
    }else{
        $(this).val('0')
    }
    $.ajax({
        url: 'controllers/promotioncontrollers/picviewercontroller.php',
        type: 'post',
        data: {action:'changeOrder',pictureid:$(this).data('picid'),newOrder:$(this).val()},
        cache: false,
        global: false,
        success: function (html) {
            //console.log(html);
        },
        error: function (xhr, desc, err) {
            //console.log(xhr + "\n" + err);
        }
    });
}));
$(document).on("click",".delete-picture-slideshow",(function() {
    if (confirm("Are you sure?")) {
        // your deletion code


        $.ajax({
            url: 'controllers/promotioncontrollers/picviewercontroller.php',
            type: 'post',
            data: {
                action: 'deletePicture',
                pictureid: $(this).data('picid'),
                promotionId: $("#promotion-view-modal").data('promo-id'),
                picview_pictures_filename: $(this).data('picname')
            },
            cache: false,
            global: false,
            success: function (html) {
                console.log(html);
                loadPictures($("#promotion-view-modal").data('promo-id'));
            },
            error: function (xhr, desc, err) {
                console.log(xhr + "\n" + err);
            }
        });
        return false;
    }
}));



var loadPictures = function (promoid) {
        $('#PictureList').load("views/displaypromotionviews/picturelist.php", {promoid: promoid});
}



function WriteAPKFileToFirebase(filename,version) {
    var offset = new Date().getTime();
    var folder = $("#folder").val();
    var newPostKey = firebase.database().ref().child('Files/' + folder).push().key;
    var postData = {
        Filename: filename,
        Version: version,
        TimeStamp:-offset
    };
    // Write the new post's data simultaneously in the posts list and the user's post list.
    var updates = {};
    console.log("d:" + postData);
    updates['/Files/'+ folder  +"/"+ newPostKey] = postData;
    updates['/APK/' + folder + '/'] = postData;

    return firebase.database().ref().update(updates);
}


