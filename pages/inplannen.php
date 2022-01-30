<?php
    require("../includes/connect.php");
    $query = "SELECT id, name FROM games ORDER BY name";
    $result = $conn->prepare($query);
    $result->execute();
    $rows = $result->fetchAll();

    $userquery = "SELECT * FROM users ORDER BY username";
    $userresult = $conn->prepare($userquery);
    $userresult->execute();
    $users = $userresult->fetchAll();
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
        <h1 class="index_title py-3">Plan een spel in</h1>

        <div class="container row w-100 p-3">
            <form action="../function/planner.php" method='post'>
                <div class="form-group my-2">
                    <label for="chosen_game">Welk spel wil je inplannen?</label>
                    <select name="chosen_game" id="chosen_game" class='form-control' required>
                        <?php
                            foreach($rows as $game){
                                if($_GET['id'] == $game['id']){
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
                    <input type='time' name="chosen_time" id="chosen_time" class='form-control' required>
                </div>
                <div class="form-group my-2">
                    <label for="chosen_gm">Wie geeft uitleg bij dit spel?</label>
                    <select name="chosen_gm" id="chosen_gm" class='form-control' required>
                        <?php
                            foreach($users as $user){
                                echo '<option value="'.$user['id'].'">'.$user['username'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group my-2">
                    <label for="chosen_player">Wie gaan dit spel spelen?</label>
                    <select name="chosen_player[]" id="chosen_player" class='form-control' required multiple>
                        <?php
                            foreach($users as $user){
                                echo '<option value="'.$user['id'].'">'.$user['username'].'</option>';
                            }
                        ?>
                    </select>
                    <p class="text-secondary">Ctrl + klik voor meerdere opties</p>
                </div>
                <button type="submit" class="btn btn-primary my-2">Plan het spel in</button>
            </form>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>