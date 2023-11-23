<?php
    $min  = 1;
    $max  = 25;
    $num1 = rand( $min, $max );
    $num2 = rand( $min, $max );
?>
<!DOCTYPE html>
<html>
<head>
    <title>form-captcha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>  
    <div class="container">
        <div class="row justify-content-center">
        <div class="card col-md-6 mt-4 shadow-lg">
            <div class="card-header ">
                CONTACT US
            </div>
            <div class="card-body">
        <form id="contact-form" method="POST">
            <div class="col-12">
                Name : <input type="text" name="name" id="name" class="form-control shadow-lg" autocomplete="off" placeholder="Name" maxlength="55" required><br>
                Email : <input type="email" name="email"  id="email" class="form-control shadow-lg" autocomplete="off" placeholder="Email" maxlength="55" required><br>
                Phone : <input type="number" name="phone" id="phone" class="form-control shadow-lg" autocomplete="off"  placeholder="Phone" required ><br>
                Website with prefix : <input type="text" id="urlInput" class="form-control shadow-lg" name="website" autocomplete="off" maxlength="255" placeholder="Website with prefix" required><br>
                Message : <textarea name="message" id="message" class="form-control shadow-lg" placeholder="Your message" maxlength="255" required></textarea> </br>
                <div class="row">
                    <label for="quiz" class="col-sm-3 col-form-label">
                        <?php echo $num1 . '+' . $num2; ?> 
                    </label>
                    <div class="col-sm-9">
                        <input type="hidden" name="no1" class="form-control" value="<?php echo $num1 ?>">
                        <input type="hidden" name="no2"  class="form-control" value="<?php echo $num2 ?>">
                        <input type="text" name="test" class="form-control quiz-control shadow-lg" autocomplete="off" id="quiz" placeholder="Captcha" required>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary shadow-lg mt-3"  name="submit" id="submit">
            </form>
            </div>
        </div>
    </div>
</div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"]))
            {
                $test = $_POST["test"];
                $number1 = $_POST["no1"];
                $number2 = $_POST["no2"];
                $total = $number1 + $number2;
                if ($total == $test)
                { 
                    $name = $_POST["name"];
                    $email = $_POST["email"];
                    $phone = $_POST["phone"];
                    $website = $_POST["website"];
                    $message = $_POST["message"];
                
                    include_once("koneksi.php");
                    
                    $result = mysqli_query($mysqli, "INSERT INTO contact(name,email,phone,website,message) VALUES('$name','$email','$phone','$website','$message')");
                    if  ($result)
                    {
                        $message = "Data added successfully!";
                        echo "<script type='text/javascript'>
                        alert('$message');
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 100);
                       </script>";
                        exit();
                    }
                     else
                    {
                        $message = "Error adding data. Please try again.";
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    }
                }
               else
                {
                    $message = "Invalid captcha entered!";
                    echo "<script type='text/javascript'>
                    alert('$message');
                    setTimeout(function() {
                        window.location.href = 'form.php';
                    }, 100);
                   </script>";
                }
            } 
        ?>
    <script type="text/javascript">
        const nameInput = document.getElementById("name");
        nameInput.addEventListener("blur", function() {
           const nameNumber = nameInput.value;
            if (nameNumber.length > 55) {
             alert("name cannot contain more than 55 digits!");     
            }
        });
        const emailInput = document.getElementById("email");
        emailInput.addEventListener("blur", function() {
           const emailNumber = emailInput.value;
            if (emailNumber.length > 55) {
             alert("email cannot contain more than 55 digits!");     
            }
        });

        var currentURL = ("http://");
        document.getElementById("urlInput").value = currentURL;

        const websiteInput = document.getElementById("urlInput");
        websiteInput.addEventListener("blur", function() {
           const websiteNumber = websiteInput.value;
            if (websiteNumber.length > 255) {
             alert("website cannot contain more than 255 digits!");     
            }
        });
        const messageInput = document.getElementById("message");
        messageInput.addEventListener("blur", function() {
           const messageNumber = messageInput.value;
            if (messageNumber.length > 255) {
             alert("message cannot contain more than 255 digits!");     
            }
        });

        function isValidPhoneNumber(phone) {
            return /^\d{0,13}$|^$/.test(phone);
        }

        document.getElementById('phone').addEventListener('input', function () {
            var phoneInput = this;
            var phoneValue = phoneInput.value.trim();

            if (!isValidPhoneNumber(phoneValue)) {
               phoneInput.value = alert('Invalid phone number. Please enter a valid phone number (up to 13 digits).');
              e = phoneValue.replace(/\D/g, '').slice(0, 13); 
            }
        });
   
    </script>
</body>
</html>
