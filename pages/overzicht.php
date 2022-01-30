<?php
    require("../includes/connect.php");
    $query = "SELECT id, game_id, start_time, game_master FROM schedule";
    $result = $conn->prepare($query);
    $result->execute();
    $schedule_all = $result->fetchAll();

    $query = "SELECT id, play_minutes, name FROM games";
    $result = $conn->prepare($query);
    $result->execute();
    $games_query = $result->fetchAll();

    $games = array();
    foreach($games_query as $game){
        $games[$game['id']] = $game;
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
    <script src="https://kit.fontawesome.com/7cbd5a96fb.js" crossorigin="anonymous"></script>
    <title>Planningstool</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="content container mx-5 my-5 w-100 h-100">
        <h1 class="index_title py-3">Overzicht</h1>

        <div class="container row w-100 p-3">
            <div class="controls my-3 p-2 row d-flex flex-row">
                <p class="col-2 align-content-center m-0">Spelnaam</p>
                <p class="col-2 align-content-center m-0">Start tijd</p>
                <p class="col-2 align-content-center m-0">Tijdsduur</p>
                <p class="col-2 align-content-center m-0">Uitleg van</p>
            </div>
            <ul class="list-group">
                
                <?php
                    foreach($schedule_all as $schedule){
                        ?>
                            <li class="list-group-item row d-flex flex-row">
                                <p class="game_name col-2"><?php echo $games[$schedule['game_id']]['name'] ?></p>
                                <p class="start_time col-2"><?php echo $schedule['start_time'] ?></p>
                                <p class="duration col-2"><?php echo $games[$schedule['game_id']]['play_minutes'] ?></p>
                                <p class="gm col-2"><?php echo $schedule['game_master'] ?></p>
                                <div class="controls row d-flex flex-row col-4">
                                    <a href="planningitem.php?id=<?php echo $schedule['id']; ?>" class="btn btn-primary col-7 mx-1">Details</a>
                                    <a href="../function/editor.php?id=<?php echo $schedule['id']; ?>" class="btn btn-secondary col-2 mx-1"><i class="fas fa-edit"></i></a>
                                    <a href="../function/deleter.php?id=<?php echo $schedule['id']; ?>" class="btn btn-danger col-2 mx-1"><i class="fas fa-trash"></i></a>
                                </div>
                            </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>