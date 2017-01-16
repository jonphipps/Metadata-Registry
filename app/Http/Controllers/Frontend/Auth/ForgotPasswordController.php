<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

/**
 * Class ForgotPasswordController
 *
 * @package App\Http\Controllers\Frontend\Auth
 */
class ForgotPasswordController extends Controller
{

  use SendsPasswordResetEmails;


  /**
   * Display the form to request a password reset link.
   *
   * @return \Illuminate\Http\Response
   */
  public function showLinkRequestForm()
  {
    return view('frontend.auth.passwords.email');
  }


  /**
   * Display the form to request a password reset link.
   *
   * @return \Illuminate\Http\Response
   */
  public function showLinkRequestFormForName()
  {
    return view('frontend.auth.passwords.name');
  }


  /**
   * Send a reset link to the given user.
   *
   * @param  \Illuminate\Http\Request $request
   *
   * @return \Illuminate\Http\RedirectResponse
   */
  public function sendResetLinkEmailForName(Request $request)
  {
    $table = new User();
    $this->validate($request, [ 'name' => 'required|exists:' . $table->getTable() ]);

    //After we validate the user
    //We will get the user for this name and retrieve the email
    $user = User::where('name', $request->only('name'))
                ->first();

    //We also have to validate the users email here
    $request->merge([ 'email' => $user->email ]);
    $this->validate($request, [ 'email' => 'required|email' ]);

    // We will send the password reset link to this user. Once we have attempted
    // to send the link, we will examine the response then see the message we
    // need to show to the user. Finally, we'll send out a proper response.
    $response = $this->broker()
                     ->sendResetLink($request->only('email'));

    //add the user name to the password tokens table
    DB::table('password_resets')
      ->where('email', $user->email)
      ->update([ 'name' => $request->name ]);

    return $response == Password::RESET_LINK_SENT ? $this->sendResetLinkResponse($response) : $this->sendResetLinkFailedResponse($request,
        $response);
  }

}


