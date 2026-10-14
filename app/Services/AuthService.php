<?php

namespace App\Services;
use Laravel\Sanctum\PersonalAccessToken;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function signup(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
    }
    public function login(array $credentials): array
    {
        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [
                    'The provided credentials are incorrect.',
                ],
            ]);
        }

        $user = User::where(
            'email',
            $credentials['email']
        )->firstOrFail();

        return [
            'user' => $user,
            'token' => $user->createToken('API Token')->plainTextToken,
            'token_type' => 'Bearer',
        ];
    }

    
public function logout(User $user): void
{
    $token = $user->currentAccessToken();

    if ($token instanceof PersonalAccessToken) {
        $token->delete();
    }
}
}
