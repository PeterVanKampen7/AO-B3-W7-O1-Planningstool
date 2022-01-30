<?php
    require("includes/connect.php");
    $query = "SELECT id, name, description, image FROM games ORDER BY name";
    $result = $conn->prepare($query);
    $result->execute();
    $rows = $result->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet"/>
    <title>Planningstool</title>
</head>
<body>
    <?php include('includes/header.php'); ?>

    <div class="content container mx-5 my-5 w-100 h-100">
        <h1 class="index_title py-3">Selecteer een spel om de details te bekijken</h1>

        <div class="games_container container row w-100 p-3">
            <?php
                foreach($rows as $game){

                    $template = file_get_contents('includes/game-card.php');
                    $game_info = array();
                    $game_info['game_title'] = $game['name'];
                    $game_info['game_desc'] = $game['description'];
                    $game_info['img_source'] = 'afbeeldingen/' . $game['image'];
                    $game_info['game_link'] = 'pages/game.php?id=' . $game['id'];
                    $game_info['game_plan'] = 'pages/inplannen.php?id=' . $game['id'];
                    foreach($game_info as $key => $value){
                        $template = str_replace('[[ '.$key.' ]]', $value, $template);
                    }

                    echo $template;
                }
            ?>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>
</html>