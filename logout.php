<?php
    session_start();
    
    session_destroy();
    header("Location: https://jacquelinee.sgedu.site/final_project/index.html");
    exit;
?>
