<?php
    include_once __DIR__ . "/includePath.php";
    include_once postiPath;
    include_once macchinePath;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["targa"])){
            insertMacchina($_POST["targa"]);
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(getPostiTotali() > 0): ?>
        <form method="post" action=".">
            <h3>Inserisci Targa</h3>
            <input type="text" name="targa"><br>
            <button type="submit">Inserisci Auto</button>
        </form>
    <?php else: ?>
        <h3>Posti Esauriti</h3>
    <?php endif;?>

    <div>
        <?php
            $listaMacchine = getMacchine();
            $i = 0;
            if(!empty($listaMacchine)):
        ?>
            <?php foreach($listaMacchine as $macchina): ?>
                <div class="divMacchina">
                    <div>
                        <h3>Auto N. <?php echo $i + 1 ?></h3>
                        <form method="post" action=<?php echo uscitaPath ?>>
                            <input type="hidden" name="delete" value=<?php echo $macchina["targa"] ?> >
                            <button type="success">Uscita</button>
                        </form>
                    </div>
                    Targa : <?php echo $macchina["targa"] ?> <br>
                </div>
                <?php $i++ ?>
            <?php endforeach; ?>
        <?php else: ?>
            <h3>Non ci sono macchine nel parcheggio.</h3>
        <?php endif; ?>
    </div>
</body>
</html>