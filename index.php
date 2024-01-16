<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function requireController($controller, $method = 'POST') {
    if ($_SERVER['REQUEST_METHOD'] == $method) {
        require "module/controller/{$controller}.php";
    } else {
        require 'module/view/404.php';
    }
}

switch ($request) {
    case '/':
        require 'module/view/home.php';
        break;

    case '/signup':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require 'module/controller/signupController.php';
        } else {
            require 'module/view/signup.php';
        }
        break;

        case '/login':
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              require 'module/controller/loginController.php';
          } else {
              require 'module/view/login.php';
          }
          break; case '/logout':
           
                require 'module/view/logout.php';
              
            break;

    case '/edit-account':
      
        require 'module/view/editAccount.php';
        break;

        case '/update-data':
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
          require 'module/controller/updateData.php';} else {    require 'module/view/404.php';}
          break;
          case '/delete-data':
       
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require 'module/controller/deleteData.php';} else {    require 'module/view/404.php';}
          break;
          case '/add-data':
           if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require 'module/controller/addData.php'; } else {    require 'module/view/404.php';}
          break; 

    default:
        http_response_code(404);
        require 'module/view/404.php';
        break;
}
?>
