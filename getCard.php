<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Busca cartas</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php 
        include_once './funcoes/pegaDados.php';

        foreach (pegaDados($_GET['busca']) as $card):  ?>
        <div class="col">

            <div class="card">
                <img src="<?php echo $card->card_images[0]->image_url ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $card->name ?></h5>
                    <p class="card-text"><?php echo $card->atk ?? '' ?>/<?php echo $card->def ?? '' ?></p>
                </div>
            </div>

        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>