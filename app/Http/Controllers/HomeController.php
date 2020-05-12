<?php

namespace App\Http\Controllers;


use App\Http\Requests\Home\FeedBackRequest;
use App\Components\UserSeeder;
use Faker\Generator as Faker;



class HomeController extends Controller
{



    public function index(){
        return view('home.index');
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

    public function polygon(){



    }




}
