<?php

/**
 * This file contains public functions that help other public functions
 * //
 */

/**
 * This function allows files to be found anywhere in the property directory
 * so that they can be tested in any configuration and uploaded.
 */
function getServerPath(){
    list($root, $home, $server, $public_html,$fld1,$fld2) = explode("/", $_SERVER['DOCUMENT_ROOT']);
    return "/" . $home . "/" . $server . "/".$public_html."/".$fld1."/";
    ////return $_SERVER['DOCUMENT_ROOT'];
}
function is_iterable($var)
{
    return $var !== null
    && (is_array($var)
        || $var instanceof Traversable
        || $var instanceof Iterator
        || $var instanceof IteratorAggregate
    );
}
?>
