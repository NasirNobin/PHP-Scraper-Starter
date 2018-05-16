<?php 
use Sunra\PhpSimple\HtmlDomParser;

function html($html){
    return HtmlDomParser::str_get_html( $html );
}
