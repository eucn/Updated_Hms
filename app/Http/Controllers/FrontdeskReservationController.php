<?php

namespace App\Http\Controllers;
use App\Models\GuestInformation;
use App\Models\Manage_Room;
use App\Models\Reservations;
use Illuminate\Http\Request;

class FrontdeskReservationController extends Controller
{
    public function FrontdeskReservation(){
        return view('frontdesk.frontdesk_reservation');
    }

     public function FrontdeskReservationSave(Request $request)
    {
        $request->validate([
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date',
        ], [
            'check_in_date.required' => 'The check-in date is required.',
            'check_out_date.required' => 'The check-out date is required.',
            'check_out_date.after' => 'The check-out date must be after the check-in date.',
        ]);
    // $roomIds = ::pluck('id
        $checkInDate = $request->input('check_in_date');
        $checkOutDate = $request->input('check_out_date');    
        $room_types = $request->input('room_types');  
        $room_no = $request->input('room_no');  
        $numberOfNights = $request->input('number_of_nights');

 
    }
    
    public function showRoomById(Request $request)
    {
        $room_types = $request->input('room_type');
        $room = Reservations::table('rooms')->select('room_no')->where('room_type', $room_types)->first();
        return view('frontdesk.reservation', ['roomNo' => $room->room_no]);
    }

}