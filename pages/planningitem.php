<?php
    require("../includes/connect.php");
    $query = "SELECT * FROM schedule WHERE id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_GET["id"]]);
    $schedule = $result->fetch();

    $query = "SELECT * FROM games WHERE id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $schedule['game_id']]);
    $game = $result->fetch();

    $query = "SELECT * FROM aanwezigheid WHERE appointment_id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_GET["id"]]);
    $aanwezigheid_all = $result->fetchAll();

    $query = "SELECT * FROM users";
    $result = $conn->prepare($query);
    $result->execute();
    $users_all = $result->fetchAll();

    $users = array();
    foreach($users_all as $user){
        $users[$user['id']] = $user['username'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="../style/style.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/7cbd5a96fb.js" crossorigin="anonymous"></script>
    <title>Planningstool</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>

    <div class="content container row mx-5 my-5 w-100 h-100">
        <div class="col-8 p3 col">
            <h1 class="index_title py-3">Ingepland spel</h1>

            <div class="single_game_container container row w-100 p-3">
                <h5>Afspraak infomatie</h5>
                <ul class="game_detail_list list-group mb-3">
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Start tijd:</p>
                        <p class="col-8"><?php echo $schedule['start_time'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Uitleg van:</p>
                        <p class="col-8"><?php echo $users[$schedule['game_master']];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Spelers:</p>
                        <p class="col-8"><?php 
                            foreach($aanwezigheid_all as $aanwezigheid){
                                if($aanwezigheid['role'] != 'gm'){
                                    echo $users[$aanwezigheid['user_id']] . '</br>';
                                }
                            }
                        ?></p>
                    </li>
                </ul>
                <h5>Spel informatie</h5>
                <ul class="game_detail_list list-group">
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Naam:</p>
                        <p class="col-8"><?php echo $game['name'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Uitbreindingen:</p>
                        <p class="col-8"><?php echo $game['expansions'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Vaardigheden:</p>
                        <p class="col-8"><?php echo $game['skills'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Link:</p>
                        <p class="col-8"><a href="<?php echo $game['url'];?>"><?php echo $game['url'];?></a></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Minimale spelers:</p>
                        <p class="col-8"><?php echo $game['min_players'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Maximale spelers:</p>
                        <p class="col-8"><?php echo $game['max_players'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Speeltijd:</p>
                        <p class="col-8"><?php echo $game['play_minutes'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Uitleg tijd:</p>
                        <p class="col-8"><?php echo $game['explain_minutes'];?></p>
                    </li>
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4">Spel beschrijving:</p>
                        <p class="col-8"><?php echo $game['description'];?></p>
                    </li>
                    <li class="list-group-item row">
                        <p class="col-4">Youtube video:</p>
                        <p class="col-8"><?php echo $game['youtube'];?></p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-4 p3 col">
            <img src="../afbeeldingen/<?php echo $game['image']; ?>" alt="Game Image" class="img-fluid py-3 single_game_img col-12">  
            <div class="single_game_buttons row d-flex justify-content-center">
            <a href="../function/editor.php?id=<?php echo $schedule['id']; ?>" class="btn btn-secondary col-2 mx-1"><i class="fas fa-edit"></i></a>
            <a href="../function/deleter.php?id=<?php echo $schedule['id']; ?>" class="btn btn-danger col-2 mx-1"><i class="fas fa-trash"></i></a>
            </div>          
        </div>
        

    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>