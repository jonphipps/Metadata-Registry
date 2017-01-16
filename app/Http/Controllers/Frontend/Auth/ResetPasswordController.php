<?php

namespace App\Http\Controllers\Frontend\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Repositories\Frontend\Access\User\UserRepository;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\Frontend\Auth
 */
class ResetPasswordController extends Controller
{
    use ResetsPasswords;

	/**
	 * @var UserRepository
	 */
	protected $user;

  protected $redirectTo = '/dashboard';

    /**
     * ChangePasswordController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
    	$this->user = $user;
    }

	/**
	 * Where to redirect users after resetting password
	 *
	 * @return string
	 */
	public function redirectPath() {
		return route('frontend.user.dashboard');
	}


  /**
   * Display the password reset view for the given token.
   * If no token is present, display the link request form.
   *
   * @param  string|null $token
   *
   * @return \Illuminate\Http\Response
   */
  public function showResetForm($token = null)
  {
    $email = $this->user->getEmailForPasswordToken($token)['email'];
    $name  = $this->user->getEmailForPasswordToken($token)['name'];

    return view('frontend.auth.passwords.reset')
        ->withToken($token)
        ->withEmail($email)
        ->withName($name);
  }



  /**
   * Get the password reset validation rules.
   *
   * @return array
   */
  protected function rules()
  {
    return [
        'token'    => 'required',
        'name' => 'required',
        'password' => 'required|confirmed|min:6',
    ];
  }


   /**
   * Get the password reset credentials from the request.
   *
   * @param  \Illuminate\Http\Request $request
   *
   * @return array
   */
  protected function credentials(Request $request)
  {
    return $request->only('name',
        'password',
        'password_confirmation',
        'token');
  }



  /**
   * Get the response for a failed password reset.
   *
   * @param  \Illuminate\Http\Request
   * @param  string $response
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  protected function sendResetFailedResponse(Request $request, $response)
  {
    return redirect()->back()->withInput($request->only('name'))->withErrors([ 'name' => trans($response) ]);
  }



}
