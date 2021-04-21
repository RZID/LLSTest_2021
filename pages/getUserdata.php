<?php
session_start();
require_once ('../config/config.php');
if (!$_SESSION["loggedin"])
{
    header("location: ./login.php");
    exit;
}
if ($_GET['email'])
{
    $email = htmlspecialchars($_GET['email']);
    $userdata = mysqli_query($link, "SELECT name_user, email_user, address_user, birthdate_user, occupation_user FROM tb_user WHERE email_user = '$email'");
    if (mysqli_num_rows($userdata) !== 0)
    {
        $datauser = mysqli_fetch_assoc($userdata);
    }
    else
    {
        header("location: ./dashboard.php");
        exit;
    }
}
else
{
    header("location: ./dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <title>View Detail Profile</title>
    </head>
    <body>
        <div class="container">
            <h3 class="my-5">
                View Detail Profile
                <hr/>
            </h3>
            <div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?=$datauser['name_user'] ?>" disabled>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" value="<?=$datauser['email_user'] ?>" disabled>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" disabled><?=$datauser['address_user'] ?></textarea>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Date Of Birth</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" disabled value="<?=date('d-m-Y', $datauser['birthdate_user']) ?>">
                    </div>
                </div>

                <div class="mb-5 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Occupation</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?=$datauser['occupation_user'] ?>" disabled>
                    </div>
                </div>

                <button class="btn btn-primary" onclick="redirect()">Back to dashboard</button>
            </div>
        </div>

        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/jquery/jquery-3.6.0.min.js"></script>    
        <script>
        const redirect = () => {
            window.location.href = "./dashboard.php";
        }
        </script>
    </body>
</html>
