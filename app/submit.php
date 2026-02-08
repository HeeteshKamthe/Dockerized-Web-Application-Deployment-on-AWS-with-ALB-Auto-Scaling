<?php
$host = getenv('DB_HOST');
$username   = getenv('DB_USER');
$password   =  getenv('DB_PASSWORD');
$dbname     =  getenv('DB_NAME');

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = $_POST["name"];
  $email   = $_POST["email"];
  $website = $_POST["website"];
  $comment = $_POST["comment"];
  $gender  = $_POST["gender"];

  $sql = "INSERT INTO users (name, email, website, comment, gender)
          VALUES ('$name', '$email', '$website', '$comment', '$gender')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully!";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
$conn->close();
?>