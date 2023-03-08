<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Login
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

//Register
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Auth\Events\Registered;
use App\Models\Frontdesk;

class FrontdeskController extends Controller
{
    public function Index(){
        return view('frontdesk.frontdesk_login');
    }

    public function Dashboard(){
        return view('frontdesk.frontdesk_dashboard');
    }

    //Handle an incoming login request.
    public function FrontdeskLogin(LoginRequest $request): RedirectResponse
    {
        $request->authenticate_Frontdesk();

        $request->session()->regenerate();

        return redirect()->route('frontdesk.dashboard');
    }

    //Destroy an authenticated session or Logout.
    public function FrontdeskLogout(Request $request): RedirectResponse
    {
        Auth::guard('frontdesk')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('frontdesk_login_form');
        // return redirect('/frontdesk/login');
    }

    //Display the registration view.
    public function FrontdeskRegister(){
        return view('frontdesk.frontdesk_register');
    }

    //Handle an incoming registration request.
    public function FrontdeskRegisterCreate(Request $request): RedirectResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Frontdesk::class],
            'password' => ['required', 'confirmed', 
            Password::min(8)->letters()->numbers()->mixedCase()->symbols()],
        ]);

        $frontdesk = Frontdesk::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($frontdesk));
        // return redirect('/frontdesk/login');
        return redirect()->route('frontdesk_login_form');
    }
    public function FrontdeskReservation(){
        return view('frontdesk.frontdesk_reservation');
    }
    public function FrontdeskBookingDetails(){
        return view('frontdesk.frontdesk_bookingdetails');
    }
    public function FrontdeskReports(){
        return view('frontdesk.frontdesk_reports');
    }
    }
