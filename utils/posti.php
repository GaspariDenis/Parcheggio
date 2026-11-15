<?php
include_once __DIR__ . "/../includePath.php";

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

function removePosto(){
    if(file_exists(configJsonPath)){
        $toWrite = getPostiTotali() - 1;
        $file = fopen(configJsonPath, "w");
        fwrite($file, json_encode(array("postiTotali"=>$toWrite)));
        fclose($file);
    }
}

function addPosto() {
    if(file_exists(configJsonPath)){
        $toWrite = getPostiTotali() + 1;
        $file = fopen(configJsonPath, "w");
        fwrite($file, json_encode(array("postiTotali"=>$toWrite)));
        fclose($file);
    }
}
?>