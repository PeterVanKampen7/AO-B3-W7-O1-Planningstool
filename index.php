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
<header class='fixed-top'>
    <div class='row d-flex bg-dark '>
        <h1 class="header_title col-4 text-light px-5">Planningstool</h1>
        <ul class="header_nav col-8 flex-row align-items-center mb-0 d-flex justify-content-end">
            <li class="nav_item btn btn-primary mx-3">
                <a href="<?php echo 'index.php'; ?>" class="nav-link text-light py-1">Home</a>
            </li>
            <li class="nav_item btn btn-primary mx-3">
                <a href="<?php echo 'pages/inplannen.php'; ?>" class="nav-link text-light py-1">Inplannen</a>
            </li>
            <li class="nav_item btn btn-primary mx-3">
                <a href="<?php echo 'pages/overzicht.php'; ?>" class="nav-link text-light py-1">Agenda</a>
            </li>
            <li class="nav_item btn btn-primary mx-3">
                <a href="<?php echo 'pages/gebruiker_aanmaken.php'; ?>" class="nav-link text-light py-1">Aanmelden</a>
            </li>
            <li class="nav_item btn btn-primary mx-3">
                <a href="<?php echo 'pages/gebruiker_overzicht.php'; ?>" class="nav-link text-light py-1">Gebruikers</a>
            </li>
        </ul>
    </div>
</header>

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