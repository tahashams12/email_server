<?php
include 'db.php';



if(isset($_POST['logout'])) { 
    echo "<script>
alert('Logged out successfully.');
window.location.href = 'index.php';
</script>";
$conn->close();
exit();
}

if (isset($_GET['login_token'])) {
    $token = $_GET['login_token'];
    $sql = "SELECT email FROM login_tokens WHERE token = '$token'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $email = $row['email'];

    if ($result->num_rows > 0) {
        echo "<script>alert('Logged in successfully. Welcome, " . $email . "!');</script>";
    } else {
        echo "<script>
    alert('Invalid Login Link!');
    window.location.href = 'index.php';
  </script>";
        $conn->close();
        exit();
    }

    $conn->close();
} else {
    echo "<script>
    alert('Invalid Login Link!');
    window.location.href = 'index.php';
  </script>";
    $conn->close();
    exit();
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
   
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .logout-container {
            text-align: right;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col text-right mt-3">
                <form action="login.php" method="POST">
                    <button type="submit" name="logout" value="logout" class="btn btn-success">Logout</button>
                </form>
            </div>
        </div>
    </div>


   
</body>

</html>