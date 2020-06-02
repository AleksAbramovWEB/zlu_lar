<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Rules\GenderRole;
use App\Rules\PositionRule;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {


        return Validator::make($data, [
            'name' => ['required', 'string', 'min:3', 'max:29'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'country' => ['required', 'integer', 'exists:geo_countries,id'],
            'region' => ['required', 'integer','exists:geo_regions,id'],
            'city' => ['required','integer', 'exists:geo_cities,id'],
            'day' => ['required','integer', 'between:0,32'],
            'month' => ['required','integer', 'between:0,13'],
            'year' => ['required', 'integer', "between:".(date("Y") - 91).",".(date("Y") - 18), ],
            'position' => ['required', 'string', new PositionRule, ],
            'gender' => ['required', 'string', new GenderRole, ],
            'about' => ['max:3000'],
            'interests' => ['max:3000'],
            'taboo' => ['max:3000'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'country' => $data['country'],
            'region' => $data['region'],
            'city' => $data['city'],
            'birthday'=> "{$data['year']}-{$data['month']}-{$data['day']} 00:00:00",
            'position' => $data['position'],
            'gender' => $data['gender'],
            'about' => $data['about'],
            'interests' => $data['interests'],
            'taboo' => $data['taboo']
        ]);
    }
}
