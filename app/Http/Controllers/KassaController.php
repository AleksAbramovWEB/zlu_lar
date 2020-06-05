<?php

namespace App\Http\Controllers;

use App\Components\Kassa\Kassa;
use App\Http\Requests\Kassa\SendToKassaRequest;
use Illuminate\Http\Request;

class KassaController extends Controller
{
    private $kassa;

    public function __construct(Kassa $kassa)
    {
        parent::__construct();

        $this->kassa = $kassa;

    }

    public function index()
    {
        $prise = $this->kassa->get_prise_for_view();
        $kasses = $this->kassa->get_kasses_view();

        return view('connexion.users.settings.kassa', compact('prise', 'kasses'));
    }

    public function send(SendToKassaRequest $request){
        return $this->kassa->send_to_the_kassa($request);
    }


    public function test(Request $request){
        if (empty($request->input())) abort(404);
        $success = $this->kassa->get_from_the_kassa($request, 'test');
        return redirect()->route('kassa.index')->with('success' , $success);
    }


}
