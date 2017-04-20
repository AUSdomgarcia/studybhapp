<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
          |-----------------------
          | Custom Rules
          |-----------------------
        */
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            return preg_match('/^[\pL\s]+$/u', $value);
        });

        Validator::replacer('alpha_spaces', function($message, $attribute, $rule, $parameters) {
            return "The ". $attribute ." field should be alphabets and spaces only.";
        });

        Validator::extend('valid_name', function($attribute, $value)
        {
            return preg_match('/^[\pL\s.-]+$/u', $value);
        });

        Validator::replacer('valid_name', function($message, $attribute, $rule, $parameters) {
            return "The ". $attribute ." field should be valid name.";
        });

        //old password must be the same as old password
        Validator::extend('user_password', function ($attribute, $value) {
            return Hash::check($value, Auth::user()->password);
        });

        Validator::replacer('user_password', function($message, $attribute, $rule, $parameters) {
            return "The ". $attribute ." field does not match to your old password.";
        });

        //new password must not the same as old password
        Validator::extend('user_password_old', function ($attribute, $value) {
            return !Hash::check($value, Auth::user()->password);
        });

        Validator::replacer('user_password_old', function($message, $attribute, $rule, $parameters) {
            return "The ". $attribute ." field is match to your old password. Please try other password";
        });

        //string of emails that has separator
        Validator::extend('isArrayOfEmails', function($attribute, $value, $parameters){
            // define closure separately for readability
            $checkEmails = function($carry, $email){
                return $carry && filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
            };
            // validate that the value given is an array of valid email addresses
            return array_reduce(array_filter(explode($parameters[0],$value)),$checkEmails,true);
        });

        Validator::replacer('isArrayOfEmails', function($message, $attribute, $rule, $parameters) {
            return "There are 1 or more invalid format of emails.";
        });
    }
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
