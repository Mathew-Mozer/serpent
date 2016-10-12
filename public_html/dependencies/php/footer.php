<?php
/*
* Footer
* Author: Stephen King
* Version 2016.10.5.1
*
* This page controls the footer and closing material for the website
*/
?>
    <footer>


    </footer>
   </body>

   <script>

   $(document).ready(function(){

       //Show option bar
       $(".tile-body").hover(function(){
           $(this).children(".tile-menu-bar").removeClass("hidden");
       }, function(){
           $(this).children(".tile-menu-bar").addClass("hidden");

       });

       //highlight option under mouse
		$(".tile-menu-item").hover(function(){
        $(this).addClass("tile-menu-item-hover");
        }, function(){
        $(this).removeClass("tile-menu-item-hover");

		});


       $(".settingsBtn").unbind('click').click(function(){
           settingsModal.dialog('open');
       });

       $("#add-promotion-btn").click(function(){
           addPromotionModal.dialog('open');
       });

       //Open add/remove user panel
       $(".userBtn").unbind('click').click(function(){
           editUsersModal.dialog('open');
       });

       /*
        These are the modal windows that can be opened. Note that these need
        to be moved to their own file. Most likely they should just be aggregated
        as they are 90% similar.
        */

       var editUsersModal = $("#editUsers").dialog({
           autoOpen: false,
           height: 400,
           width: 350,
           modal: true,
           buttons: {
               Submit: function () {
                   //submit changes to db through options modal class
                   editUsers.dialog('close');
               }
           }
       });

       //Adds a new tile to the view with the image that is passed into the function
       var addPromotion = function(data) {
           $('#promotion-list').append(
               '<div class="tile-body">'+
                    '<img class="tile-icon" src="dependencies/images/' + data + '">'+
                    '<div class="tile-menu-bar hidden">'+
                        '<div class="tile-menu-item settingsBtn">'+
                            '<span class="glyphicon glyphicon-cog glyphicon-menu black" aria-hidden="true"></span>'+
                        '</div>'+
                        '<div class="tile-menu-item">'+
                            '<span class="glyphicon glyphicon-pause glyphicon-menu black" aria-hidden="true"></span>'+
                        '</div>'+
                        '<div class="tile-menu-item">'+
                            '<span class="glyphicon glyphicon-user glyphicon-menu black" aria-hidden="true"></span>'+
                        '</div>'+
                    '</div>'+
               '</div>'
           );
       };

       var addPromotionModal = $("#addPromotion").dialog({
           autoOpen: false,
           height: 400,
           width: 350,
           modal: true,
           buttons: {
               Submit: function () {
                   var id = $('select[name=promoId]').val();
               //Ajax call to update database with new promotion
                 $.ajax({
                        url: 'controllers/addPromotion.php',
                        type: 'post',
                        data: {id: id},
                        cache: false,
                        success:function(response){
                            console.log(response);

                            //update view with new promotion
                            addPromotion(response.image);
                            addPromotionModal.dialog('close');
                        },
                        error: function(xhr, desc, err){
                         console.log(xhr + "\n" + err);
                        }
                    });
               }
           }
       });

       var settingsModal = $("#settings").dialog({
           autoOpen: false,
           height: 400,
           width: 350,
           modal: true,
           buttons: {
               Submit: function () {
                   //submit changes to db through options modal class
                   settingsModal.dialog('close');
               }
           }
       });
   });

   </script>
</html>
