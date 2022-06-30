<?php
///////////////////////////////////////////////////////////
function getPosts($connect)
{
    $result = mysqli_query($connect, "SELECT * FROM users");
    $postsList = [];
    while ($posts = mysqli_fetch_assoc($result)) {
        $postsList[] = $posts;
    }
    echo json_encode($postsList);
}
/////////////////////////////////////////////////////////////
function getPost($connect, $id)
{
    $result = mysqli_query($connect, "SELECT * FROM users WHERE id=$id");
    if(mysqli_num_rows($result) === 0){

        http_response_code(404);
        echo 'wrong';

    }else
    {
        echo json_encode($posts = mysqli_fetch_assoc($result));
    }
}
///////////////////////////////////////////////////////////////
function addPost($connect, $data)
{
    $name = $data['name'];
    $pass = $data['pass'];

    mysqli_query($connect, "INSERT INTO `users` (`id`, `name`, `password`) VALUES (NULL, '$name', '$pass')");
    $res = 
    [
        'status' => true,
        'post_id' => mysqli_insert_id($connect)

    ];
    echo json_encode($res);
    http_response_code(201);
}
////////////////////////////////////////////////////////////////////
function updatePost($connect, $id, $data)
{
    $name = $data['name'];
    $pass = $data['password'];

    mysqli_query($connect, "UPDATE `users` SET `name`='$name', `password`='$pass' WHERE `id`='$id'");

    $res = 
    [
        'status' => true,
        'message' => 'post is updated'

    ];
    echo json_encode($res);
    http_response_code(200);

   }
/////////////////////////////////////////////////////////////////////////
   function deletePost($connect, $id)
   {
    mysqli_query($connect, "DELETE FROM `users` WHERE `ID`='$id'"); 
    $res = 
    [
        'status' => true,
        'message' => 'post is deleted'
        
    ];
    echo json_encode($res);
    http_response_code(200);
}