<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
/*comprobar likes*/
public function comprobarlikePost($request){
$likes = Like::where (["post_id" => $request["post_id"]])->get();
return response()->json([$likes],201);
}

public function comprobarlikeComment($request){
$likes = Like::where (["comment_id" => $request["comment_id"]])->get(); 
return response()->json([$likes],201);
}

/*.Crear(Create).*/
public function createPostLike(Request $request){
    $data =$request->json()->all();
    if(Like::comprobarlikePost($data) != null){
        return response()->json("Imposible poner otro like", 201);            
    }
    else{
    try{
        $like= Like::create([
        "user_id" => $data["user_id"],
         "post_id" => $data["post_id"]
        ]);
        return response()->json($like, 201);
        }
        catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e -> errorInfo, "codigo" => 500);
            return response()->json($respuesta, 201);
        }    
    }
}
/*crear like en comentario*/
public function createCommentLike(Request $request){
    $data =$request->json()->all();
    if(Like::comprobarlikeComment($data) != null){
        return response()->json("Imposible poner otro like", 201);            
    }
    else{
        try{
            $like= Like::create([
                "user_id" => $data["user_id"],
                "comment_id" => $data["comment_id"]
            ]);
            return response()->json($like, 201);
        }
        catch(\Illuminate\Database\QueryException $e){
            $respuesta = array("error" => $e -> errorInfo, "codigo" => 500);
            return response()->json($respuesta, 201);
        }    
    }
}

/*.Leer(Read).*/
/*Ver likes en post*/
public function getPostsLike(){
    $likes = Like::where(["post_id"=>$id]);
    return response()->json([$likes], 200);
}

public function getPostbyLikeID($id){
    $like = Like::find($id);
    return response()->json($like, 200);
}

public function getPostbyUserIDLike($id){
    $like = Like::where(["user_id" => $id])->get();
    return response()->json($like, 200);
}

public function contarLikesPosts($id){
    $likes = Like::where(["post_id"=>$id])->count();
    return response()->json(["Numero de likes ".$likes], 200);
}

/*GETCOMMENTLIKES*/
public function getCommentsLike(){
    $likes = Like::where(["comment_id"=>$id]);
    return response()->json([$likes], 200);
}

public function getCommentbyLikeID($id){
    $like = Like::find($id);
    return response()->json($like, 200);
}

public function getCommentbyUserIDLike($id){
    $like = Like::where(["user_id" => $id])->get();
    return response()->json($like, 200);
}

public function contarLikesComments($id){
    $likes = Like::where(["comment_id"=>$id])->count();
    return response()->json(["Numero de likes ".$likes], 200);
}

/*.Eliminar(Delete).*/
public function deletePostLike($id){
    $like = Like::find($id);
    $like->delete();
    return response()->json(["deleted"], 204);
}

public function deleteCommentLike($id){
    $like = Like::find($id);
    $like->delete();
    return response()->json(["deleted"], 204);
}
}
