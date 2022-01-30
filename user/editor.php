<?php
    require("../includes/connect.php");

    if(isset($_POST['submit'])){            
        $update = $conn->prepare("UPDATE `users` SET username=:safe WHERE id=:id");
        $update->execute(['safe' => $_POST['new_name'], 'id' => $_GET["id"]]);   
    }

    $query = "SELECT * FROM users WHERE id=:safe";
    $result = $conn->prepare($query);
    $result->execute(['safe' => $_GET["id"]]);
    $user = $result->fetch();
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
        <h1 class="index_title py-3">Gebruiker bewerken</h1>

        <?php
            if(isset($_POST['submit'])){
                ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-circle"></i>
                        Gebruiker bijgewerkt
                    </div>
                <?php
            }  
        ?>

        <div class="container row w-100 p-3">
            <form action="../user/editor.php?id=<?php echo $_GET['id']; ?>" method='post'>
                <div class="form-group my-2">
                    <label for="new_name">Gebruikersnaam:</label>
                    <input type='text' name="new_name" id="new_name" class='form-control' value='<?php echo $user['username']; ?>' required>
                </div>
                <button type="submit" name='submit' class="btn btn-primary my-2">Bijwerken</button>
            </form>
        </div>
    </div>


    <?php include('../includes/footer.php'); ?>
</body>
</html>