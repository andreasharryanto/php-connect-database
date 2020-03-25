<?php
//create database in phpmyadmin
//connect database (host, user, pass, database)
$conn = mysqli_connect('localhost', 'root', '', 'university');
//check error
if(!$conn) die('error : ' . mysqli_connect_error());
else echo 'success connect db<br>';

//DRY
function insert_data($conn, $studentname, $studentage, $studentaddress){
    $query = "INSERT INTO student(studentname, studentage, studentaddress)
            VALUE ('$studentname', '$studentage', '$studentaddress')";
    mysqli_query($conn, $query);
}
// insert_data($conn, 'five','5','five street');

if(isset($_POST["submit"])){
    $name = $_POST['name'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    insert_data($conn, $name, $age, $address);
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<head>
    <title>University Website</title>
    <script type="text/javascript" src="index.js"></script>
</head>
<body>
    <form action="" method="POST">
        <br><label for="name">Name : </label><input type="text" name="name" id="name">
        <br><label for="age">Age : </label><input type="text" name="age" id="age">
        <br><label for="address">Address : </label><input type="text" name="address" id="address">
        <br><button type="submit" name="submit">Add</button>
    </form>
</body>
</html>