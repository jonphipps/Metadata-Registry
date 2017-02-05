<?php

use Faker\Factory;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;
use tests\traits\InteractsWithMailTrap;


/**
 * Class LoggedOutFormTest
 */
class LoggedOutFormTest extends TestCase
{

  use InteractsWithDatabase;
  use InteractsWithMailTrap;


  /**
   * Test that the errors work if nothing is filled in the registration form
   */
  public function testRegistrationRequiredFields()
  {
    $this->visit('/register')
         ->type('', 'name')
         ->type('', 'email')
         ->type('', 'password')
         ->press('Register')
         ->seePageIs('/register')
         ->see('The name field is required.')
         ->see('The email field is required.')
         ->see('The password field is required.');
  }


  /**
   * Test the registration form
   * Test it works with confirming email on or off, and that the confirm email notification is sent
   * Note: Captcha is disabled by default in phpunit.xml
   */
  public function testRegistrationForm()
  {
    // Make sure our events are fired
    Event::fake();

    // Create any needed resources
    $faker    = Faker\Factory::create();
    $name     = $faker->name;
    $email    = $faker->safeEmail;
    $password = $faker->password(8);

    // Check if confirmation required is on or off
    if (config('access.users.confirm_email')) {
      Notification::fake();

      $this->visit('/register')
           ->type($name, 'name')
           ->type($email, 'email')
           ->type($password, 'password')
           ->type($password, 'password_confirmation')
           ->press('Register')
           ->see('Your account was successfully created. We have sent you an e-mail to confirm your account.')
           ->see('Login')
           ->seePageIs('/')
           ->seeInDatabase(config('access.users_table'), [ 'email' => $email, 'name' => $name ]);

      // Get the user that was inserted into the database
      $user = User::where('email', $email)
                  ->first();

      // Check that the user was sent the confirmation email
      Notification::assertSentTo([ $user ],
          UserNeedsConfirmation::class);
    } else {
      $this->visit('/register')
           ->type($name, 'name')
           ->type($email, 'email')
           ->type($password, 'password')
           ->type($password, 'password_confirmation')
           ->press('Register')
           ->see('Dashboard')
           ->seePageIs('/')
           ->seeInDatabase(config('access.users_table'), [ 'email' => $email, 'name' => $name ]);
    }

    Event::assertFired(UserRegistered::class);
  }


  /**
   * Test that the errors work if nothing is filled in the login form
   */
  public function testLoginRequiredFields()
  {
    $this->visit('/login')
         ->type('', 'name')
         ->type('', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('The name field is required.')
         ->see('The password field is required.');
  }


  /**
   * Test that the user is logged in and redirected to the dashboard
   * Test that the admin is logged in and redirected to the backend
   */
  public function testLoginForm()
  {
    // Make sure our events are fired
    Event::fake();

    Auth::logout();

    //User Test
    $this->visit('/login')
         ->type($this->user->name, 'name')
         ->type('1234', 'password')
         ->press('Login')
         ->seePageIs('/dashboard')
         ->see($this->user->name);

    Auth::logout();

    //Admin Test
    $this->visit('/login')
         ->type($this->admin->name, 'name')
         ->type('1234', 'password')
         ->press('Login')
         ->seePageIs('/admin/dashboard')
         ->see($this->admin->name)
         ->see('Access Management');

    Event::assertFired(UserLoggedIn::class);
  }


  /**
   * Test that the errors work if nothing is filled in the forgot password form
   */
  public function testForgotLoginRequiredFields()
  {
    $this->visit('/password/email')
         ->type('', 'email')
         ->press('Send Login Name')
         ->seePageIs('/password/email')
         ->see('The email field is required.');
  }


  /**
   * Test that the forgot login form sends the user the notification and contains the login info
   */
  public function testForgotLoginForm()
  {

    $this->visit('password/email')
         ->type($this->user->email, 'email')
         ->press('Send Login Name')
         ->seePageIs('/login')
         ->see('We have e-mailed your login name(s)!');

    $this->_initializeClient();
    $this->receivedAnEmailToEmail($this->user->email);
    $this->seeInEmailTextBody($this->user->name);

    // //$this->seeMessageFor($this->user->email);
    // Notification::assertSentTo([ $this->user ],
    //     UserNeedsLogin::class);

    // Notification::assertSentTo([ $this->user ],
    //     UserNeedsLogin::class,
    //     function ($notification, $channels) {
    //       return $notification->order->id === false;
    //     });
  }


  /**
   * Test that the forgot login form sends the user the notification and contains the login info
 */
  public function testForgotMultipleLoginsForm()
  {
    $user2 = factory(App\Models\Access\User\User::class)->create([
        'email'=> $this->user->email
    ]);

    $this->visit('password/email')
         ->type($this->user->email, 'email')
         ->press('Send Login Name')
         ->seePageIs('/login')
         ->see('We have e-mailed your login name(s)!');

    $this->_initializeClient();
    $this->receivedAnEmailToEmail($this->user->email);
    $this->seeInEmailTextBody($this->user->name);
    $this->seeInEmailTextBody($user2->name);

    // //$this->seeMessageFor($this->user->email);
    // Notification::assertSentTo([ $this->user ],
    //     UserNeedsLogin::class);

    // Notification::assertSentTo([ $this->user ],
    //     UserNeedsLogin::class,
    //     function ($notification, $channels) {
    //       return $notification->order->id === false;
    //     });
  }


  /**
   * Test that the errors work if nothing is filled in the forgot password form
   */
  public function testForgotPasswordRequiredFields()
  {
    $this->visit('/password/reset')
         ->type('', 'name')
         ->press('Send Password Reset Link')
         ->seePageIs('/password/reset')
         ->see('The name field is required.');
  }


  /**
   * Test that the forgot password form sends the user the notification and places the
   * row in the password_resets table
   */
  public function testForgotPasswordForm()
  {
    Notification::fake();

    $this->visit('password/reset')
         ->type($this->user->name, 'name')
         ->press('Send Password Reset Link')
         ->seePageIs('password/reset')
         ->see('We have e-mailed your password reset link!')
         ->seeInDatabase('password_resets', [ 'email' => $this->user->email ])
         ->seeInDatabase('password_resets', [ 'name' => $this->user->name ]);

    Notification::assertSentTo([ $this->user ],
        UserNeedsPasswordReset::class);
  }


  /**
   * Test that the errors work if nothing is filled in the reset password form
   */
  public function testResetPasswordRequiredFields()
  {
    $token = "1234567890abcdefghijklmnopqrstuvwxyz";
    $this->createPasswordResetToken($token);

    $this->visit('password/reset/' . $token)
         ->see($this->user->email)
         ->type($this->user->name, 'name')
         ->type('', 'password')
         ->type('', 'password_confirmation')
         ->press('Reset Password')
         ->see('The password field is required.');
  }


  /**
   * Test that the password reset form works and logs the user back in
   */
  public function testResetPasswordForm()
  {
    $token = "abcdefghijklmnopqrstuvwxyz1234567890";
    $this->createPasswordResetToken($token);
    //$this->user->confirmed = 0;
    //$this->user->save();

    /** @noinspection PhpVoidFunctionResultUsedInspection */
    $this->visit('password/reset/' . $token)
         ->see($this->user->email)
         ->type($this->user->name, 'name')
         ->type('12345678', 'password')
         ->type('12345678', 'password_confirmation')
         ->press('Reset Password')
         ->seePageIs('/dashboard')
         ->see($this->user->name);
    $this->seeInDatabase(App\Models\Access\User\User::TABLE, [ 'id' => $this->user->id, 'confirmed' => 1 ]);

  }


  /**
   * Test that an unconfirmed user can not login
   */
  public function testUnconfirmedUserCanNotLogIn()
  {
    // Create default user to test with
    $unconfirmed = factory(User::class)
        ->states('unconfirmed')
        ->create();
    $unconfirmed->attachRole(3); //User

    $this->visit('/login')
         ->type($unconfirmed->name, 'name')
         ->type('secret', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('Your account is not confirmed.');
  }


  /**
   * Test that an inactive user can not login
   */
  public function testInactiveUserCanNotLogIn()
  {
    // Create default user to test with
    $inactive = factory(User::class)
        ->states('confirmed', 'inactive')
        ->create();
    $inactive->attachRole(3); //User

    $this->visit('/login')
         ->type($inactive->name, 'name')
         ->type('secret', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('Your account has been deactivated.');
  }


  /**
   * Test that a user with invalid credentials get kicked back
   */
  public function testInvalidLoginCredentials()
  {
    $this->visit('/login')
         ->type($this->user->name, 'name')
         ->type('9s8gy8s9diguh4iev', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('These credentials do not match our records.');
  }


  /**
   * Adds a password reset row to the database to play with
   *
   * @param $token
   *
   * @return mixed
   */
  private function createPasswordResetToken($token)
  {
    DB::table('password_resets')
      ->insert([
          'email'      => $this->user->email,
          'token'      => $token,
          'created_at' => \Carbon\Carbon::now(),
      ]);

    return $token;
  }
}