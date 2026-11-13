<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__ . "/includePath.php" ?>
    <?php 
        include postiPath;
        include macchinePath;
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST["targa"])){
            insertMacchina($_POST["targa"]);
        }
    ?>

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
                    <h3>Auto N. <?php echo $i + 1 ?></h3>
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