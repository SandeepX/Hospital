<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::ADMIN;

    private UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->middleware('guest')->except('logout');
        $this->userRepo = $userRepo;
    }

    public function login(Request $request)
    {
        try {
            $this->validateLogin($request);

            $this->checkCredential($request);

            if ($this->hasTooManyLoginAttempts($request)) {
                $this->fireLockoutEvent($request);
                $this->sendLockoutResponse($request);
            }
            if ($this->attemptLogin($request)) {
                return $this->sendLoginResponse($request);
            }

            $this->incrementLoginAttempts($request);

            return $this->sendFailedLoginResponse($request);
        } catch (Exception $e) {
            return redirect()->back()->with('danger', $e->getMessage())->withInput();
        }
    }

    public function checkCredential($request)
    {
        $user = '';
        $select = ['id', 'name', 'email', 'username', 'password'];

        $userWithUserEmail = $this->userRepo->getUserByUserEmail($request->get('email'), $select);
        if ($userWithUserEmail) {
            $user = $userWithUserEmail;
            $request['login_type'] = 'email';
        }

        $userWithUserName = $this->userRepo->getUserByUserName($request->get('email'), $select);
        if ($userWithUserName) {
            $user = $userWithUserName;
            $request['login_type'] = 'username';
            $request['username'] = $request->get('email');
        }

        if (!$user) {
           throw new Exception( "Username do not match our records.",401);
        }

        if (!Hash::check($request->get('password'), $user->password)) {
            throw new Exception( "These credentials do not match our records.",401);
        }

    }

    protected function credentials(Request $request)
    {
        return $request->only($request->login_type, 'password');
    }

}
