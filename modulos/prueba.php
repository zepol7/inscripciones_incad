<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $archivo = "107-20-4391.pdf";
        $filename = "../uploads/2017/04/07/" . $archivo;
        header("Expires: -1");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Content-type: application/pdf;\n"); //or yours?
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0");
        header("Pragma: no-cache");
        $len = filesize($filename);
        //header("Content-Length: $len;\n");
        $outname = $archivo;
        header("Content-Disposition: attachment; filename=" . $filename . ";\n\n");
        readfile($filename);
        ?>
    </body>
</html>
