<?php
include('conn.php');
$data = $_POST;
$user_id = (int) $data['user_id'];
$firstname = $data['f_name'];
$lastname = $data['l_name'];


try{

    $command = $conn->prepare("DELETE FROM users WHERE id = $user_id");
 
    $command->execute();

    echo json_encode([
        'success' => true,
        'message' => $firstname . ' ' . $lastname . ' ' . 'succssfully deleted'
    ]);

}catch (PDOException $e){

     echo json_encode([
        'success' => false,
        'message' =>  'Error!'
     ]);

}