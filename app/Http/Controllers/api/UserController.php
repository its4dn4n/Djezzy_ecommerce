<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Http\Response;
use App\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

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
  public function store(CreateUserRequest $request_validated)
     {  
         try{            
                    $request_array= $request_validated->validated(); 
                    $request_array['password']= bcrypt($request_validated->password); 
                   // if there will be DB error when create 
                   //or DB down
                    User::create([$request_array]); 
                    return $this->responseSuccess(null,'User Created Succefully'); 
            }
            catch(\Exception $e){
                    return $this->responseError(null,'', Response::HTTP_INTERNAL_SERVER_ERROR);
            }  
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
    public function update(UpdateUserRequest $request_validated)
    {
            try{ 
                   
                    $user= auth()->user();
                    $request_array= $request_validated->validated();
                    DB::beginTransaction();
                    // *1* check if there is the attribute *2* check if the value is not null *3* check if there is a changement in the value **
                    if ($request_validated->has('name') && !empty($request_array['name']) && $user->name != $request_array['name']) $user->update(['name'=> $request_array['name']]);
                    if ($request_validated->has('email') && $request_array['email'] && $user->email != $request_array['email']) $user->update(['email'=> $request_array['email']]);
                    if ($request_validated->has('password') && $request_array['password'] && $user->password != bcrypt($request_array['password'])) $user->update(['password'=> bcrypt($request_array['password'])]);
                    DB::commit();
                    return $this->responseSuccess(new UserResource($user),'User Updated Succefully');
            }
            catch(\Exception $e){
                    DB::rollback();
                    return $this->responseError(null, '', Response::HTTP_INTERNAL_SERVER_ERROR);
            }
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
