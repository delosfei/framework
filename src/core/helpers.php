<?php
function dd($content)
{
    echo "<pre>";
    var_dump($content);
    die("</pre>");
}
function dump($content)
{
    echo "<pre>";
    print_r($content);
    echo "</pre>";
}
