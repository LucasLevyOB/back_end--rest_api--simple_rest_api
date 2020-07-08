<?php

$internalFolder = 'simpleRestAPIPHP/';
$protocol = 'http://';
define('DIRPAGE', "{$protocol}{$_SERVER['HTTP_HOST']}/{$internalFolder}");
if(substr($_SERVER['DOCUMENT_ROOT'], -1) == '/'){
    define('DIRREC', "{$_SERVER['DOCUMENT_ROOT']}{$internalFolder}");
}else{
    define('DIRREC', "{$_SERVER['DOCUMENT_ROOT']}/{$internalFolder}");
}

// access to database
define('HOST', 'localhost');
define('DB', '');
define('USER', 'lucaslevy');
define('PASS', 'lucaslevy');