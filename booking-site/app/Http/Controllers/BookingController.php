<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        return view('bookings.index', ['bookings' => Booking::all()]);
    }

    public function create()
    {
        return view('bookings.create');
    }

    public function store(Request $request)
    {
        $request->validate(['service' => 'required', 'booking_time' => 'required|date']);
        Booking::create(['user_id' => Auth::id(), 'service' => $request->service, 'booking_time' => $request->booking_time]);
        return redirect()->route('bookings.index');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back();
    }
}
