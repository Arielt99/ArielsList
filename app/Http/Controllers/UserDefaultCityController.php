<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UserDefaultCityController extends Controller
{
    public function update($user, array $input)
    {
        Validator::make($input, [
            'default_city' => ['required'],
        ]);

        $user->forceFill([
            'default_city'=>$input['default_city']
        ])->save();
    }
}
