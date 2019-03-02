<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /*EJEMPLOS*/
        public function __construct()
        {
            //
        }

        public function index2(){
            return "Holiwis desde el controlador";
        }

        public function index(){
            return response()->json('{"hola mundo" : "nose"}',200);
        }

        public function index3(){
            $user = new User();

            $user->name = "Jesus";
            $user->email = "chuny@gmail.com";
            return response()->json([$user], 200);
        }

        public function mqueso1(){
            $user = new User();

            $user->name = "manchego";
            $user->email = "manchego@chesse.com";
            return response()->json([$user], 200);
        }

    /*CREATE*/
        public function createUser(Request $request){
            $data = $request->json()->all();
            try{
                $user = User::create([
                    "name" => $data["name"],
                    "nickname" => $data["nickname"],
                    "email" => $data["email"],
                    "password" => hash::make($data["password"]),
                    "token" => str_random(60)
                ]);
        
                return response()->json($user, 201);
            }
            catch(\Illuminate\Database\QueryException $e){
                $respuesta = array("error" => $e->errorInfo, "codigo" =>500);
                return response()->json($respuesta,500);
            }
        }
    /*READER*/
        public function getUsers(){
            $user = User::all();
            return response()->json([$user], 200);
        }

        public function getUser($id){
            $user = User::find($id);
            Return response()->json($user, 200);
        }

        public function deleteUser($id){
            $user = User::find($id);
            $user->delete();
            return response()->json(["deleted"], 204);
        }
    
    /*UPDATE*/
        public function updateUser(Request $request, $id){
            $data = $request->json()->all();
            $user = User::find($id);

            $user->name = $data["name"];
            $user->nickname = $data["nickname"];
            $user->email = $data["email"];

            $user->save();

            return response()->json($user, 200);
        }
    
    /*LOGIN*/
        public function Login(Request $request){
            $data = $request->json()->all();
            $user = User::where(["nickname" => $data["nickname"]])->first();
            if($user){
                if(Hash::check($data["password"], $user->password)){
                    return response()->json($user, 200);
                }
                else{
                    $respuesta = array('error' => "el password es incorrecto",'codigo' => 404);
                    return response()->json($respuesta, 404);
                }
            }
            else{
                $respuesta = array('error' => "El usuario no existe",'codigo' => 404);
                return response()->json($respuesta, 404);
            }
        }

        public function callateee(Request $request){
            $data = $request->json()->all();

            $results = DB::select('SELECT * FROM users where nickname = :nickname', ["nickname" => $data["nickname"]]);

            return response()->json($results, 200);
        }
}
