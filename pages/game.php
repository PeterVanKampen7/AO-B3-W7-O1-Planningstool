<?php
    require("../includes/connect.php");
    $query = "SELECT * FROM games WHERE id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_GET["id"]]);
    $row = $result->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet" />
    <title>Planningstool</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <div class="content container row mx-5 my-5 w-100 h-100">
        <div class="col-8 p3 col">
            <h1 class="index_title py-3"><?php echo $row['name'];?></h1>

            <div class="single_game_container container row w-100 p-3">
                <ul class="game_detail_list list-group">
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Naam:</p>
                        <p class="col-8"><?php echo $row['name'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Uitbreindingen:</p>
                        <p class="col-8"><?php echo $row['expansions'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Vaardigheden:</p>
                        <p class="col-8"><?php echo $row['skills'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Link:</p>
                        <p class="col-8"><a href="<?php echo $row['url'];?>"><?php echo $row['url'];?></a></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Minimale spelers:</p>
                        <p class="col-8"><?php echo $row['min_players'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Maximale spelers:</p>
                        <p class="col-8"><?php echo $row['max_players'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Speeltijd:</p>
                        <p class="col-8"><?php echo $row['play_minutes'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Uitleg tijd:</p>
                        <p class="col-8"><?php echo $row['explain_minutes'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Spel beschrijving:</p>
                        <p class="col-8"><?php echo $row['description'];?></p>
                    </li>
                    <li class="list-group-item row">
                        <p class="col-4">Youtube video:</p>
                        <p class="col-8"><?php echo $row['youtube'];?></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-4 p3 col">
            <img src="../afbeeldingen/<?php echo $row['image']; ?>" alt="Game Image" class="img-fluid py-3 single_game_img col-12">
            <div class="single_game_buttons row d-flex justify-content-center">
                <a href="inplannen.php?id=<?php echo $row['id']; ?>" class="btn btn-primary col-4 mx-2">Spel inplannen</a>
                <!-- <a href="#" class="btn btn-primary col-4 mx-2">Inschrijven</a> -->
            </div>
            
        </div>
        

    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>