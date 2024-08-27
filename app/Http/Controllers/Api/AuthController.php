<?php

namespace App\Http\Controllers\Api;
use Auth;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;

class AuthController extends Controller
{
    use ApiResponses;   
    public function login(LoginUserRequest $requset)

    {
        $requset->validated($requset->all());
        //if the data is valid then authintication begins -> taking the reponse from the trait response
        if(!Auth::attempt($requset->only('email', 'password')))
        {
            return $this->error('Invalid credintianls', 401);
        }   
        $user = User::firstWhere('email', $requset->email);
        return $this->ok( 
            'Authenticated',
            [
                //token itself is a hashed value that why we use plainTextToken
                'token'=>$user->createToken('API token for' . $user->email,['*'],now()->addDay())->plainTextToken
            ] 
        );
         
    }
    public function logout(Request $request)
    {
        //3 ways:
        //not a good way because it will delete all of the users token that might have no expiration time
         //$request->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();
        return $this->ok('');
    }
}
