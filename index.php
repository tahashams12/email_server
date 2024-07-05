<?php




include 'db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/src/Exception.php';
require 'vendor/src/PHPMailer.php';
require 'vendor/src/SMTP.php';

if(isset($_POST['submit'])){

    
    $email = $_POST['email'];
    $login_token = bin2hex(random_bytes(16));
    $login_link = "localhost/Email_Server/login.php?login_token=".$login_token;
    
   


    $mail = new PHPMailer(true); //  yeah mail ka object banaya hai
   try {
   
    $mail->isSMTP(); // yhan pr smtp ka use kr rhy hain
    $mail->Host = 'smtp.gmail.com'; // yhan pr gmail ka smtp server use kr rhy hain 
    $mail->SMTPAuth = true; // yhan pr authentication kr rhy hain gmail k through
    $mail->Username = 'privatetshams@gmail.com';  // yhan pr apna email likha hai
    $mail->Password = 'qagg ymag zmob czye';  // yhan pr apna password likha hai
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // yhan pr secure connection bnaya hai
    $mail->Port = 587; // yhan pr port number likha hai
    $mail->setFrom('privatetshams@gmail.com', 'Anonymous'); // yhan pr sender ka email likha hai
    $mail->addAddress($_POST['email'], 'Anonymous');  // yhan pr receiver ka email likha hai
    $mail->isHTML(true); // email ki formatting html mai hai
    $mail->Subject = 'One Time Login Code'; // yhan pr subject likha hai
    $mail->Body    = 'Click the following link to log in: <a href="' . $login_link . '">' . 'LOGIN' . '</a>'; // yhan pr body likha hai
     $mail->send(); // yhan pr mail send kr rhy hain
    echo 'Email has been sent successfully.';

    $_POST['submit']=null;


    // data db mien tab insert kiyaa hai jab email send ho jaye usse pehal nhii toh data db mien invalid data na jyee
    $sql = "INSERT INTO login_tokens (email, token) VALUES ('$email', '$login_token')";

    
    if (mysqli_query($conn, $sql)) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }



    echo "<script>
    alert('Email Sent Successfully!');
    window.location.href = 'index.php';
  </script>";
  $conn->close();
  exit();

    
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    $_POST['submit']=null;
    echo "<script>
    alert('Retry Please!! enter valid email address');
    window.location.href = 'index.php';
  </script>";
  $conn->close();
  exit();

}



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School of Bitcoin Shop</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="needs-validation" method="post" >
                    <div class="mb-3">
                        <label for="username" class="form-label">Recipient's username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="username" placeholder="Username" name="email" required>
                            <span class="input-group-text">@example.com</span>
                            <div class="invalid-feedback">
                                Please enter a valid username.
                            </div>
                        </div>
                    </div>
                    <button type="submit"  name="submit" value="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>


</body>
</html>

