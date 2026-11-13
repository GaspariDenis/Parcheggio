<?php
include __DIR__ . "/../includePath.php";

function getPostiTotali(){
    if(file_exists(configJsonPath)){
        $file = fopen(configJsonPath, "r");
        return json_decode(
            fread($file, filesize(configJsonPath)), 
            true
            )["postiTotali"];
    }
    return -1;
}
?>