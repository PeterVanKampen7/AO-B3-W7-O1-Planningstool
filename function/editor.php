<?php
    require("../includes/connect.php");

    if(isset($_POST['submit'])){      
        
        $result = $conn->prepare("UPDATE schedule SET 
            game_id = :game_id,
            start_time = :start_time,
            end_time = 10,
            game_master = :game_master,
            WHERE id=:id"
        );
        $result->execute([
            'game_id' => intval($_POST['chosen_game']),
            'start_time' => intval(str_replace(':', '', $_POST['chosen_time'])),
            'game_master' => $_POST['chosen_gm'],
            'id' => $_GET["id"]
        ]);   


        $result = $conn->prepare("DELETE FROM aanwezigheid WHERE appointment_id=:safe");
        $result->execute(['safe' => $_GET['id']]);

        $result = $conn->prepare("INSERT INTO aanwezigheid SET 
                                    `user_id` = :user_id,
                                    appointment_id = :appointment_id,
                                    `role` = 'uitleg'
                                    ");
        $result->execute(['user_id' => $_POST['chosen_gm'],
                        'appointment_id' => $_GET["id"]
                        ]);

        foreach($_POST['chosen_player'] as $player){
            $result = $conn->prepare("INSERT INTO aanwezigheid SET 
                                    `user_id` = :user_id,
                                    appointment_id = :appointment_id,
                                    `role` = 'speler'
                                    ");
            $result->execute(['user_id' => $player,
                            'appointment_id' => $_GET["id"]
                            ]);
        }
    }    
    
    $query = "SELECT * FROM schedule WHERE id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_GET["id"]]);
    $schedule = $result->fetch();
    $start_time = str_split($schedule['start_time']);
    if(count($start_time) == 3){
        $start_time = '0' . $start_time[0] . ':' . $start_time[1]. $start_time[2];
    } else {
        $start_time = $start_time[0] . $start_time[1] . ':' . $start_time[2]. $start_time[3];
    }
    

    $query = "SELECT id, name FROM games ORDER BY name";
    $result = $conn->prepare($query);
    $result->execute();
    $games_all = $result->fetchAll();

    $userquery = "SELECT * FROM users ORDER BY username";
    $userresult = $conn->prepare($userquery);
    $userresult->execute();
    $users = $userresult->fetchAll();

    $userquery = "SELECT `user_id` FROM aanwezigheid WHERE appointment_id = :safe AND `role` != 'uitleg'";
    $userresult = $conn->prepare($userquery);
    $userresult->execute(['safe' => $_GET["id"]]);
    $players = $userresult->fetchAll();

    $selected_players = array();
    foreach($players as $player){
        $selected_players[] = $player['user_id'];
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
        <h1 class="index_title py-3">Ingepland moment bewerken</h1>

        <?php
            if(isset($_POST['submit'])){
                ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i>
                        Afspraak bijgewerkt
                    </div>
                <?php
            }  
        ?>

        <div class="container row w-100 p-3">
        <form action="../function/editor.php?id=<?php echo $_GET['id']; ?>" method='post'>
            
                <div class="form-group my-2">
                    <label for="chosen_game">Welk spel wil je inplannen?</label>
                    <select name="chosen_game" id="chosen_game" class='form-control' required>
                        <?php
                            foreach($games_all as $game){
                                if($schedule['game_id'] == $game['id']){
                                    echo '<option selected value="'.$game['id'].'">'.$game['name'].'</option>';
                                } else {
                                    echo '<option value="'.$game['id'].'">'.$game['name'].'</option>';
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label for="chosen_time">Welke tijd gaat dit spel gespeelt worden?</label>
                    <input type='time' name="chosen_time" id="chosen_time" class='form-control' required value="<?php echo $start_time; ?>">
                </div>
                <div class="form-group my-2">
                    <label for="chosen_gm">Wie geeft uitleg bij dit spel?</label>
                    <select name="chosen_gm" id="chosen_gm" class='form-control' required>
                        <?php
                            foreach($users as $user){
                                if($user['id'] == $schedule['game_master']){
                                    echo '<option value="'.$user['id'].'" selected>'.$user['username'].'</option>';
                                } else {
                                    echo '<option value="'.$user['id'].'">'.$user['username'].'</option>';
                                }
                                
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label for="chosen_player">Wie gaan dit spel spelen?</label>
                    <select name="chosen_player[]" id="chosen_player" class='form-control' required multiple  value="<?php echo $schedule['players']; ?>">
                        <?php
                            foreach($users as $user){
                                if(in_array($user['id'], $selected_players)){
                                    echo '<option value="'.$user['id'].'" selected>'.$user['username'].'</option>';
                                } else {
                                    echo '<option value="'.$user['id'].'">'.$user['username'].'</option>';
                                }
                                
                            }
                        ?>
                    </select>
                    <p class="text-secondary">Ctrl + klik voor meerdere opties</p>
                </div>


                <button type="submit" name='submit' class="btn btn-primary my-2">Bewerk afspraak</button>
            </form>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>