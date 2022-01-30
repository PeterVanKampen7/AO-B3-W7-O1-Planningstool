<?php
    require("../includes/connect.php");
    $query = "SELECT username FROM users WHERE id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_GET["id"]]);
    $user = $result->fetch();

    $query = "SELECT * FROM aanwezigheid WHERE `user_id` = :safe ORDER BY appointment_id";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_GET["id"]]);
    $aanwezigheid_all = $result->fetchAll();

    $query = "SELECT * FROM schedule";
    $result = $conn->prepare($query);
    $result->execute();
    $schedule_all = $result->fetchAll();

    $schedule = array();
    foreach($schedule_all as $single){
        $schedule[$single['id']] = $single;
    }

    $query = "SELECT id, name FROM games";
    $result = $conn->prepare($query);
    $result->execute();
    $games_all = $result->fetchAll();

    $games = array();
    foreach($games_all as $game){
        $games[$game['id']] = $game['name'];
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
            <h1 class="index_title py-3">Gebruiker</h1>
            <div class="single_game_container container row w-100 p-3">
                <h5>Gebruiker infomatie</h5>
                <ul class="list-group mb-3">
                    <li class="list-group-item row flex-row d-flex">
                        <p class="col-4 m-0">Gebruikersnaam:</p>
                        <p class="col-8 m-0" ><?php echo $user['username'];?></p>
                    </li>
                </ul>
                <h5>Agenda</h5>
                <div class="controls my-3 p-2 row d-flex flex-row">
                    <p class="col-4 align-content-center m-0">Spelnaam</p>
                    <p class="col-4 align-content-center m-0">Start tijd</p>
                    <p class="col-4 align-content-center m-0">Rol</p>
                </div>
                <ul class="game_detail_list list-group">
                    <?php
                        foreach($aanwezigheid_all as $aanwezigheid){
                            $app_id = $aanwezigheid['appointment_id'];

                            $gamename = $games[$schedule[$app_id]['game_id']];
                            $start_time = $schedule[$app_id]['start_time'];
                            $role = $aanwezigheid['role']; 
                    ?>
                            <li class="list-group-item row flex-row d-flex">
                                <p class="col-4"><?php echo $gamename;?></p>
                                <p class="col-4"><?php echo $start_time;?></p>
                                <p class="col-4"><?php echo $role;?></p>
                            </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
        <div class="col-4 p3 col">
            <div class="single_game_buttons row d-flex justify-content-center mt-5">
            <a href="../user/editor.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-secondary col-2 mx-1"><i class="fas fa-edit"></i></a>
            <a href="../user/deleter.php?id=<?php echo $_GET["id"]; ?>" class="btn btn-danger col-2 mx-1"><i class="fas fa-trash"></i></a>
            </div>          
        </div>
        

    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>