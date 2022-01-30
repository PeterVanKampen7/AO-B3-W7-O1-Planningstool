<?php
    require("../includes/connect.php");
    $query = "SELECT play_minutes FROM games WHERE id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_POST["chosen_game"]]);
    $duration = $result->fetch();
    $duration = $duration['play_minutes'];

    $game_id = $_POST['chosen_game'];
    $start_time = intval(str_replace(':', '', $_POST['chosen_time']));
    $end_time = $start_time + intval($duration);
    $gm = $_POST['chosen_gm'];
    $players = $_POST['chosen_player'];

    $result = $conn->prepare("INSERT INTO schedule SET 
                                    game_id = :game_id,
                                    start_time = :start_time,
                                    end_time = :end_time,
                                    game_master = :game_master
                                    ");
    $result->execute(['game_id' => $game_id,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'game_master' => $gm
                    ]);

    $app_id = $conn->lastInsertId();

    $result = $conn->prepare("INSERT INTO aanwezigheid SET 
                                    `user_id` = :user_id,
                                    appointment_id = :appointment_id,
                                    `role` = 'gm'
                                    ");
    $result->execute(['user_id' => $gm,
                    'appointment_id' => $app_id
                    ]);

    foreach($players as $player){
        $result = $conn->prepare("INSERT INTO aanwezigheid SET 
                                    `user_id` = :user_id,
                                    appointment_id = :appointment_id,
                                    `role` = 'player'
                                    ");
        $result->execute(['user_id' => $player,
                        'appointment_id' => $app_id
                        ]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style/style.css"/>
    <title>Planningstool</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="content container mx-5 my-5 w-100 h-100">
        <h1 class="index_title py-3">Spel succesvol ingepland</h1>

        <div class="container row w-100 p-3">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_pWVo9w.json"  background="transparent"  speed="1"  style="width: 30%; height: 30%;" autoplay></lottie-player>       </div>
            <a href="../pages/overzicht.php" class="btn btn-primary">Ga naar het overzicht</a>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>