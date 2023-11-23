<?php
include_once("koneksi.php");
$result = mysqli_query($mysqli, "SELECT * FROM contact ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contact List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <div class="card">
        <div class="card-header shadow text-center">
        Contact List
        </div>
        <div class="card-body shadow-lg">
        <a href="form.php" class="btn btn-primary">Add Contact</a>
        <table class="table table-bordered table-striped mt-2 ">
            <thead>
                <tr class="text-center">
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
                $php = 1;
                while($user_data = mysqli_fetch_array($result)) {         
                    echo "<tr>";
                    echo "<td class='text-center'>".$php++."</td>";
                    echo "<td>".$user_data['name']."</td>";
                    echo "<td><a href='javascript:void(0)' onclick='showEmailAlert(\"".$user_data['email']."\")'>".$user_data['email']."</a></td>";
                    echo "<td>".$user_data['phone']."</td>";   
                    echo "<td><a href='javascript:void(0)' onclick='showWebsiteAlert(\"".$user_data['website']."\")' target='_blank'>".$user_data['website']."</a></td>";
                    echo "<td>".$user_data['message']."</td>";
                    echo "<td class='text-center'><a href='edit.php?id=" . $user_data['id'] . "'onclick='return confirmEdit();'>Edit</a> | ";
                    echo "<a href='delete.php?id=" . $user_data['id'] . "' onclick='return confirmDelete();'>Delete</a></td></tr>";             
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function showEmailAlert(email) {
            if (confirm("You are about to open an email to: " + email + "\nAre you sure you want to proceed?")) {
            window.location.href = "mailto:" + email;
        }
    }     
        function showWebsiteAlert(website) {
            if (confirm("You are about to visit the website: " + website + "\nAre you sure you want to proceed?")) {
                window.open(website, '_blank');
        }
    }
        function confirmEdit() {
            return confirm("Are you sure you want to edit this record?");
    }
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
    }
    </script>
    </body>
</html>
