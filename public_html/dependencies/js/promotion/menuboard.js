
var MenuElementCount=0;
var promoid=0;
$(document).ready(function() {


    $(document).on('click', '.Menu-Object', function (e) {
        e.stopPropagation()
        var tmp = $("#SelectMultiMenuObjects").prop("checked") ? true : false;
       if (!e.ctrlKey&&tmp==false){
            unSelectAll();
           console.log("multi: " + tmp)
        }else{
           console.log("multfi: " + tmp)
        }
        $(this).toggleClass("selected-Item")
        console.log("Selected Count:" + $(".selected-Item").length)
        $(".selected-Item").each(function (i) {

        })
        //makeDraggable(this);
        $(this).children("span.glyphicon-move").toggle(true)
        $(".properties-window").toggleClass("hide-window",true);
        switch ($(this).data("type")) {
            case "PictureSlideshow":
                ShowSlideshowProperties();
                break;
            case "Label":
                ShowLabelProperties();
                break;
                ShowIconProperties()
        }
    });
    $(document).on('click', '#content_area', function (e) {
        var pos = $(this).position();

        $(".properties-window").toggleClass("hide-window",true);
        if (!e.ctrlKey){
            unSelectAll();
        }else{

        }    });
    $(document).on('click', '#save-fb-layout', function () {
       var tmp = SaveMenuLayout();

    });
    $(document).on('click', '#delete-fb-object', function () {

        if (confirm("Are you sure you want to delete \n"+$(".selected-Item").text() +"?")) {
            $(".selected-Item").each(function (i) {
                updates[$(this).data("fbkey")]=null;
            })
            $(".selected-Item").remove();


        }
        return false;
    });

    $(document).on('click', '#copy-fb-object', function () {

        var newItem = $(".selected-Item").clone(true);
        $(newItem).appendTo("#content_area")
        var newPostKey = PromotionRef.push().key;
        $(newItem).attr('data-fbkey', newPostKey);
        makeDraggable(newItem);
        return false;
    });
});

$(document).on('click', '#AllTagSelector', function () {
    unSelectAll()
    $('.Menu-Object[data-type="Label"]').addClass("selected-Item")
    ShowLabelProperties();
    return false;
});
$(document).on('click', '.tagSelector', function () {
    console.log("Clicked" +$(this).text())
    unSelectAll()
    $('.Menu-Object[data-tags~="'+$(this).text()+'"]').addClass("selected-Item")
    console.log("Count:" + getSelectedCount())
    ShowLabelProperties();
    return false;
});
$(document).on('propertychange change keyup input paste','.edit-menu-item',function () {
    SaveMenuItem(this)
});
$(document).on('click', '.move-ObjButton', function () {

    switch ($(this).data("direction").toString()){
        case "n":
            //$(tmp).css("left", Math.round(curObject["left"]+pos.left));
            //$(tmp).css("top", Math.round(curObject["top"]+pos.top));
            $(".selected-Item").each(function (i) {
                $(this).css("top",+$(this).position().top-2)
            })
            break;
        case "nw":
            $(".selected-Item").each(function (i) {
                $(this).css("top",+$(this).position().top-2)
                $(this).css("left",+$(this).position().left-2)
            })
            break;
        case "ne":
            $(".selected-Item").each(function (i) {
                $(this).css("top",+$(this).position().top-2)
                $(this).css("left",+$(this).position().left+2)
            })
            break;
        case "s":
            $(".selected-Item").each(function (i) {
                $(this).css("top",+$(this).position().top+2)
            })
            break;
        case "se":
            $(".selected-Item").each(function (i) {
                $(this).css("top",+$(this).position().top+2)
                $(this).css("left",+$(this).position().left+2)
            })
            break;
        case "sw":
            $(".selected-Item").each(function (i) {
                $(this).css("top",+$(this).position().top+2)
                $(this).css("left",+$(this).position().left-2)
            })
            break;
        case "e":
            $(".selected-Item").each(function (i) {
                $(this).css("left",+$(this).position().left+2)
            })

            break;
        case "w":
            $(".selected-Item").each(function (i) {
                $(this).css("left",+$(this).position().left-2)
            })

            break;
        default:
            console.log("Def Moved:" + $(this).data("direction"));
    }
    $("#mbLeft").val(Math.round(+$(".selected-Item").position().left*2))
    $("#mbTop").val(Math.round(+$(".selected-Item").position().top*2))
});

var PromotionRef = firebase.database().ref('Promotions/' + promoid + "/layout");
function makeDraggable($item) {
    var attr = $($item).attr("data-fbkey");
    var addkey=true;
    var newPostKey = PromotionRef.push().key;
    if (typeof attr !== typeof undefined && attr !== false) {
        addkey=false
    }else{
        addkey=true;
    }
    $($item).append("<span class='glyphicon glyphicon-move'></span>")
    $item.draggable({
        grid: [ 1, 1],
        containment: "#content_area",
        handle:"span.glyphicon-move",
        helper:"original",
        start: function() {
            unSelectAll();
            ShowLabelProperties();
            $item.trigger("click")

        },
        stop: function() {
        $item.trigger("click")

        }
    });

    rel = $item.data('type');
    $item.removeClass("draggable");
    $item.removeClass("menu-tile");
    $item.addClass("Menu-Object");
    $item.attr("id","mnuobj"+MenuElementCount);
    //$item.text($item.text().trim());

    if (rel == "Label") {
        //$item.css({width:'200px'});
        if(addkey){
            $item.attr('data-fbkey',newPostKey);
        }

        //    $item.html("<div id='e1' class='drag_elm'>Item 1</div>");
    } else if (rel == "PictureSlideshow") {
        $item.addClass("Picture-Slideshow");
        if(addkey){
            $item.attr('data-fbkey',newPostKey);
        }

        //  $item.html("<div id='e2' class='drag_elm'>Item 2</div>");

    }
    else if (rel == "Icon") {
        //  $item.html("<div id='e2' class='drag_elm'>Item 2</div>");
        if(addkey){
            $item.attr('data-fbkey',newPostKey);
        }
    }
}
function unSelectAll(){
    $(".selected-Item").removeClass("selected-Item");
    $("#slideshow_properties").toggleClass("hide-window",true);
    $("#label_properties").toggleClass("hide-window",true);
    $('span.glyphicon-move').toggle(false)
}

function ShowIconProperties(){
    $("#icon_properties").toggleClass("hide-window").toggle(false);

    $("#iconwidth").val(($(".selected-Item").width()));
    $("#iconheight").val(($(".selected-Item").height()));


    $("#iconwidth").bind("propertychange change keyup input paste", function (event) {
        $(".selected-Item").width($("#iconwidth").val());
    });
}
function getSelectedCount() {
    return numItems = $('.selected-Item').length
}
var menuTags = []
function UpdateMenuTags(){
    $( ".labeltag").autocomplete({
        source: menuTags,
        select: function (event, ui) {
            //$("#tags_code").val(ui.item.value);
        }
    });
    var newMenuTags = []
    $(".Menu-Object[data-tags]").each(function(i){
        str = $(this).attr("data-tags")
        //console.log("Should update Tags to " + str)
        var curTags = str.split(' ');
        //console.log(JSON.stringify(curTags));
        $(curTags).each(function (i) {
            if(curTags[i].length>0){
                newMenuTags.indexOf(curTags[i]) === -1 ? newMenuTags.push(curTags[i]) : console.log("This item already exists");
            }


        });

        //console.log(JSON.stringify(newMenuTags));
    });
    menuTags = newMenuTags;
    menuTags.sort()
    $('.tagSelector').remove()
    $('#AllTagSelector').remove()
    $(menuTags).each(function (i) {
        $('#Tag-Holder').append("<button type='button' class='tagSelector' data-tag='"+menuTags[i]+"'>" + menuTags[i] + "</button>")

    })
    $('#Tag-Holder').prepend("<button type='button' id='AllTagSelector'>Select All</button>")
}

function ShowSlideshowProperties(){
    //console.log("Selected Slideshow")
    $("#mbPictureSizeH").val(Math.round(+$(".selected-Item").height()*2))
    $("#mbPictureSizeW").val(Math.round(+$(".selected-Item").width()*2))

    $("#slideshow_properties").toggleClass("hide-window",false);
    $('#fb-slideshow').val($(".selected-Item").attr("data-promoid"))
    $('#fb-slideshow').on('change', function() {
    $(".selected-Item").attr("data-promoid",$('#fb-slideshow').val())
    $(".selected-Item").html("Picture Slideshow<br>"+$('#fb-slideshow :selected').text().replace('-',"<br>"))
    })

}
$("#slideshow_properties").toggleClass("hide-window",false);
function ShowLabelProperties(){
if(getSelectedCount()>0){
    $("#label_properties").toggleClass("hide-window",false);

    $("#mbLeft").val(Math.round(+$(".selected-Item").position().left*2))
    $("#mbTop").val(Math.round(+$(".selected-Item").position().top*2))
    if(numItems==1){
        $("#labeltext").toggle(true);
        $("#labeltext").val($(".selected-Item").text().trim())
        $(".labeltag").val($(".selected-Item").attr("data-tags"))
    }else{
        $("#labeltext").toggle(false);
    }
    $("#labelhint").val($(".selected-Item").attr("data-hint"))
    if($(".selected-Item").attr("data-ebs")==" "||$(".selected-Item").attr("data-ebs")=="false"){
       isChecked=false
    }else{
        isChecked=true
    }
    $("#labelebs").prop("checked",isChecked);
    $("#labelfont").val($(".selected-Item").css('font-size').replace('px',''));

    $("#labelfontcolor").val(rgb2hex($(".selected-Item").css('color')));

    SpectrumIt($("#labelfontcolor"))
    $("#labeltext").bind("propertychange change keyup input paste", function (event) {
        $(".selected-Item").children("p").text($("#labeltext").val());
    });
    $("#labelhint").bind("propertychange change keyup input paste", function (event) {
        $(".selected-Item").attr("data-hint",$("#labelhint").val());
    });
    $("#labelebs").bind("propertychange change keyup input paste", function (event) {
        $(".selected-Item").attr("data-ebs",$('#labelebs').is(":checked"));
    });
    $("#labelfont").bind("propertychange change keyup input paste", function (event) {
        if($("#labelfont").val()<2){
            fnt = 2
            $("#labelfont").val(fnt)
        }else{
            fnt = $("#labelfont").val()
        }
        $(".selected-Item").css("font-size",fnt+"px" );
    });
}
}

var PromotionRef;
function LoadRestaurantMenu(promoid) {
    var pos = $("#content_area").position();
    PromotionRef= firebase.database().ref('Promotions/' + promoid + "/layout");
    PromotionRef.on('value', function (snapshot) {
        snapshot.forEach(function (userSnapshot) {
            curObject = JSON.parse(JSON.stringify(userSnapshot));
            if(!ObjectExists(curObject,userSnapshot)) {
                if (curObject["type"] != null) {
                    switch(curObject["type"]){
                        case "Label":
                        //var tmp = $("#MenuLabel").clone(true).appendTo("#content_area")
                        var tmp = $("<div>", {
                            id: "mnuobj" + MenuElementCount,
                            "class": "Menu-Object"
                        }).appendTo("#content_area");
                        MenuElementCount++
                        $(tmp).addClass("Menu-Object");
                        if($.contains(curObject["text"],"§")){
                            $("#labelglutenfree").prop('checked', true);
                        }
                        //$(tmp).text(curObject["text"]);
                            $(tmp).append("<p>" + curObject["text"] + "</p>")
                        $(tmp).css("font-size", curObject["fontsize"] + "px");
                        $(tmp).css("left", Math.round(curObject["left"]+pos.left));

                        $(tmp).css("top", Math.round(curObject["top"]+pos.top));
                        $(tmp).css("position", "absolute");
                        $(tmp).css("color", curObject["color"]);
                        $(tmp).attr("id", "mnuobj" + MenuElementCount);
                        $(tmp).attr('data-fbkey', userSnapshot.key);
                        $(tmp).attr('data-type', curObject["type"]);
                        $(tmp).attr('data-tags', curObject["tags"]);
                        $(tmp).attr('data-promoid', promoid);
                        $(tmp).attr('data-hint', checkValidData(curObject["hint"]));
                        $(tmp).attr('data-ebs', checkValidData(curObject["ebs"]));
                        $(tmp).attr('data-datatype', checkValidData(curObject["dataType"]));
                        makeDraggable(tmp)
                            break;
                        case "PictureSlideshow":
                            tmp = $("<div>").appendTo("#content_area");
                            $(tmp).addClass("Menu-Object");
                            $(tmp).addClass("Picture-Slideshow");
                            $(tmp).css("left",Math.round(curObject["left"]+pos.left));
                            $(tmp).css("top", Math.round(curObject["top"]+pos.top));
                            $(tmp).height(Math.round(curObject["height"]));
                            console.log("height should be:" + Math.round(curObject["height"]))
                            $(tmp).width(Math.round(curObject["width"]));
                            $(tmp).css("position", "absolute");
                            $(tmp).attr("id", "mnuobj" + MenuElementCount);
                            $(tmp).attr('data-fbkey', userSnapshot.key);
                            $(tmp).attr('data-promoid', curObject["promoid"]);
                            $(tmp).attr('data-type', curObject["type"]);
                            $(tmp).text("Picture Slideshow");

                            makeDraggable(tmp)
                            break
                        case "Icon":
                             tmp = $("<img>").appendTo("#content_area");
                            $(tmp).addClass("Menu-Object");
                            $(tmp).attr("src",curObject["image"]);
                            $(tmp).css("left",Math.round(curObject["left"]+pos.left));

                            $(tmp).css("top", Math.round(curObject["top"]+pos.top));
                            $(tmp).height(curObject["height"]);
                            $(tmp).width(curObject["width"]);
                            $(tmp).css("position", "absolute");
                            $(tmp).attr("id", "mnuobj" + MenuElementCount);
                            $(tmp).attr('data-fbkey', userSnapshot.key);
                            $(tmp).attr('data-type', curObject["type"]);
                        makeDraggable(tmp)
                            break;
                        default:
                            console.log("Type not found: " + curObject["type"])
                            break;
                    }
                }else{
                    switch (userSnapshot.key){
                        case "Background-Data":
                            $("#content_area").css("background-image","url('"+FullBackURL+ curObject["image"]+"')");
                            $("#content_area").css("background-repeat", curObject["repeat"]);
                            $("#content_area").css("background-size", curObject["size"]);
                            $("#content_area").attr('data-filename',curObject["image"])
                            break;
                    }

                }
            }else{

            }
            //console.log("found:" + curDisplay["DisplayName"] + " linkcode=" + curDisplay["LinkCode"]);

        });
        UpdateMenuTags()
    });

}
function LoadRestaurantStaff(promoid) {
    MenuElementCount=0;
    PromotionRef= firebase.database().ref('Promotions/' + promoid + "/layout");
    PromotionRef.once('value').then(function (snapshot) {
        snapshot.forEach(function (userSnapshot) {
            curObject = JSON.parse(JSON.stringify(userSnapshot));
            if(!ObjectExists(curObject,userSnapshot)) {
                if (curObject["type"] != null) {
                    switch(curObject["type"]){
                        case "Label":
                            //var tmp = $("#MenuLabel").clone(true).appendTo("#content_area")
                            MenuElementCount++
                            if(curObject["ebs"]=="true"){
                              var tmpRow= $("#tblContent").append("<tr><td>" + curObject["hint"] + "</td><td id='mnutd"+MenuElementCount+"'></td></tr>")

                                var tmpInput = $("#mnutd" + MenuElementCount).append("<input id='mnuobj"+ MenuElementCount+"' type='text' value='"+curObject["text"]+"'>")
                                //"<input class='editByStaffItem' type='text' data-fb='"+userSnapshot.key+"' value='"+curObject["text"]+"'>"
                                $(tmpInput).children(':input').attr("id", "mnuobj" + MenuElementCount);
                                $(tmpInput).children(':input').attr('data-fbkey', userSnapshot.key);
                                $(tmpInput).children(':input').addClass("edit-menu-item")
                                //$(tmp).attr('data-hint', checkValidData(curObject["hint"]));
                                //$(tmp).attr('data-ebs', checkValidData(curObject["ebs"]));
                                $(tmpInput).children(':input').attr('data-fbkey', userSnapshot.key);
                                $(tmpInput).children(':input').attr('data-type', curObject["type"]);
                            }

                            break;
                        default:
                            console.log("Type not found: " + curObject["type"])
                            break;
                    }
                }
            }
            //console.log("found:" + curDisplay["DisplayName"] + " linkcode=" + curDisplay["LinkCode"]);

        });
    });

}

function checkValidData(data){
    if(typeof data == 'undefined'){
        console.log("returning RRR")
        return " "

    }else{
        console.log("returning original data")
        return data

    }

}
var updates = {};
function SaveMenuLayout(){
    if(CheckForRules()) {


        var pos = $("#content_area").position();
        var newPostKey = PromotionRef.push().key;

        console.log("Count:" + $(".Menu-Object").length)

        $(".Menu-Object").each(function (i) {
            var attr = $(this).attr('data-tags');

// For some browsers, `attr` is undefined; for others,
// `attr` is false.  Check for both.
            if (typeof attr !== typeof undefined && attr !== false) {

            } else {
                attr = "";
            }
            switch ($(this).data("type")) {
                case "Label":

                    var menuObject = {
                        text: $(this).text().trim(),
                        height: Math.round($(this).height()),
                        width: Math.round($(this).width()),
                        left: Math.round($(this).position().left - pos.left),
                        top: Math.round($(this).position().top - pos.top),
                        type: $(this).data("type"),
                        tags: attr,
                        fontsize: $(this).css("font-size").replace('px', ''),
                        color: rgb2hex($(this).css("color")),
                        hint:checkValidData($(this).attr("data-hint")),
                        datatype:checkValidData($(this).attr('data-datatype')),
                        ebs:checkValidData($(this).attr("data-ebs"))
                    }
                    break;
                case "Icon":
                    var menuObject = {
                        height: $(this).height(),
                        width: $(this).width(),
                        left: $(this).position().left - pos.left,
                        top: $(this).position().top - pos.top,
                        type: $(this).data("type"),
                        image: $(this).attr('src')
                    }
                case "PictureSlideshow":
                    var menuObject = {
                        height:  Math.round($(this).height()),
                        width:  Math.round($(this).width()),
                        left: Math.round($(this).position().left - pos.left),
                        top: Math.round($(this).position().top - pos.top),
                        type: $(this).data("type"),
                        promoid: $(this).attr("data-promoid")
                    }
                    console.log(JSON.stringify(menuObject))
                    break
            }
            updates["Background-Data"] = {
                image: $("#content_area").attr("data-filename"),
                size: $("#content_area").css("background-size"),
                repeat: $("#content_area").css("background-repeat")
            };
            updates[$(this).data("fbkey")] = menuObject;
        });
        var internalupdate = updates;
        updates = {};
        alert("Layout Saved");
        return PromotionRef.update(internalupdate);
    }
}
//Read Layout
function SaveMenuItem(item){

//        var pos = $("#content_area").position();
//        var newPostKey = PromotionRef.push().key;
            switch ($(item).data("type")) {
                case "Label":
                    console.log("changing:" +$(item).val().trim())
                    PromotionRef.child($(item).data("fbkey")).update({text:$(item).val().trim()})
                    //updates[$(item).data("fbkey")+"/text/"] = $(item).val().trim();
                    break;
            }
        console.log("Layout Item Saved");
        //return PromotionRef.update(internalupdate);
}


function CheckForRules() {
    var isGood = false;

    var msg="";
    var attr = $("#content_area").attr("data-filename");
    if (typeof attr !== typeof undefined && attr !== false) {
        brisGood=true;
    } else {
        brisGood=false
        msg += "You must select a background to continue\n"
    }
    attr = $(".Menu-Object[data-type='PictureSlideshow']").data("promoid");
    cnt = $(".Menu-Object[data-type='PictureSlideshow']").length;
    if (typeof attr !== typeof undefined && attr !== false||cnt==0) {
        isGood=true;
    } else {
        isGood=false
        msg += "All of your Picture Slideshows Must have a Promotion Selected\n"
    }
    if(!brisGood||!isGood){
        alert(msg)
        return false
    }else{
        return true
    }



}
function ObjectExists(curObject,snapshot) {
    var exist= false;
    var obj = $("div[data-fbkey='" + snapshot.key +"']");
    if(obj.length){
        exist=true

    }else{

    }
    return exist
}
function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}

var hexDigits = new Array
("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");