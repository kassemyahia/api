<?php
// app/Http/Controllers/Api/Auth/RegisterController.php
namespace App\Http\Controllers\Api\Auth;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
public function __invoke(Request $request)
{
try {
$request->validate([
'name' => ['required', 'string', 'max:255'],
'username' => ['required', 'string', 'max:255', 'unique:users'],
'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
'password' => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()],
    'gender' => ['required' , 'in:male,female'],
    'birth_date' => ['required' ,'date'],
]);
} catch (ValidationException $e) {
return response()->json([
'message' => 'Validation Error',
'errors' => $e->errors(),
], 422);
}

$user = User::create([
'name' => $request->name,
'username'=>$request->username,
'email' => $request->email,
'password' => Hash::make($request->password),
    'gender'=>$request->gender,
    'birth_date'=>$request->birth_date,

]);

$token = $user->createToken('auth_token')->plainTextToken;

return response()->json([
'message' => 'User registered successfully',
'user' => $user,
'access_token' => $token,
'token_type' => 'Bearer',
], 201);
}
}
