<?php

    function getServerPath(){
      list($root, $home, $server, $public_html) = explode("/", $_SERVER['DOCUMENT_ROOT']);
      return "/" . $home . "/" . $server . "/";
    }
 ?>