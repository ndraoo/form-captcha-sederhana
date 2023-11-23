    <?php 
    include_once("koneksi.php");
    if(isset($_POST['update']))
    {	
    $id = $_POST['id'];

    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $website = $_POST["website"];
    $message = $_REQUEST["message"];

    $result = mysqli_query($mysqli, "UPDATE contact SET name='$name',email='$email',phone='$phone',website='$website',message='$message' WHERE id=$id");
    if ($result)
    {
          $message = "Data updated successfully!";
          echo "<script type='text/javascript'>
          alert('$message');
              window.location.href = 'index.php';
         </script>";
    }
    }
    ?>
  <?php
    $id = $_GET['id'];
         
    $result = mysqli_query($mysqli, "SELECT * FROM contact WHERE id=$id");
            
    while($user_data = mysqli_fetch_array($result))
    {
    $name = $user_data['name'];
    $email = $user_data['email'];
    $phone = $user_data['phone'];
    $website = $user_data['website'];
    $message = $user_data['message'];
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
        <div class="row justify-content-center">
        <div class="card col-md-6 mt-4 shadow-lg">
            <div class="card-header ">
               EDIT CONTACT US
            </div>
            <div class="card-body">
        <form method="POST" name="update_contact" action="edit.php">
            <div class="col-12">
                Name : <input type="text" name="name" id="name" class="form-control shadow-lg" autocomplete="off" placeholder="Name" maxlength="55" value="<?php echo $name;?> "><br>
                Email : <input type="email" name="email" id="email" class="form-control shadow-lg" autocomplete="off" placeholder="Email" maxlength="55" value="<?php echo $email;?>"><br>
                Phone : <input type="text" name="phone" id="phone" class="form-control shadow-lg" autocomplete="off"  placeholder="Phone" value="<?php echo $phone;?>"><br>
                Website with prefix : <input type="text" id="urlInput" class="form-control shadow-lg" name="website" autocomplete="off" maxlength="255" placeholder="Website with prefix" value="<?php echo $website;?>"><br>
                Message : <textarea name="message" class="form-control shadow-lg" id="message" placeholder="Your message" maxlength="255"><?php echo htmlspecialchars($message);?></textarea> </br>
            </div>
            <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
            <td><input type="submit" name="update" class="btn btn-primary" value="Update"></td>
            </form>
            </div>
        </div>
    </div>
</div>  
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
            if (emailNumber.length > 55 ) {
             alert("email cannot contain more than 55 digits!");     
            }
        });

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

        phoneInput.value = phoneValue.replace(/\D/g, '');

            if (!isValidPhoneNumber(phoneInput.value)) {
                alert('Invalid phone number. Please enter a valid phone number (up to 13 digits).');
            }
        });
</script>
</body>
</html>
