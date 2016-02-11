<?php 
    
    if(!isset($Link->getLocal()[2])):
        include_once 'upload.php';
    else:
        include_once 'save.php';
    endif;
