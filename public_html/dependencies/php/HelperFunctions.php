<?php

/**
 * This file contains public functions that help other public functions
 */

/**
* This function allows files to be found anywhere in the property directory
* so that they can be tested in any configuration and uploaded.
*/
    function getServerPath(){
      list($root, $home, $server, $public_html) = explode("/", $_SERVER['DOCUMENT_ROOT']);
      return "/" . $home . "/" . $server . "/";
    }
 ?>
