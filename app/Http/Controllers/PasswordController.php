<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PasswordController extends Controller {
    private $baseUrl, $path;

    public function __construct(){
        $this->baseUrl = env('API_BASE_URL');
        $this->path = 'password/reset';
    }
    
    private function checkTokenMessage($message){
        if(str_contains($message, "password")){
            $message = str_replace("password", "contraseña", $message);
        }

        if(str_contains($message, "There was a problem with token validation")){
            $message = str_replace($message, "Este link ya es invalido", $message);
        }

        return $message;
    }

    private function setMessage($res){
        $content = $res->getBody()->getContents();
        $statusCode = $res->getStatusCode();
        $data = json_decode($content)->message;
        $color = $this->setColor($res);
        $message = "";

        if(is_array($data)){
            foreach($data as $item){
                $message .= "$item\n";
                $message = $this->checkTokenMessage($message);
            }
        } else {
            $message = $this->checkTokenMessage($data);
        }

        return [
            'message' => $message,
            'color' => $color
        ];
    }

    private function setColor($res){
        $statusCode = $res->getStatusCode();

        switch($statusCode){
            case 200:
                $color = "green";
                break;
            default:
                $color = "red";
                break;
        }

        return $color;
    }

    public function index($userType, $id, $token, $tokenId) {
        return view('password')->with([
            'userType'=> $userType,
            'id'=> $id,
            'tokenId'=> $tokenId,
            'token'=> $token
        ]);
    }

    public function reset(Request $req) {
        $password = $req->input('password');
        $passwordconfirm = $req->input('passwordconfirm');
        $userType = $req->route('userType');
        $id = $req->route('id');
        $tokenId = $req->route('tokenId');
        $token = $req->route('token');
        $url = $this->baseUrl.$this->path.'/'.$userType.'/'.$id.'/'.$tokenId;

        $res = Http::withToken($token)
        ->asForm()
        ->post($url, [
            'password'=>$password,
            'password_confirmation'=>$passwordconfirm
        ]);

        $data = $this->setMessage($res);
        return redirect()->back()->withErrors($data);
    }
}
