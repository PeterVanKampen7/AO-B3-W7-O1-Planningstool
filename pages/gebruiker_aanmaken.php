<?php
    require("../includes/connect.php");
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
        <h1 class="index_title py-3">Aanmelden</h1>

        <div class="container row w-100 p-3">
            <form action="../function/user/create.php" method='post'>
                <div class="form-group my-2">
                    <label for="chosen_name">Gerbuikersnaam:</label>
                    <input type='text' name="chosen_name" id="chosen_name" class='form-control' required>
                </div>
                <button type="submit" class="btn btn-primary my-2">Aanmelden</button>
            </form>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>