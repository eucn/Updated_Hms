<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontdeskReservationController extends Controller
{
     public function FrontdeskReservation(Request $request)
    {
        $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ], [
            'check_in_date.required' => 'The check-in date is required.',
            'check_out_date.required' => 'The check-out date is required.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
        ]);
    // $roomIds = Manage_Room::pluck('id
        $checkInDate = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');    
        $numberOfNights = $request->input('number_of_nights');

        $salutation = $request->input('salutation');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $company_name = $request->input('company_name');
        $address = $request->input('address');
        $phone_number = $request->input('phone_number');
        $payment_method = $request->input('payment_method');
        $department_id = $request->input('department');

    }
}