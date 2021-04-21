<?php
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: ./dashboard.php");
    exit;
}
require_once "../config/config.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!$_POST['email'] || !$_POST['password'])
    {
        echo "<script>alert('All input must be inserted')</script>";
    }
    else
    {
        $email = htmlspecialchars($_POST['email']);
        $pass = htmlspecialchars($_POST['password']);
        // Check email
        $users = mysqli_query($link, "SELECT * FROM tb_user WHERE email_user = '$email'");
        if (mysqli_num_rows($users) !== 0)
        {
            $userdata = mysqli_fetch_assoc($users);
            if (password_verify($pass, $userdata['password_user']))
            {
                $_SESSION['loggedin'] = true;
                $_SESSION['id'] = $userdata['id_user'];
                header('location: ./dashboard.php');
            }
            else
            {
                echo '<script>alert("You have entered wrong password!")</script>';
            }
        }
        else
        {
            echo '<script>alert("Email does not exist!")</script>';
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
        <title>Login</title>
    </head>
    <body>
        <div class="container-fluid bg-success">
            <div class="row min-vh-100 min d-flex justify-content-center">
                <div class="col-md-4 align-self-center">
                    <div class="card w-100">
                        <div class="card-body">
                            <h4 class="card-title">Login</h4>
                            <hr/>
                            <form method="post">
                                <div class="mb-2">
                                    <div class="form-floating mb-3">
                                        <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="password" class="form-control" placeholder="Occupation" type="password" id="password" required/>
                                        <label for="floatingTextarea">Password</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Login</button>
                                    <button type="button" onclick="resetForm()" class="btn btn-secondary">Reset</button>
                                </div>
                                <h6>Doesn't have an account? <a href="./register.php">Click here to register</a></h6>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/jquery/jquery-3.6.0.min.js"></script>
        <script>
        
        const resetForm = () => {
            $('#email').val('')
            $('#password').val('')
        }
        </script>
    </body>
</html>
