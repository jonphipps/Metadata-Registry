<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Access\User\User;
use App\Notifications\Frontend\Auth\UserNeedsLogin;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;

/**
 * Class ForgotPasswordController.
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


    public function sendLoginNameEmail(Request $request)
    {
        $this->validate($request, [ 'email' => 'required|email|exists:'. User::TABLE ]);

        //if the email exists, we look up all of the user names associated with it
        $email = $request->get('email');
        $user = \App\Models\Access\User\User::where('email', $email)->first();

        //and send them to the user as an email, with a link back to the login screen
        Notification::send($user, new UserNeedsLogin($user));

        return redirect('login')->with('status', 'We have e-mailed your login name(s)!');
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

        return $response == Password::RESET_LINK_SENT ? $this->sendResetLinkResponse($response) : $this->sendResetLinkFailedResponse(
            $request,
            $response
        );
    }
}
