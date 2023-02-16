<?php
// define("RUTA_FISICA", dirname(dirname(dirname(_FILE_))) . '/');
// define("IMAGES_UPLOAD_PATH", RUTA_FISICA."src/public/images/");

define("DEBUG", false);

if(DEBUG) {
    define("RUTA_WEB", 'https://' . $_SERVER['HTTP_HOST'] . '/sysmarkthost/');     //LOCALHOST
    echo RUTA_WEB;    
}else{
    
    define("RUTA_WEB", 'https://' . $_SERVER['HTTP_HOST'] . '/');      //hosting
    echo RUTA_WEB;
}
?>