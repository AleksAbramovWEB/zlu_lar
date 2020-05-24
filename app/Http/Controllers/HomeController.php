<?php

namespace App\Http\Controllers;


use App\Http\Requests\Home\FeedBackRequest;
use App\Components\UserSeeder;
use App\Http\Requests\Home\TimeZoneRequest;
use App\Repositories\Geo\GeoCountriesRepository;
use Carbon\Carbon;
use Faker\Generator as Faker;



class HomeController extends Controller
{



    public function index(GeoCountriesRepository $countriesRepository){
        $countries = $countriesRepository->getAllCountries();
        return view('home.index', compact('countries'));
    }

    public function feedback(){

        return view('home.feedback');
    }

    /**
     * @param FeedBackRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function feedbackSend(FeedBackRequest $request){

        if(mail('feedback@bdsmzlu.club',
            $request->subject,
            $request->message,
            ['From' => $request->email]
        )) return back()->with('success', true);
        else back()->withErrors('email_error');
    }

    /**
     * сохраняем в сессию тайм-зону из блаузера
     * @param TimeZoneRequest $request
     */
    public function timezone(TimeZoneRequest $request){
        $request->session()->put('timezone', $request->timezone);
    }




}
