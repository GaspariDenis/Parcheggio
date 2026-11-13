<?php
include __DIR__ . "/../includePath.php";

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
        $lista[] = array("targa"=>$targa, "oraEntrata"=>time());

        $targa = strtoupper($targa);
        $patternTarga = '/^[A-Z]{2}\s?[0-9]{3}\s?[A-Z]{2}$/i';
        if(in_array($targa, $lista) || !preg_match($patternTarga, $targa))
            return;

        $file = fopen(macchineJsonPath, "w");
        fwrite(
            $file,
            json_encode($lista)
        );
        fclose($file);
    }
}
?>