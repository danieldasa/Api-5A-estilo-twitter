<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/*Usuario(User)*/
$router->post('/CrearUsuario', ["uses" => "UserController@createUser"]);

$router->group(['middleware' => ['auth']], function() use ($router){

    $router->get('/MostrarUsuarios', ["uses" => "UserController@getUsers"]);

    $router->get('/MostrarUsuario/{id}', ["uses" => "UserController@getUser"]);

    $router->delete('BorrarUsuario/{id}', ["uses" => "UserController@deleteUser"]);

    $router->put('ActualizarUsuario/{id}', ["uses" => "UserController@updateUser"]);
});

$router->post('/Login', ["uses" => "UserController@Login"]);

$router->post('/sql', ["uses" => "UserController@callateee"]);

/*Sol(Post)*/
$router->post('/post', ["uses" => "PostController@createPost"]);

$router->post('/postfile', ["uses" => "PostController@uploadFile"]);

$router->get('/Showposts', ["uses" => "PostController@getPosts"]);

$router->get('/post/{id}', ["uses" => "PostController@getPostsbyID"]);

$router->get('/postid/{UserId}', ["uses" => "PostController@getPostbyUserID"]);

$router->put('/post/{id}', ["uses" => "PostController@updatePost"]);

$router->delete('/post/{id}', ["uses" => "PostController@deletePost"]);

/*COMMENT*/
$router->post('/CreateComment', ["uses" => "CommentController@createComment"]);

$router->post('/commentfile', ["uses" => "CommentController@uploadComment"]);

$router->get('/comment', ["uses" => "CommentController@getComments"]);

$router->get('/comment/{id}', ["uses" => "CommentController@getCommentbyID"]);

$router->get('/commentid/{UserId}', ["uses" => "CommentController@getCommentbyUserID"]);

$router->put('/comment/{id}', ["uses" => "CommentController@updateComment"]);

$router->delete('/comment/{id}', ["uses" => "CommentController@deleteComment"]);

/*LIKE*/
/*Like a un post(Post like)*/
    $router->post('/likePost', ["uses" => "LikeController@createPostLike"]);

    $router->get('/likePosts', ["uses" => "LikeController@getPostsLike"]);

    $router->get('/likePost/{id}', ["uses" => "LikeController@getPostbyLikeID"]);

    $router->get('/likePostid/{UserId}', ["uses" => "LikeController@getPostbyUserIDLike"]);

    $router->delete('/likePost/{id}', ["uses" => "LikeController@deletePostLike"]);

/*Like a un comentario(comment Like)*/
    $router->post('/likeComment', ["uses" => "LikeController@createCommentLike"]);

    $router->get('/likeComment', ["uses" => "LikeController@getCommentsLike"]);

    $router->get('/likeComment/{id}', ["uses" => "LikeController@getCommentbyLikeID"]);

    $router->get('/likeCommentid/{UserId}', ["uses" => "LikeController@getCommentbyUserIDLike"]);

    $router->delete('/likeComment/{id}', ["uses" => "LikeController@deleteCommentLike"]);

    $router->get('/ContarlikeComment', ["uses" => "LikeController@contarLikesComment"]);