<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Jobs\SendMail;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'name' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $formattedErrors = [];
            foreach ($errors as $field => $message) {
                $formattedErrors[$field] = $message[0];
            }

            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $formattedErrors
            ], 422);
        }

        $user = User::create([
            'name' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user'
        ]);
        $token = $user->createToken('Personal Access Token')->accessToken;
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'token' => $token
        ];



        return response()->json([
            'success' => true,
            'message' => 'User registered successfully',
            'data' => $data
        ], 201);
    }

    // -------------* For Login   *----------------------------------------------
    // public function login(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors()->toArray();
    //         $formattedErrors = [];
    //         foreach ($errors as $field => $message) {
    //             $formattedErrors[$field] = $message[0];
    //         }

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Validation errors',
    //             'errors' => $formattedErrors
    //         ], 422);
    //     }


    //     if (!Auth::attempt($request->only('email', 'password'))) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Your email and password is wrong',
    //         ], 401);
    //     }

    //     $user = $request->user();
    //     $token = $user->createToken('Personal Access Token')->accessToken;
    //     $data = [
    //         'id' => $user->id,
    //         'name' => $user->name,
    //         'email' => $user->email,
    //         'token' => $token
    //     ];

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Login successful',
    //         'data' => $data
    //     ]);
    // }
    // for username and email login
    public function login(Request $request)
    {

        // dd("hit");
        $validator = Validator::make($request->all(), [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $formattedErrors = [];
            foreach ($errors as $field => $message) {
                $formattedErrors[$field] = $message[0];
            }

            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $formattedErrors
            ], 422);
        }

        // Retrieve the username and password from the request
        $username = $request->input('username');
        $password = $request->input('password');

        // Determine if the username is an email or phone number
        $field = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Attempt authentication with the appropriate field
        if (!Auth::attempt([$field => $username, 'password' => $password])) {
            return response()->json([
                'success' => false,
                'message' => 'Your email or phone  and  password is wrong',
            ], 401);
        }

        // If authentication is successful
        $user = $request->user();
        $token = $user->createToken('Personal Access Token')->accessToken;
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'phone' => $user->phone,
            'token' => $token
        ];

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'data' => $data
        ]);
    }

    // -------------*  For Email Send For Reset Password *------------------------
    public function sendResetLinkEmail(Request $request)
    {
        // Validate the email field
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role = "admin") {
            return response()->json(['success' => false, 'msg' => 'Email not found'], 404);
        }

        // Retrieve the username
        $username = $user->name;

        // dd($username);

        // Generate the password reset token

        $code = mt_rand(100000, 999999);



        // Prepare email details
        // $details = [
        //     'email' => $request->email,
        //     'name' => $username, // Fetch the user's name from the database if needed
        //     'reset_code' => $code,
        // ];
        // dd($details);

        // Send the email
        // Mail::to($details['email'])->send(new PasswordResetMail($details));
        $dispatchData = [
            'mail_to' => $request->email,
            'subject' => "Password reset",
            'message' => $code,
        ];

        SendMail::dispatch($dispatchData);
        $user->code = $code;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Otp Sent successfully',
            'data' => [
                'otp_code' => $code,
            ],
        ], 200);
    }

    // -------------* For Reset Password *-------------------------------------------------------
    public function otpValidation(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'otp_code' => 'required|integer',
        //     'email' => 'required|email',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // Check if the OTP matches the one sent to the user (you need to implement this logic)
        // Example: Fetch the user by email and compare stored OTP with the one provided
        $user = User::where('email', $request->email)->first();

        if (!$user || $user->role == 'admin') {
            return response()->json(['success' => false, 'msg' => 'User not found'], 404);
        }
        // Replace 'otp_code' with your actual column name where you store the OTP in the users table
        if ($user->code !== $request->otp_code) {
            return response()->json(['success' => false, 'msg' => 'Wrong  OTP'], 400);
        }

        // Reset the user's password
        $user->password = Hash::make($request->password);
        $user->code = null; // Clear the OTP after successful reset
        $user->save();

        return response()->json(['success' => true, 'msg' => 'Correct OTP']);
    }
    public function resetPassword(Request $request)
    {
        // dd('hit');
        // Validate the request
        $request->validate([
            'password' => 'required|string', // Ensure password
        ]);


        // Find the user by email
        $user = User::where('email', $request->email)->first();
        // dd($user->password, $request->password);

        if (!$user || $user->role == 'admin') {
            return response()->json(['success' => false, 'msg' => 'User not found'], 404);
        }

        // Reset the user's password
        $user->password = Hash::make($request->password);
        // Clear the OTP after successful reset
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password Reset Successfully',

        ], 200);
    }

    // -------------* For Change Password *----------------------------------------------------
    public function changePassword(Request $request)
    {
        // Get the authenticated user
        // $user = auth()->user();
        $user = User::find($request->user_id);
        $validatedData = $request->all();
        if (!$user || $user->role == "admin") {
            return response()->json(['success' => false, 'msg' => 'Something Was Wrong']);
        } else {



            // Validate the incoming request data
            // $validatedData = $request->validate([
            //     'old_password' => 'required|string',
            //     'new_password' => 'required|string|min:8|confirmed', // The confirmed rule ensures new_password_confirmation is also provided and matches new_password
            // ]);

            // Check if the provided current password matches the user's password
            if (!Hash::check($validatedData['old_password'], $user->password)) {
                return response()->json(['success' => false, 'msg' => 'Old password is incorrect'], 400);
            }

            // Update the user's password
            $user->password = Hash::make($validatedData['new_password']);
            $user->save();

            // Return a success response
            return response()->json(['success' => true, 'msg' => 'Password changed successfully']);
        }
    }
    public function mail()
    {
        $jobs = DB::table('jobs')->get();
        $failedJobs = DB::table('failed_jobs')->get();

        return view('welcome', compact('jobs', 'failedJobs'));
    }


    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = Auth::guard('api')->user();

        if ($user) {
            // Simply respond with a success message
            return response()->json([
                'message' => 'Logout successfully',
                'status' => true,
            ], 200);
        }

        return response()->json([
            'message' => 'User not authenticated',
            'status' => false,
        ], 401);
    }
}
