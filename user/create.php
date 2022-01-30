<?php
    require("../includes/connect.php");

    $result = $conn->prepare("INSERT INTO users SET username = :username");
    $result->execute(['username' => $_POST['chosen_name']]);
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
        <h1 class="index_title py-3">Gebruiker aangemaakt</h1>

        <div class="container row w-100 p-3">
            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
            <lottie-player src="https://assets3.lottiefiles.com/packages/lf20_pWVo9w.json"  background="transparent"  speed="1"  style="width: 30%; height: 30%;" autoplay></lottie-player>       </div>
            <a href="../pages/overzicht.php" class="btn btn-primary">Ga naar de agenda</a>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>