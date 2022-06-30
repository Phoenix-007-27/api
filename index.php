<?php
header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: *');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: *');

require_once 'connect.php';
require_once 'func.php';

$q = $_GET['q'];
$params = explode('/', $q);

$method = $_SERVER['REQUEST_METHOD'];
$data = $_POST;

if (count($params) == 1) {
    $type = $params[0];
} else {
    $type = $params[0];
    $id = $params[1];
}
if ($method == 'GET' && $type === 'posts') {
    if (isset($id)) {
        getPost($connect, $id);
    } else {
        getPosts($connect);
    }
} elseif ($method == 'POST' && $type === 'posts') {
    addPost($connect, $data);
} elseif ($method == 'PATCH' && $type === 'posts') {

    $data = file_get_contents('php://input');
    $data = json_decode($data, true);
    if (isset($id)) {
        updatePost($connect, $id, $data);
    }
} elseif ($method == 'DELETE' && $type === 'posts') {
    if (isset($id)) {
        deletePost($connect, $id);
    }
}

// die('111');