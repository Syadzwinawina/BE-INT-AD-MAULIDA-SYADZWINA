<?php

// namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

// class UserController extends Controller
// {
//     public function register()
//     {
//         $data['title'] = 'Register';
//         return view('user/register', $data);
//     }

//     public function register_action(Request $request)
//     {
//         $request->validate([
//             'name' => 'required',
//             'email' => 'required|unique:tb_user',
//             'password' => 'required',
//             'alamat' => 'required',

//         ]);

//         $user = new User([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'alamat' => $request->alamat,
//         ]);
//         $user->save();

//         return redirect()->route('login')->with('success', 'Registration success. Please login!');
//     }


//     public function login()
//     {
//         $data['title'] = 'Login';
//         return view('user/login', $data);
//     }

//     public function login_action(Request $request)
//     {
//         $request->validate([
//             'email' => 'required',
//             'password' => 'required',
//         ]);
//         if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
//             $request->session()->regenerate();
//             return redirect()->intended('/');
//         }

//         return back()->withErrors([
//             'password' => 'Wrong email or password',
//         ]);
//     }

//     public function password()
//     {
//         $data['title'] = 'Change Password';
//         return view('user/password', $data);
//     }

//     public function password_action(Request $request)
//     {
//         $request->validate([
//             'old_password' => 'required|current_password',
//             'new_password' => 'required|current_password',
//             'con_password' => 'required|confirmed',
//         ]);
//         $user = User::find(Auth::id());
//         $user->password = Hash::make($request->new_password);
//         $user->save();
//         $request->session()->regenerate();
//         return back()->with('success', 'Password changed!');
//     }

//     public function logout(Request $request)
//     {
//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();
//         return redirect('/');
//     }
// }

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register_action(Request $request)
{
    // Validasi
    $request->validate([
        'name' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required',
        'alamat' => 'required',
        'password_confirm' => 'required|same:password',
    ]);

    // Buat pengguna
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'alamat' => $request->alamat,
    ]);

    // Kembalikan respons JSON
    return response()->json([
        'message' => 'Registration successful',
        'user' => $user,
    ], 201);
}

public function login_action(Request $request)
{
    // Validasi
    $request->validate([
        'email' => 'required',
        'password' => 'required',
    ]);

    // Autentikasi pengguna
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        return response()->json([
            'message' => 'Login successful',
            'user' => Auth::user(),
        ], 200);
    }

    return response()->json([
        'message' => 'Wrong email or password',
    ], 401);
}

public function changePassword(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'old_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
    ]);

    $user = Auth::user();

    // Cek apakah password lama benar
    if (!Hash::check($validatedData['old_password'], $user->password)) {
        return response()->json(['message' => 'Password lama salah'], 400);
    }

    // Update password pengguna
    $user->password = Hash::make($validatedData['new_password']);
    $user->save();

    return response()->json(['message' => 'Password berhasil diubah'], 200);
}

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }

}
