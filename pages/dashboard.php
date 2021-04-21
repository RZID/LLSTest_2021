<?php 
session_start();
require_once('../config/config.php');
if(!$_SESSION['loggedin']){
    header("location: ./login.php");
    exit;
}
$user_id = $_SESSION['id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!$_POST['name'] ||!$_POST['email'] ||!$_POST['address'] ||!$_POST['birthdate'] ||!$_POST['occ'] ){
        echo "<script>alert('All input must be inserted')</script>";
    }else{
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $address = htmlspecialchars($_POST['address']);
        $birthdate = strtotime($_POST['birthdate']);
        $occ = htmlspecialchars($_POST['occ']);

        $query_update = mysqli_query($link, "UPDATE tb_user SET 
        name_user = '$name', 
        email_user = '$email', 
        address_user = '$address', 
        birthdate_user = '$birthdate', 
        occupation_user = '$occ' 
        WHERE id_user = '$user_id'
        ");

        if($query_update){
            echo '<script>
            alert("Your data has been updated succesfuly");
            </script>';
        }else{
            echo'error!';
        }
    }
}

$userdata = mysqli_query($link, "SELECT name_user, email_user, address_user, birthdate_user, occupation_user FROM tb_user WHERE id_user = '$user_id'");
$datauser  = mysqli_fetch_assoc($userdata);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <title>Dashboard</title>
</head>
<body>
    <div class="container my-5">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Dashboard</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button onclick="logout()" class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Logout</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="my-5">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Occupation</th>
                                <th scope="col">Act</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $usersdata = mysqli_fetch_all(mysqli_query($link, 'SELECT name_user, email_user, occupation_user FROM tb_user'), MYSQLI_ASSOC);
                        $i = 1;
                        foreach($usersdata as $row) : ?>
                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $row['name_user'] ?></td>
                                <td><?= $row['email_user'] ?></td>
                                <td><?= $row['occupation_user'] ?></td>
                                <td><a href="./getUserdata.php?email=<?= $row['email_user'] ?>">View</a></td>
                            </tr>
                            <?php $i++; endforeach; ?> 
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <h3 class="my-5">
                    Manage Profile
                    <hr/>
                </h3>
                <div>
                <form method="post">
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $datauser['name_user'] ?>" name="name" >
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" value="<?= $datauser['email_user'] ?>" 
                            name="email">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="address"><?= $datauser['address_user'] ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Date Of Birth</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="birthdate" value="<?= date('Y-m-d', $datauser['birthdate_user']) ?>">
                        </div>
                    </div>

                    <div class="mb-5 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Occupation</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="occ" value="<?= $datauser['occupation_user'] ?>" >
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary" type="submit">Update Profile</button>
                        <button class="btn btn-secondary" type="button" onclick="reset()">Cancel</button>
                    </div>
                    <a href="./changePass.php">Change Password</a>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/jquery/jquery-3.6.0.min.js"></script>
    <script>
        const logout = () => {
            window.location.href = "../config/kill_session.php";
        }
    </script>
    </body>
</html>