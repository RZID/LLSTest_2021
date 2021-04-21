<?php
session_start();
require_once ('../config/config.php');
if (!$_SESSION['loggedin'])
{
    header("location: ./login.php");
    exit;
}
$user_id = $_SESSION['id'];
$userdata = mysqli_query($link, "SELECT * FROM tb_user WHERE id_user = '$user_id'");

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $old = $_POST['old'];
    $new = $_POST['new'];
    $retype = $_POST['retype'];
    if (!$_POST['old'] || !$_POST['new'] || !$_POST['retype']) echo "<script>alert('All input must be inserted')</script>";
    else
    {
        if ($_POST['new'] !== $_POST['retype'])
        {
            echo "<script>alert('New password and retype password must be same!')</script>";
        }
        else
        {
            if (!password_verify($old, mysqli_fetch_assoc($userdata) ['password_user']))
            {
                echo "<script>alert('Old password not match')</script>";
            }
            else
            {
                $pass = password_hash($new, PASSWORD_DEFAULT);
                $update_pass = mysqli_query($link, "UPDATE tb_user SET password_user = '$pass'");
                if ($update_pass)
                {
                    echo "<script>alert('Password changed succesfully')</script>";
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <title>Change Password</title>
    </head>
    <body>
        
        <div class="container my-5">
            <h3>
                Change Password
                <hr/>
            </h3>
            <form method="post">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="old">
                    <label for="floatingPassword">Old Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="new">
                    <label for="floatingPassword">New Password</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="retype">
                    <label for="floatingPassword">Retype Password</label>
                </div>

                <button class="btn btn-primary" type="submit">Change Password</button>
                <button class="btn btn-secondary"onclick="to('./dashboard.php')" type="button">Cancel</button>
            </form>
        </div>

        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/jquery/jquery-3.6.0.min.js"></script>
        <script>
        
        const resetForm = () => {
            $('#email').val('')
            $('#password').val('')
        }
        const to = (url) => {
            return window.location.href = url
        }
        </script>
    </body>
</html>
