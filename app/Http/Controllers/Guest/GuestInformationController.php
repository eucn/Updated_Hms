<?php
namespace App\Http\Controllers\Guest;
use App\Models\Manage_Room;

use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Models\GuestInformation;
use App\Http\Controllers\Controller;

class GuestInformationController extends Controller
{
    public function GuestInfo(Request $request){

        $guest_id = auth()->user()->id;
        // $reservation_id = auth()->user()->id;
        $phone_number = $request->validate([
            'phone_number' => 'required|regex:/^09[0-9]{9}$/',
        ], [
            'phone_number.required' => 'The phone number field is required.',
            'phone_number.regex' => 'The phone number contain 11 digit.'
        ]);

        $reservation_id = Reservations::select('id')->latest('id')->value('id');
        // Validate the request data
        $salutation = $request->input('salutation');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $company_name = $request->input('company_name');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $payment_method = $request->input('payment_method');
        $department_id = $request->input('department');

        $salutation = $request->input('salutation');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $company_name = $request->input('company_name');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $payment_method = $request->input('payment_method');
        $department_id = $request->input('department');

        $guestInformation = new GuestInformation();
        $guestInformation->guest_id = $guest_id;
        $guestInformation->reservation_id = $reservation_id;
        $guestInformation->salutation = $salutation;
        $guestInformation->first_name = $first_name;
        $guestInformation->last_name = $last_name;  
        $guestInformation->company_name = $company_name;
        $guestInformation->address = $address;
        $guestInformation->phone_number = $phone_number;

        if($payment_method == "Cash"){
            $guestInformation->payment_method = $payment_method;
        }else if($payment_method == "Department Charge"){
            $guestInformation->payment_method = $payment_method;
            if($department_id == "School of Information Technology"){
                $guestInformation->department = $department_id;
            }else if($department_id == "School of Education"){
                $guestInformation->department = $department_id;
            }
            else if($department_id == "School of Business and Hospitality and Tourism Management"){
                $guestInformation->department = $department_id;
            }
            else if($department_id == "School of Engineering and Architechture and Fine Arts"){
                $guestInformation->department = $department_id;
            }
            else if($department_id == "School of Liberal Arts and Criminal Justice"){
                $guestInformation->department = $department_id;
            }
        }

        // Save the model instance to the database
        $guestInformation->save();

        // Redirect to a success page
        return redirect()->route('view.invoice');   
    }
}
