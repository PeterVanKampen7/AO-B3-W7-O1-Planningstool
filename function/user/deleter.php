<?php
    require("../../includes/connect.php");

    if(isset($_POST['submit'])){      
        $result = $conn->prepare("DELETE FROM users WHERE id=:safe");
        $result->execute(['safe' => $_GET['id']]);
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
    <?php include('../../includes/header.php'); ?>
    
    <div class="content container mx-5 my-5 w-100 h-100">
        <h1 class="index_title py-3">Gebruiker verwijderen</h1>

        <?php
            if(isset($_POST['submit'])){
                ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-trash"></i>
                        Gebruiker verwijderd
                    </div>
                <?php
            } else {
        ?>

        <div class="container row w-100 p-3">
            <form action="../../function/user/deleter.php?id=<?php echo $_GET['id']; ?>" method='post'>
                <h4>Weet je zeker dat je deze gebruiker wilt verwijderen?</h4>
                <button type="submit" name='submit' class="btn btn-danger my-2"> <i class="fas fa-trash"></i> Verwijder gebruiker</button>
            </form>
        </div>
        <?php } ?>

    </div>


    <?php include('../../includes/footer.php'); ?>
</body>
</html>