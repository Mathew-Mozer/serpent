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

		//Button Click
		$(".tile-menu-item").click(function(){
			alert("You clicked an option");
		});

    });
	

   </script>
</html>


 
