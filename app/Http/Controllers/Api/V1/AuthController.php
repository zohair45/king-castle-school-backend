<?php namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller; use App\Models\User; use Illuminate\Http\Request; use Illuminate\Support\Facades\Hash; use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller {
 public function login(Request $r){$d=$r->validate(['email'=>'required|email','password'=>'required|string']); $u=User::where('email',$d['email'])->first(); if(!$u||!Hash::check($d['password'],$u->password)) return $this->fail('Invalid credentials',401); $token=JWTAuth::fromUser($u); return $this->ok(['access_token'=>$token,'refresh_token'=>$token,'token_type'=>'Bearer','user'=>$u->load('role'),'permissions'=>$u->role?->permissions]);}
 public function refresh(){return $this->ok(['access_token'=>JWTAuth::refresh(),'token_type'=>'Bearer'],'Token refreshed');}
 public function me(Request $r){return $this->ok($r->user()->load('role.permissions'));}
}
