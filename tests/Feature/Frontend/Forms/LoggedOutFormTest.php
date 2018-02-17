<?php

namespace Tests\Feature\Frontend\Forms;

use App\Mail\Frontend\Contact\SendContact;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Mail;
use Tests\BrowserKitTestCase;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use App\Events\Frontend\Auth\UserLoggedIn;
use App\Events\Frontend\Auth\UserRegistered;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Frontend\Auth\UserNeedsConfirmation;
use App\Notifications\Frontend\Auth\UserNeedsPasswordReset;
use Tests\Traits\InteractsWithMailTrap;

/**
 * Class LoggedOutFormTest
 */
class LoggedOutFormTest extends BrowserKitTestCase
{

    use DatabaseTransactions;
    use InteractsWithMailTrap;


  /**
     * Test that the errors work if nothing is filled in the registration form.
     */
    public function testRegistrationRequiredFields()
    {
        $this->visit('/register')
             ->type('', 'first_name')
             ->type('', 'last_name')
         ->type('', 'nickname')
         ->type('', 'email')
         ->type('', 'password')
         ->press('Register')
         ->seePageIs('/register')
             ->see('The first name field is required.')
             ->see('The last name field is required.')
         ->see('The nickname field is required.')
         ->see('The email field is required.')
         ->see('The password field is required.');
    }


  /**
     * Test the registration form
     * Test it works with confirming email on or off, and that the confirm email notification is sent
     * Note: Captcha is disabled by default in phpunit.xml.
     */
    public function testRegistrationForm()
    {
        // Make sure our events are fired
        Event::fake();

        config(['access.users.confirm_email' => false]);
        config(['access.users.requires_approval' => false]);

        // Create any needed resources
        $faker = Factory::create();
         $firstName = $faker->firstName;
        $lastName = $faker->lastName;
        $name     = $faker->userName;
        $email    = $faker->safeEmail;
        $password = $faker->password(8);

        $this->visit('/register')
              ->type($firstName, 'first_name')
             ->type($lastName, 'last_name')
            ->type($name, 'nickname')
             ->type($email, 'email')
             ->type($password, 'password')
             ->type($password, 'password_confirmation')
             ->press('Register')
             ->seePageIs('/')
            ->seeInDatabase(
                config('access.users_table'),
                [
                     'email' => $email,
                     'first_name' => $firstName,
                     'last_name' => $lastName,
                     'nickname' => $name,
                     'confirmed' => 1,
                ]
            );

        Event::assertDispatched(UserRegistered::class);
    }

    /**
     * Test the required fields error messages when trying to register
     * without filling out the fields.
     */
    public function testRegistrationFormConfirmationRequired()
    {
        Event::fake();
        Notification::fake();

        config(['access.users.confirm_email' => true]);
        config(['access.users.requires_approval' => false]);

        // Create any needed resources
        $faker =  Factory::create();
         $firstName = $faker->firstName;
        $lastName = $faker->lastName;
        $name  = $faker->userName;
        $email = $faker->safeEmail;
        $password = $faker->password(8);

        $this->visit('/register')
            ->type($firstName, 'first_name')
            ->type($lastName, 'last_name')
            ->type($name, 'nickname')
            ->type($email, 'email')
            ->type($password, 'password')
            ->type($password, 'password_confirmation')
            ->press('Register')
            ->see('Your account was successfully created. We have sent you an e-mail to confirm your account.')
            ->see('Login')
            ->seePageIs('/')
            ->seeInDatabase(
                config('access.users_table'),
                [
                    'email' => $email,
                     'first_name' => $firstName,
                    'last_name' => $lastName,
                   'nickname' => $name,
                    'confirmed' => 0,
                ]
            );

        // Get the user that was inserted into the database
        $user = User::where('nickname', $name)->first();

        Notification::assertSentTo([$user], UserNeedsConfirmation::class);
        Event::assertDispatched(UserRegistered::class);
    }

    /**
     * Test the registration form when account are set to be pending an approval
     * ensure they are registered but not confirmed.
     */
    public function testRegistrationFormPendingApproval()
    {
        Event::fake();
        Notification::fake();

        // Set registration to pending approval
        config(['access.users.confirm_email' => false]);
        config(['access.users.requires_approval' => true]);

        // Create any needed resources
        $faker = Factory::create();
        $firstName = $faker->firstName;
        $lastName = $faker->lastName;
        $name     = $faker->userName;
        $email = $faker->safeEmail;
        $password = $faker->password(8);

        $this->visit('/register')
            ->type($firstName, 'first_name')
            ->type($lastName, 'last_name')
            ->type($name, 'nickname')
            ->type($email, 'email')
            ->type($password, 'password')
            ->type($password, 'password_confirmation')
            ->press('Register')
            ->see('Your account was successfully created and is pending approval. An e-mail will be sent when your account is approved.')
            ->see('Login')
            ->seePageIs('/')
            ->seeInDatabase(
                config('access.users_table'),
                [
                    'email' => $email,
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'nickname' => $name,
                    'confirmed' => 0,
                ]
            );

        // Get the user that was inserted into the database
        $user = User::where('nickname', $name)->first();

        Notification::assertNotSentTo([$user], UserNeedsConfirmation::class);
        Event::assertDispatched(UserRegistered::class);
    }


  /**
     * Test that the errors work if nothing is filled in the login form.
     */
    public function testLoginRequiredFields()
    {
        $this->visit('/login')
         ->type('', 'nickname')
         ->type('', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('The nickname field is required.')
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
         ->type($this->user->nickname, 'nickname')
         ->type('1234', 'password')
         ->press('Login');
         $this->seePageIs('/dashboard')
         ->see($this->user->name);

        Auth::logout();

        //Admin Test
        $this->visit('/login')
         ->type($this->admin->nickname, 'nickname')
         ->type('1234', 'password')
         ->press('Login')
         ->seePageIs('/admin/dashboard')
         ->see($this->admin->name)
         ->see('Access Management');

        Event::assertDispatched(UserLoggedIn::class);
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
        $this->seeInEmailTextBody($this->user->nickname);
    }


  /**
   * Test that the forgot login form sends the user the notification and contains the login info
 */
    public function testForgotMultipleLoginsForm()
    {
        $user2 = factory(User::class)->create([
        'email'=> $this->user->email
        ]);

        $this->visit('password/email')
         ->type($this->user->email, 'email')
         ->press('Send Login Name')
         ->seePageIs('/login')
         ->see('We have e-mailed your login name(s)!');

        $this->_initializeClient();
        $this->receivedAnEmailToEmail($this->user->email);
        $this->seeInEmailTextBody($this->user->nickname);
        $this->seeInEmailTextBody($user2->nickname);
    }


  /**
   * Test that the errors work if nothing is filled in the forgot password form
   */
    public function testForgotPasswordRequiredFields()
    {
        $this->visit('/password/reset')
         ->type('', 'nickname')
         ->press('Send Password Reset Link')
         ->seePageIs('/password/reset')
         ->see('The nickname field is required.');
    }


  /**
     * Test that the forgot password form sends the user the notification and places the
     * row in the password_resets table.
     */
    public function testForgotPasswordForm()
    {
        Notification::fake();

        $this->visit('password/reset')
         ->type($this->user->nickname, 'nickname')
         ->press('Send Password Reset Link')
         ->seePageIs('password/reset')
         ->see('We have e-mailed your password reset link!')
         ->seeInDatabase('password_resets', [ 'email' => $this->user->email ])
         ->seeInDatabase('password_resets', [ 'name' => $this->user->nickname ]);

        Notification::assertSentTo(
            [ $this->user ],
            UserNeedsPasswordReset::class
        );
    }


  /**
     * Test that the errors work if nothing is filled in the reset password form.
     */
    public function testResetPasswordRequiredFields()
    {
        $token = $this->app->make('auth.password.broker')->createToken($this->user);

      //add the user name to the password tokens table
        DB::table('password_resets')->where('email', $this->user->email)->update([ 'name' => $this->user->nickname ]);

        $this->visit('password/reset/' . $token)
         ->see($this->user->email)
         ->see($this->user->nickname)
         ->type('', 'password')
         ->type('', 'password_confirmation')
         ->press('Reset Password')
         ->see('The password field is required.');
    }

    /**
     * Test that the password reset form works and logs the user back in.
     */
    public function testResetPasswordForm()
    {
        $token = $this->app->make('auth.password.broker')->createToken($this->user);
        //add the user name to the password tokens table
        DB::table('password_resets')
          ->where('email', $this->user->email)
          ->update(['name' => $this->user->nickname]);

        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $this->visit('password/reset/'.$token)
             ->see($this->user->email)
             ->see($this->user->nickname)
             ->type('12345678', 'password')
             ->type('12345678', 'password_confirmation')
             ->press('Reset Password')
             ->seePageIs('/dashboard')
             ->see($this->user->name);
        $this->seeInDatabase(config('access.users_table'), ['id' => $this->user->id, 'confirmed' => 1]);

        // Auth::logout();
        // $this->visit('login')
        //     ->type($this->user->name, 'name')
        //     ->type('12345678', 'password')
        //     ->seePageIs('dashboard');
    }


  /**
     * Test that an unconfirmed user can not login.
     */
    public function testUnconfirmedUserCanNotLogIn()
    {
        config(['access.users.requires_approval' => false]);

        // Create default user to test with
        $unconfirmed = factory(User::class)->states('unconfirmed')->create();
        $unconfirmed->attachRole(3); //User

        $this->visit('/login')
         ->type($unconfirmed->nickname, 'nickname')
         ->type('secret', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('Your account is not confirmed.');
    }

    /**
     * Test that an account this is currently pending approval can not log in.
     */
    public function testUnconfirmedUserCanNotLogInPendingApproval()
    {
        config(['access.users.requires_approval' => true]);

        // Create default user to test with
        $unconfirmed = factory(User::class)->states('unconfirmed')->create();
        $unconfirmed->attachRole(3); //User

        $this->visit('/login')
            ->type($unconfirmed->nickname, 'nickname')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('/login')
            ->see('Your account is currently pending approval.');
    }

  /**
     * Test that an inactive user can not login.
     */
    public function testInactiveUserCanNotLogIn()
    {
        // Create default user to test with
        $inactive = factory(User::class)->states('confirmed', 'inactive')->create();
        $inactive->attachRole(3); //User

        $this->visit('/login')
         ->type($inactive->nickname, 'nickname')
         ->type('secret', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('Your account has been deactivated.');
    }


  /**
     * Test that a user with invalid credentials get kicked back.
     */
    public function testInvalidLoginCredentials()
    {
        $this->visit('/login')
         ->type($this->user->nickname, 'nickname')
         ->type('9s8gy8s9diguh4iev', 'password')
         ->press('Login')
         ->seePageIs('/login')
         ->see('These credentials do not match our records.');
    }

    /**
     * Test the contact forms required fields.
     */
    public function testContactFormRequiredFields()
    {
        $this->visit('/contact')
            ->press(trans('labels.frontend.contact.button'))
            ->seePageIs('/contact')
            ->see('The nickname field is required.')
            ->see('The email field is required.')
            ->see('The message field is required.');
    }

    /**
     * Test the contact form sends the mail.
     */
    public function testContactForm()
    {
        Mail::fake();

        $this->visit('/contact')
            ->type('Administrator', 'nickname')
            ->type('admin@admin.com', 'email')
            ->type('1112223333', 'phone')
            ->type('Hello There', 'message')
            ->press(trans('labels.frontend.contact.button'))
            ->seePageIs('/contact')
            ->see(trans('alerts.frontend.contact.sent'));

        Mail::assertSent(SendContact::class);
    }

  /**
     * Adds a password reset row to the database to play with.
     *
     * @param $token
     *
     * @return mixed
     */
    private function createPasswordResetToken($token)
    {
        DB::table('password_resets')->insert([
          'email'      => $this->user->email,
          'token'      => $token,
          'created_at' => \Carbon\Carbon::now(),
        ]);

        return $token;
    }
}
