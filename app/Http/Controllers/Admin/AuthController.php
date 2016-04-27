<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends ApiController
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The registrar implementation.
     *
     * @var Registrar
     */
    protected $registrar;

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
        //$this->middleware('guest', ['except' => 'getLogout']);
    }


    public function index()
    {
        $user = \Auth::user();
        if ($user) {
            return view('admin');
        }

        return view('admin.auth.login');
    }

    public function getLogin()
    {
        if (view()->exists('auth.authenticate')) {
            return $this->redirectPath('admin');
            //return view('auth.authenticate');
        }

        return view('admin.auth.login');
    }

    public function postLogin(Request $request)
    {

        $data = Input::all();
        $rules = array(
            'account' => 'required',
            'password' => 'required'
        );
        parent::validator($data, $rules);
        $credentials_mobile = ['mobile' => $data['account'], 'password' => $data['password']];
        $credentials_name = ['username' => $data['account'], 'password' => $data['password']];
        $credentials_email = ['email' => $data['account'], 'password' => $data['password']];
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($this->auth->attempt($credentials_mobile)) {
            //return $this->handleUserWasAuthenticated($request, $throttles);
        } elseif ($this->auth->attempt($credentials_name)) {
           // return $this->handleUserWasAuthenticated($request, $throttles);
        } elseif ($this->auth->attempt($credentials_email)) {
            //return $this->handleUserWasAuthenticated($request, $throttles);
        }

        $user = \Auth::user();
        if ($user) {
            return $this->handleUserWasAuthenticated($request, $throttles);
            if (!$user->hasRole(['administrator','super_administrator']) ){
                return $this->handleUserWasAuthenticated($request, $throttles);
            }else{
                return $this->redirectPath('admin');
            }
        }

        if ($throttles) {
            $this->incrementLoginAttempts($request);
        }

        return redirect($this->loginPath())
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);

    }



}
