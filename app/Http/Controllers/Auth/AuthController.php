<?php

namespace App\Http\Controllers\Auth;

use App\Domain\Users\Auth\Actions\StoreUserAction;
use App\Domain\Users\Auth\DTO\StoreUserDTO;
use App\Domain\Users\Auth\Requests\StoreUserRequest;
use App\Domain\Users\Auth\Resources\ProfileResource;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('token-name', [$user->login])->plainTextToken;
            return $this->successResponse([
                'token' => $token,
            ], new ProfileResource($user));
        }
        return $this->errorResponse('Login or password error', 404);
    }

    /**
     * @param StoreUserRequest $request
     * @param StoreUserAction $action
     * @return JsonResponse
     */
    public function store(StoreUserRequest $request, StoreUserAction $action)
    {
        try {
            $request->validated();

        } catch (ValidationException $validationException) {
            return $this->errorResponse($validationException->getMessage());
        }
        try {
            $dto = StoreUserDTO::fromArray($request->validated());
            $response = $action->execute($dto);

            return $this->successResponse('User has successfully registered', $response);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
