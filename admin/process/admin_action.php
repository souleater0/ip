<?php
session_start();
require_once '../../config.php';
require_once 'function.php';

    if(!empty($_POST['action']) && $_POST['action'] == 'loginProcess') {
        if(loginProcess($pdo)){
            $response = array(
                'success' => true,
                'message' => 'Login successful.',
                'redirectUrl' => '../index.php?route=dashboard'
            );
        }else{
            $response = array(
                'success' => false,
                'message' => 'Invalid Credentials!'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
    if(!empty($_POST['action']) && $_POST['action'] == 'addCategory') {
        if(AddCategory($pdo)){
            $response = array(
                'success' => true,
                'message' => 'Category has been added successfully'
            );
        }else{
            $response = array(
                'success' => false,
                'message' => 'Category already Exist!'
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
?>