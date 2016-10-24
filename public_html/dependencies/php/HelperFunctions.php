<?php
/**
* This function allows files to be found anywhere in the casino directory
* so that they can be tested in any configuration and uploaded.
*/
	
    function getServerPath(){
      list($root, $home, $server, $public_html) = explode("/", $_SERVER['DOCUMENT_ROOT']);
      return "/" . $home . "/" . $server . "/";
    }
 ?>