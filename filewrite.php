<?php
    $file = fopen('teste.txt','w+');

    fwrite($file, "1");
    fwrite($file, " 2\n");
    fwrite($file, "1");
    fwrite($file, " 2\n");fwrite($file, "1");
    fwrite($file, " 2\n");fwrite($file, "1");
    fwrite($file, " 2\n");fwrite($file, "1");
    fwrite($file, " 2\n");fwrite($file, "1");
    fwrite($file, " 2\n");fwrite($file, "1");
    fwrite($file, " 2\n");

    fclose($file);
?>