<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Mail\VerifyMail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Mail;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'unique:users,email|required|email',
            'password' => 'required|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('registration_form_validation', '1');
        }

        $user = new User();

        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        $token = str_random(40);

        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->token = $token;
        $user->role = 'user';
        $user -> save();

        Mail::to($user->email)->send(new VerifyMail($user));

        return redirect('/')->with('check_your_email_for_confirmation_message', 'A confirmation link has been sent to your email address. please check your email for verification !');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('login_form_validation', '1');
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->where('role', 'user')->first();

        if(isset($user))
        {
            if($user->verified === 1)
            {
                if( Auth::attempt( [ 'email' => $email, 'password' => $password ] ) )
                {
                    die('alive');
                }
                else
                {
                    return redirect()
                        ->back()
                        ->with('invalid_email_or_password', '1')
                        ->with('login_form_validation', '1');
                }
            }
            else
            {
                return redirect()
                    ->back()
                    ->with('user_not_verified_message', '1')
                    ->with('login_form_validation', '1');
            }
        }
        else
        {
            return redirect()
                ->back()
                ->with('invalid_email_or_password', '1')
                ->with('login_form_validation', '1');
        }
    }

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput()
                ->with('lost_form_validation', '1');
        }

        $user = User::where('email', $request->input('email'))->first();

        if( isset($user) )
        {
            $token = str_random(40);
            $user->token = $token;

            Mail::to($user->email)->send(new ResetPassword($user));

            return redirect('/')->with('check_your_email_for_reset_password_message', 'A link has been sent to your email address. please check your email to reset your password !');
        }
        else
        {
            return redirect()
                ->back()
                ->with('lost_form_validation', '1')
                ->with('invalid_email', '1');
        }
    }

    public function checkIfEmailAlreadyExist(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'unique:users,email'
        ]);

        if ($validator->fails())
        {
            die('false');
        }
        else
        {
            die('true');
        }
    }

    public function verifyUser($token)
    {
        $user = User::where('token', $token)->first();
        if(isset($user) )
        {
            if($user->verified === 0) {
                $user->verified = 1;
                $user->save();
                return redirect('/')->with('email_verification_message', "Your e-mail is verified. You can now login.");
            }
            else
            {
                return redirect('/')->with('email_verification_message', "Your e-mail is already verified. You can now login.");
            }
        }
        else
        {
            return redirect('/')->with('email_verification_message', "error");
        }
    }
}
