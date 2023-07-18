<?php

namespace App\Http\Controllers\API;

use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;

class AuthController extends Controller
{
    /**
     * Creates account for a user
     *
     * @param RegistrationRequest Form request for registration
     *
     * @return JsonResponse
     */
    public function create(RegistrationRequest $request): JsonResponse
    {
        $result = AuthService::create($request);
        if ($result['success']) {
            return $this->success($result['data'], $result['status'], config('message.success'));
        }

        return $this->error($result['status'], config('message.error'));
    }

    /**
     * Updates account for a user
     *
     * @param User $user current user record pass
     * @param RegistrationRequest $request Form request for updating records
     *
     * @return JsonResponse
     */
    public function update(User $user, RegistrationRequest $request): JsonResponse
    {
        $result = AuthService::update($user, $request);
        if ($result['success']) {
            return $this->success($result['data'], $result['status'], config('message.success'));
        }

        return $this->error($result['status'], config('message.error'));
    }

    /**
     * Deletes account for a user
     *
     * @param $request Form request for registration
     *
     * @return JsonResponse
     */
    public function delete(User $user) : JsonResponse
    {
        $result = AuthService::delete($user);
        if ($result['success']) {
            return $this->success($result['data'], $result['status'], config('message.success'));
        }

        return $this->error($result['status'], config('message.error'));
    }

    /**
     * Fires login functionality
     *
     * @param $request Form request for Login
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        $result = AuthService::login($request);
        if ($result['success']) {
            return $this->success($result['data'], $result['status'], config('message.success'));
        }

        return $this->error($result['status'], $result['message']);
    }

    /**
     * Re authenticate user with existing token
     *
     * @param $request Form request for Login
     *
     * @return JsonResponse
     */
    public function loginWithToken() : JsonResponse
    {
        $result = AuthService::loginWithToken();
        if ($result['success']) {
            return $this->success($result['data'], $result['status'], config('message.success'));
        }

        return $this->error($result['status'], config('message.error'));
    }
    
    /**
     * Deauthenticate current login user
     *
     * @param $request Form request for Login
     *
     * @return JsonResponse
     */
    public function logout(Request $request) : JsonResponse
    {
        $result = AuthService::logout($request);
        if ($result['success']) {
            return $this->success($result['data'], $result['status'], config('message.success'));
        }

        return $this->error($result['status'], config('message.error'));
    }
}
