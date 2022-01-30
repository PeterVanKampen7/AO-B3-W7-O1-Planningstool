<?php
    require("../includes/connect.php");
    $query = "SELECT id, name FROM games ORDER BY name";
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
    <link rel="stylesheet" href="../style/style.css"/>
    <title>Planningstool</title>
</head>
<body>
    <?php include('../includes/header.php'); ?>
    
    <div class="content container mx-5 my-5 w-100 h-100">
        <h1 class="index_title py-3">Plan een spel in</h1>

        <div class="container row w-100 p-3">
            <form action="">
                <div class="form-group">
                    <label for="chosen_game">Welk spel wil je inplannen?</label>
                    <select name="chosen_game" id="chosen_game" class='form-control'>
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
                <div class="form-group">

                </div>
                <div class="form-group">

                </div>
                <div class="form-group">

                </div>
            </form>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>