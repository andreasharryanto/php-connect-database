<?php
//create database in phpmyadmin
//connect database (host, user, pass, database)
$conn = mysqli_connect('localhost', 'root', '', 'university');
//check error
if(!$conn) die('error : ' . mysqli_connect_error());
else echo 'success connect db<br>';

$result = mysqli_query($conn, "SELECT * FROM student");
if( !$result ){
    echo mysqli_error($conn);
}

//you can use view-source:http://localhost/php_database/

//mysqli_fetch_row() index by number = var_dump($students[3]);
//mysqli_fetch_assoc() index by string (associative array) = var_dump($students["studentaddress"]);
//mysqli_fetch_array() index by number or string
//mysqli_fetch_object() return object = var_dump($students->studentaddress);

// $students = mysqli_fetch_assoc($result);
// var_dump($students->studentaddress);

// while($students = mysqli_fetch_assoc($result)){
//     var_dump($students[3]);
// }

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
    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Student Age</th>
            <th>Studnet Address</th>
        </tr>
        <?php while($students = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $students["studentid"]?></td>
            <td><?= $students["studentname"]?></td>
            <td><?= $students["studentage"]?></td>
            <td><?= $students["studentaddress"]?></td>
        </tr>
        <?php endwhile;?>
    </table>
</body>
</html>