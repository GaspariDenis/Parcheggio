<?php
include_once __DIR__ . "/../includePath.php";

include_once postiPath;

function getMacchine(){
    if(file_exists(macchineJsonPath)){
        $file = fopen(macchineJsonPath, "r");
        $content = fread($file, filesize(macchineJsonPath));
        fclose($file);
        return json_decode(
            $content,
            true
        );
    }
    return array();
}

function insertMacchina($targa){
    if(file_exists(macchineJsonPath)){
        $lista = getMacchine();

        $targa = strtoupper($targa);
        $patternTarga = '/^[A-Z]{2}\s?[0-9]{3}\s?[A-Z]{2}$/i';

        if(!preg_match($patternTarga, $targa))
            return;
        foreach($lista as $mac) {
            if($mac["targa"] == $targa)
                return;
        }

        $lista[] = array("targa"=>$targa, "oraEntrata"=>time());

        $file = fopen(macchineJsonPath, "w");
        fwrite(
            $file,
            json_encode($lista)
        );
        fclose($file);

        removePosto();
    }
}

function removeMacchina($targa) {
    $macchine = getMacchine();
    foreach($macchine as $indice => $macchina) {
        if($macchina["targa"] == $targa){
            unset($macchine[$indice]);
            break;
        }
    }

    if(file_exists(macchineJsonPath)){
        $file = fopen(macchineJsonPath, "w");
        fwrite($file, json_encode($macchine));
        fclose($file);
        addPosto();
    }
}
?>