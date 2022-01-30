<?php
    require("../includes/connect.php");
    $query = "SELECT * FROM users ORDER BY username ASC";
    $result = $conn->prepare($query);
    $result->execute();
    $users_all = $result->fetchAll();
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
        <h1 class="index_title py-3">Gebruikers</h1>

        <div class="container row w-100 p-3">
            <div class="controls my-3 p-2 row d-flex flex-row">
                <p class="col-4 align-content-center m-0">Gebruikersnaam</p>
            </div>
            <ul class="list-group">
                
                <?php
                    foreach($users_all as $user){
                        ?>
                            <li class="list-group-item row d-flex flex-row align-items-center">
                                <p class="user_name col-4 m-0"><?php echo $user['username'] ?></p>
                                <p class="col-5 m-0"></p>
                                <div class="controls row d-flex flex-row col-3">
                                    <a href="gebruiker.php?id=<?php echo $user['id']; ?>" class="btn btn-primary col-6 mx-1">Details</a>
                                    <a href="../function/user/editor.php?id=<?php echo $user['id']; ?>" class="btn btn-secondary col-2 mx-1"><i class="fas fa-edit"></i></a>
                                    <a href="../function/user/deleter.php?id=<?php echo $user['id']; ?>" class="btn btn-danger col-2 mx-1"><i class="fas fa-trash"></i></a>
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