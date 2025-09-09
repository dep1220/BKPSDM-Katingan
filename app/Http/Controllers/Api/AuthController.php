<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

    class AuthController extends Controller
    {
        /**
         * @OA\Post(
         * path="/api/login",
         * operationId="authLogin",
         * tags={"Autentikasi"},
         * summary="Login pengguna untuk mendapatkan API token",
         * @OA\RequestBody(
         * required=true,
         * @OA\JsonContent(
         * required={"email","password"},
         * @OA\Property(property="email", type="string", format="email", example="superadmin@example.com"),
         * @OA\Property(property="password", type="string", format="password", example="password")
         * )
         * ),
         * @OA\Response(
         * response=200,
         * description="Login berhasil",
         * @OA\JsonContent(
         * @OA\Property(property="token", type="string", example="1|aBcDeFgHiJkLmNoPqRsTuVwXyZ")
         * )
         * ),
         * @OA\Response(response=401, description="Unauthorized")
         * )
         */
        public function login(Request $request)
        {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['token' => $token]);
        }

        /**
         * @OA\Post(
         * path="/api/logout",
         * operationId="authLogout",
         * tags={"Autentikasi"},
         * summary="Logout pengguna dan menghapus token",
         * security={ {"bearerAuth": {}} },
         * @OA\Response(response=200, description="Logout berhasil"),
         * @OA\Response(response=401, description="Unauthenticated")
         * )
         */
        public function logout(Request $request)
        {
            if ($request->user()) {
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Logout berhasil']);
        }

            // Jika tidak ada user, kirim error yang benar
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        /**
         * @OA\Get(
         * path="/api/user",
         * operationId="authGetUser",
         * tags={"Autentikasi"},
         * summary="Mendapatkan data pengguna yang sedang login",
         * security={ {"bearerAuth": {} }},
         * @OA\Response(response=200, description="Operasi berhasil", @OA\JsonContent(ref="#/components/schemas/User")),
         * @OA\Response(response=401, description="Unauthenticated")
         * )
         */
        public function userProfile(Request $request)
        {
            return response()->json($request->user());
        }

        /**
         * @OA\Get(
         * path="/api/profile",
         * operationId="getProfile",
         * tags={"Autentikasi"},
         * summary="Mendapatkan data profil pengguna yang sedang login",
         * security={ {"bearerAuth": {} }},
         * @OA\Response(
         * response=200,
         * description="Operasi berhasil",
         * @OA\JsonContent(ref="#/components/schemas/User")
         * ),
         * @OA\Response(response=401, description="Unauthenticated")
         * )
         */
        public function getProfile(Request $request)
        {
            return response()->json($request->user());
        }

        /**
         * @OA\Put(
         * path="/api/profile",
         * operationId="updateProfile",
         * tags={"Autentikasi"},
         * summary="Memperbarui nama dan email pengguna",
         * security={ {"bearerAuth": {} }},
         * @OA\RequestBody(
         * required=true,
         * @OA\JsonContent(
         * required={"name", "email"},
         * @OA\Property(property="name", type="string", example="Nama Baru Pengguna"),
         * @OA\Property(property="email", type="string", format="email", example="emailbaru@example.com")
         * )
         * ),
         * @OA\Response(
         * response=200,
         * description="Profil berhasil diperbarui",
         * @OA\JsonContent(ref="#/components/schemas/User")
         * ),
         * @OA\Response(response=422, description="Validation Error")
         * )
         */
        public function updateProfile(ProfileUpdateRequest $request)
        {
            $user = $request->user();
            $user->fill($request->validated());

            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
            }

            $user->save();

            return response()->json($user);
        }

        /**
         * @OA\Put(
         * path="/api/profile/password",
         * operationId="updatePassword",
         * tags={"Autentikasi"},
         * summary="Memperbarui password pengguna",
         * security={ {"bearerAuth": {} }},
         * @OA\RequestBody(
         * required=true,
         * @OA\JsonContent(
         * required={"current_password", "password", "password_confirmation"},
         * @OA\Property(property="current_password", type="string", format="password"),
         * @OA\Property(property="password", type="string", format="password"),
         * @OA\Property(property="password_confirmation", type="string", format="password")
         * )
         * ),
         * @OA\Response(response=200, description="Password berhasil diperbarui"),
         * @OA\Response(response=422, description="Validation Error / Password lama salah")
         * )
         */
        public function updatePassword(Request $request)
        {
            $validated = $request->validate([
                'current_password' => ['required', 'current_password'],
                'password' => ['required', Password::defaults(), 'confirmed'],
            ]);

            $request->user()->update([
                'password' => Hash::make($validated['password']),
            ]);

            return response()->json(['message' => 'Password berhasil diperbarui.']);
        }
}
    