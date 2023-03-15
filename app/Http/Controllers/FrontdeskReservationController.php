<?php

namespace App\Http\Controllers;
use App\Models\GuestInformation;
use App\Models\Manage_Room;
use App\Models\Reservations;
use App\Models\Walkin_Reservation;
use App\Models\Walkin_Reservations;
use Illuminate\Http\Request;

class FrontdeskReservationController extends Controller
{
    public function FrontdeskReservation(){
        return view('frontdesk.frontdesk_reservation');
    }

     public function FrontdeskReservationSave(Request $request)
    {
        $roomType = $request->input('room_type');
        $roomTypeId = Manage_Room::where('room_type', $roomType)->value('id');
        return back()->with('room_id', $roomTypeId);
        
    //     $frontdesk_id  = auth()->user()->id;
    //     $request->validate([
    //         'check_in_date' => 'required|date',
    //         'check_out_date' => 'required|date|after:check_in_date',
    //     ], [
    //         'check_in_date.required' => 'The check-in date is required.',
    //         'check_out_date.required' => 'The check-out date is required.',
    //         'check_out_date.after' => 'The check-out date must be after the check-in date.',
    //     ]);
    // // $roomIds = ::pluck('id')

    //     $checkInDate = $request->input('check_in_date');
    //     $checkOutDate = $request->input('check_out_date');

    //     $checkin_date = date('Y-m-d', strtotime($checkInDate));
    //     $checkout_date = date('Y-m-d', strtotime($checkOutDate)); 

    //     $room_types = $request->input('room_types');  
    //     $room_id = $request->input('room_no');  
    //     $numberOfNights = $request->input('number_of_nights');
    //     $numGuests = $request->input('guest_num');
    //     $extraBed = $request->input('extra_bed');
    //     $booking_status = 'pending';
    //     $roomPrice = Manage_Room::where('id', $room_id)->value('rate');
    //     $add_numGuests = 300;
    //     if ($numberOfNights > 1) {
    //         $total_roomPrice = $roomPrice * $numberOfNights;
    //     } else {
    //         $total_roomPrice = $roomPrice;
    //     }

    //     if ($numGuests > 1) {
    //        $numGuestFee = $add_numGuests *  $numGuests;
    //     } else {
    //         $numGuestFee  = 0;
    //     }
    //     $total_numGuestFee =  $numGuestFee ;
    //     $totalPrice = $total_roomPrice +  $total_numGuestFee;
    //     $reservation = new Walkin_Reservations();
    //     $reservation->guest_id = $frontdesk_id;
    //     $reservation->room_type = $room_types;
    //     $reservation->room_id = $room_id;
    //     $reservation->booking_status = $booking_status; 
    //     $reservation->nights = $numberOfNights;
    //     $reservation->checkin_date = $checkin_date;
    //     $reservation->checkout_date = $checkout_date;
    //     $reservation->base_price = $roomPrice;
    //     $reservation->total_price = $totalPrice;
    //     $reservation->guests_num = $numGuests;
    //     $reservation->guests_Fee = $total_numGuestFee;
    //     $reservation->extra_bed = $extraBed;
    //     $reservation->save();
    //     return redirect()->back()->with('success', 'Reservation created successfully!');
    //     // return view('frontdesk.frontdesk_bookingdetails');
       
    }
    
    public function showRoomById(Request $request)
    {
        $room_types = $request->input('room_type');
        $room = Reservations::table('rooms')->select('room_no')->where('room_type', $room_types)->first();
        return view('frontdesk.reservation', ['roomNo' => $room->room_no]);
    }

}