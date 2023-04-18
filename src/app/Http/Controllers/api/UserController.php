<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\users\CreateUserRequest;
use App\Http\Requests\users\UpdateUserRequest;

/**
 * @group User Management
 * APIs to manage the user resource.
 */
class UserController extends Controller
{
    use ResponseTrait;

     /**
     * Store User.
     *
     *
     */
  public function store(CreateUserRequest $request)
     {  
         try{            
                    $request_array= $request->validated(); 
                    $request_array['password']= bcrypt($request->password);
                    $user= User::create($request_array); 
                   
                    //create user shopcart
                    Cart::create(['user_id'=> $user->id]);
                    return $this->responseSuccess(null,'User Created Succefully'); 
            }
            catch(\Exception $e){
                    return $this->responseError(null,'', Response::HTTP_INTERNAL_SERVER_ERROR);
            }         // if there will be DB error when create 
                     //or DB down  ?? 
    }

    /**
     * Display User.
     * 
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     * @return Resource
     */
    public function show(Request $request)
    {

        $user = $request->user();
        return response($this->responseSuccess(new UserResource($user)));

    }

     /**
     * Update User.
     *
     */
    public function update(UpdateUserRequest $request)
    {
           
                    $user= auth()->user();
                    $request_array= $request->validated();
                    $user->update($request_array);
                    return $this->responseSuccess(new UserResource($user),'User Updated Succefully');
      
    }

    /**
     * Remove User.
     *
     * 
     */
    public function destroy()
    {
    
          $deleted= auth()->user()->delete();
           
           if (!$deleted) 
                return $this->responseError(null, 'Failed to delete the user.', Response::HTTP_INTERNAL_SERVER_ERROR);
            return $this->responseSuccess('User Deleted Succefully');
    
    }
    
    /**
     * Log Out
     *
     * 
     */
    public function logout(){

        $loggedOut= auth()->user()->tokens()->delete();
        if (!$loggedOut)
             return $this->responseError(null, 'Failed to log out.', Response::HTTP_INTERNAL_SERVER_ERROR);
        return $this->responseSuccess(null ,'User logged out successfuly');

    }
}
