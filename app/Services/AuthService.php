<?php

namespace App\Services;

use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

use App\Models\User;
use App\Models\Role;
use App\Models\Person;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;

class AuthService
{
    const USERTOKEN = 'userToken';
    /**
     * Creates account for a user
     *
     * @param $request Form request for registration
     *
     * @return array
     */
    public static function create(RegistrationRequest $request)
    {
        DB::beginTransaction();
        try {
            $params = $request->validated();
    
            $role = Role::where('id', $params['role'])->first();
    
            if (is_null($role)) {
                return [
                    'success' => false,
                    'status' => 400
                ];
            }

            $person = Person::create([
                'firstname' => $params['firstname'],
                'middlename' => $params['middlename'],
                'lastname' => $params['lastname'],
                'suffix' => $params['suffix'],
                'birthdate' => $params['birthdate']
            ]);

            $user = User::create([
                'person_id' => $person->id,
                'role_id' => $role->id,
                'username' => $params['username'],
                'email' => $params['email'],
                'password' => Hash::make($params['password']),
                'phone' => $params['phone']
            ]);

            DB::commit();
            return [
                'success' => true,
                'data' => $user->load(['person','role']),
                'status' => 200
            ];
        } catch (\Exception $e) {
            \Log::error(get_class().' create() :'.$e);
            DB::rollback();
            return [
                'success' => false,
                'status' => $e->getStatusCode()
            ];
        }        
    }

    /**
     * Updates account for a user
     *
     * @param $user current user record pass
     * @param $request Form request for updating records
     *
     * @return array
     */
    public static function update(User $user, RegistrationRequest $request)
    {
        $params = $request->validated();
        $userId = $user->id;

        DB::beginTransaction();
        try {
            $person = Person::where('id', $user->person_id)->first();

            if (is_null($person)) {
                return [
                    'success' => false,
                    'status' => 400
                ];
            }

            $person->update([
                'firstname' => $params['firstname'],
                'middlename' => $params['middlename'],
                'lastname' => $params['lastname'],
                'suffix' => $params['suffix'],
                'birthdate' => $params['birthdate']
            ]);

            $user->update([
                'role_id' => $params['role'],
                'username' => $params['email'],
                'email' => $params['email'],
                'password' => Hash::make($params['password']),
                'phone' => $params['phone'],
            ]);

            $updatedUser = User::where('id', $userId)->first();

            DB::commit();
            return [
                'success' => true,
                'data' => $updatedUser->load(['person','role']),
                'status' => 200
            ];
        } catch (\Exception $e) {
            \Log::error(get_class(). ' update: '.$e);
            DB::rollback();
            return [
                'success' => false,
                'status' => $e->getStatusCode()
            ];
        }
    }

    /**
     * Deletes account for a user
     *
     * @param $request Form request for registration
     *
     * @return array
     */
    public static function delete(User $user) 
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            return [
                'success' => true,
                'data' => null,
                'status' => 400
            ];
        } catch (\Exception $e) {
            \Log::error(get_class().' '.$e);
            DB::rollback();
            return [
                'success' => false,
                'data' => null,
                'status' => $e->getStatusCode()
            ];
        }
    }

    /**
     * Fires login functionality
     *
     * @param $request Form request for Login
     *
     * @return array
     */
    public static function login(LoginRequest $request) 
    {
        $validLoginRequest = self::validateLoginRequest($request);

        if ($validLoginRequest['success']) {
            return [
                'success' => true,
                'data' => $validLoginRequest['user'],
                'status' => 200
            ];
        }

        return [
            'success' => false,
            'data' => null,
            'status' => 400
        ];
    }

    /**
     * Validates the current login request
     *
     * @param $request Form request for Login
     *
     * @return array
     */
    private static function validateLoginRequest(LoginRequest $request)
    {
        $params = $request->validated();

        $user = User::where('email', $params['email'])->first();
        $data = $user->load(['person', 'role']);
        $data->token = $user->createToken(self::USERTOKEN);

        if(!is_null($user)) {
            if (Hash::check($params['password'], $user->password)) {
                return [
                    'success' => true,
                    'user' => $data
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Password do not match'
                ];
            }
        }

        return [
            'success' => false,
            'message' => 'Invalid Credentials'
        ];
    }

    /**
     * Reauthenticate user with existing token
     *
     * @param $request Form request for Login
     *
     * @return array
     */
    public static function loginWithToken() 
    {
        return [
            'success' => Auth::check(),
            'data' => Auth::user()->load(['person', 'role']),
            'status' => Auth::check() ? 200 : 400,
        ];
    }
    
    /**
     * Deauthenticate current login user
     *
     * @param $request Form request for Login
     *
     * @return array
     */
    public static function logout(Request $request) 
    {
        $request->user()->currentAccessToken()->delete();
        
        return [
            'success' => true,
            'data' => null,
            'status' => 200,
        ];
    }
}