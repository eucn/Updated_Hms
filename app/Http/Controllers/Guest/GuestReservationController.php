<?php

namespace App\Http\Controllers\Guest;
use App\Models\Reservations;
use App\Models\Manage_Room;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GuestReservationController extends Controller
{
    public function GuestViewRoom($room_id)
    {
        $rooms = Manage_Room::where('id', $room_id)->first();
        $checkin_date = session('check_in_date');
        $checkout_date = session('check_out_date');
        $number_of_nights = session('number_of_nights');

        return view('userGuest.room_info',
         [
         'check_in_date' => $checkin_date,
          'check_out_date' => $checkout_date,
          'number_of_nights' => $number_of_nights,
          'rooms'=>$rooms,
        ]);
    }
    
    public function GuestSaveReserve(Request $request) {
        $guest_id  = auth()->user()->id;

        $numNights = $request->input('number_of_nights');
        $room_id = $request->input('room_id');
        $numGuests = $request->input('guest_num');
        $extraBed = $request->input('extra_bed');
        $booking_status = 'pending';
        $roomPrice = Manage_Room::where('id', $room_id)->value('rate');
        $add_numGuests = 300;
        if ($numNights > 1) {
            $total_roomPrice = $roomPrice * $numNights;
        } else {
            $total_roomPrice = $roomPrice;
        }

        if ($numGuests > 1) {
           $numGuestFee = $add_numGuests *  $numGuests;
        } else {
            $numGuestFee  = 0;
        }
        $total_numGuestFee =  $numGuestFee ;
        $totalPrice = $total_roomPrice +  $total_numGuestFee;

        $checkIn = $request->input('check_in_date');
        $checkOut = $request->input('check_out_date');

        $checkin_date = date('Y-m-d', strtotime($checkIn));
        $checkout_date = date('Y-m-d', strtotime($checkOut));

        $reservation = new Reservations();
        $reservation->guest_id = $guest_id;
        $reservation->room_id = $room_id;
        $reservation->book_status = $booking_status; 
        $reservation->nights = $numNights;
        $reservation->checkin_date = $checkin_date;
        $reservation->checkout_date = $checkout_date;
        $reservation->base_price = $roomPrice;
        $reservation->total_price = $totalPrice;
        $reservation->guests_num = $numGuests;
        $reservation->guestsFee = $total_numGuestFee;
        $reservation->extra_bed = $extraBed;
        $reservation->save();

        // if ($room_id == 1 || $room_id == 2) {
        //     Manage_Room::where('id', $room_id)->update(['status_update' => 'Not Available']);
        // }

        $request->session()->put('resevations', [
            'checkin_date' => $request->input('checkin_date'),
            'checkout_date' => $request->input('checkout_date'),
            'number_of_nights' => $request->input('number_of_nights')
        ]);
        $request->session()->forget('resevation');

        return redirect()->route('registration.form');
    }
    public function ViewGuestInfo() {

        return view('userGuest.guest_registration');
    } 
}
