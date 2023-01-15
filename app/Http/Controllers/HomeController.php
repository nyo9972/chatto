<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->avatar == config('chatify.user_avatar.default')){
            return redirect(Route('configuration'));
        }else{
            $routeName= FacadesRequest::route()->getName();
            $type = in_array($routeName, ['user','group'])
                ? $routeName
                : 'user';

            return view('Chatify::pages.app', [
                'id' => $id ?? 0,
                'type' => $type ?? 'user',
                'messengerColor' => Auth::user()->messenger_color ?? $this->messengerFallbackColor,
                'dark_mode' => Auth::user()->dark_mode < 1 ? 'light' : 'dark',
            ]);
        }

    }


}
