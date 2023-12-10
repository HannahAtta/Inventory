<?php
session_start();

include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

$table_name = $_SESSION['table'];

$firstname = $_POST['full name'];
// $lastname = $_POST['last_name'];
$email =  filter_var($_POST['email'], FILTER_SANITIZE_STRING);
$password = $_POST['password'];
$encrypted = password_hash($password, PASSWORD_DEFAULT);


try{

    $command = $conn->prepare("INSERT INTO 
    $table_name(full name, password,  email, created_at,updated_at)
     VALUES
   (:firstname, :encrypted, :email, NOW(), NOW())");
 
    $command->execute(array(

    'firstname' => $firstname,
    // 'lastname' => $lastname,
    'encrypted' => $encrypted,
    'email' => $email,

    ));

    $response = [
        'success' => true,
        'message' => $firstname . ' ' . $lastname . ' ' . 'succssfully added to the system'
    ];

}catch (PDOException $e){

    $response = [
        'success' => false,
        'message' =>  $e->getMessage()
    ];

}

$_SESSION['response'] = $response;
header('Location: adduser.php');
exit();


}
