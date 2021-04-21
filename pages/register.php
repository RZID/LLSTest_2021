<?php
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ./dashboard.php");
    exit;
}
function generateRandomString($length) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}
require_once "../config/config.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!$_POST['name'] || !$_POST['email'] || !$_POST['dob'] || !$_POST['address'] || !$_POST['occ']){
        echo "<script>alert('All input must be inserted')</script>";
    }else{
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $dob = strtotime(htmlspecialchars($_POST['dob']));
        $address = htmlspecialchars($_POST['address']);
        $occ = htmlspecialchars($_POST['occ']);
        $pass = generateRandomString(8);
        $encrypt_pass = password_hash($pass, PASSWORD_DEFAULT);
        // Check email
        $users = mysqli_num_rows(mysqli_query($link, "SELECT * FROM tb_user WHERE email_user = '$email'"));
        if($users === 0) {
            $insert_query = mysqli_query($link, "INSERT INTO tb_user (name_user, email_user, password_user, address_user, birthdate_user, occupation_user) VALUES ('$name', '$email', '$encrypt_pass', '$address', '$dob', '$occ')");

            if($insert_query){echo "<script>alert('Thank  you,  you  have  successfully  registered  as  our member.  use  your  email  and  password  as  follows: $pass to log into the system')</script>";}
        }
        else echo "<script>alert('Email already exist!')</script>";
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
        <title>Register</title>
    </head>
    <body>
        <div class="container-fluid bg-success">
            <div class="row min-vh-100 min d-flex justify-content-center">
                <div class="col-md-4 align-self-center">
                    <div class="card w-100">
                        <div class="card-body">
                            <h4 class="card-title">Register</h4>
                            <hr/>
                            <form method="post">
                                <div class="mb-2">
                                    <div class="form-floating mb-3">
                                        <input name="name" type="text" class="form-control" id="name" placeholder="Full Name" required>
                                        <label for="floatingInput">Full Name</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="email" type="email" class="form-control" id="email" placeholder="Email" required>
                                        <label for="floatingInput">Email</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <textarea name="address" required class="form-control" placeholder="Address" id="address"></textarea>
                                        <label for="floatingTextarea">Address</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="dob" class="form-control" placeholder="Date Of Birth" type="date" id="dob" required/>
                                        <label for="floatingTextarea">Date Of Birth</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input name="occ" class="form-control" placeholder="Occupation" type="text" id="occupation" required/>
                                        <label for="floatingTextarea">Occupation</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                    <button type="button" onclick="resetForm()" class="btn btn-secondary">Reset</button>
                                </div>
                                <h6>Already have an account? <a href="./login.php">Click here to login</a></h6>
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
            $('#name').val('')
            $('#email').val('')
            $('#address').val('')
            $('#dob').val('')
            $('#occupation').val('')
        }
        </script>
    </body>
</html>