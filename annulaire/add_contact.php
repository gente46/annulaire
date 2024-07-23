<?php
include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";
} else {
    $sql = "INSERT INTO contacts (name, email, phone) VALUES ('$name', '$email', '$phone')";
}

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
