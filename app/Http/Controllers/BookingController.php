<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\User;
use App\Http\Requests\Booking\StoreBookingsRequest;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Excel;
use Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::all();
        foreach ($bookings as $booking) {
            # code...
            $booking->user_name = User::find($booking->user_id)->name;
        }
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bookings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingsRequest $request)
    {
        //

        $Booking = Booking::create($request->all());

        return redirect()->route('booking.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $booking = Booking::findOrFail($id);
        $booking->pickup_date_and_time  = Carbon::parse($booking->pickup_date_and_time)->format('Y-m-d\TH:i');
        
        // dd($booking);
        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBookingsRequest $request, $id)
    {
        //
        if (! Gate::allows('users_manage')) {
            return abort(401);
        }
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());
        
        return redirect()->route('booking.index');
    }

    public function generateExcel($id)
    {
        $booking = Booking::findOrFail($id);
        Excel::create('Report2016', function($excel) {

            // Set the title
            $excel->setTitle('Bookings');

            // Chain the setters
            $excel->setCreator('Me')->setCompany('Our Code World');

            $excel->setDescription('A demonstration to change the file properties');

            $data = [$booking->pickup_date_and_time,$booking->pickup_address,$booking->dropoff_address,$booking->width,$booking->height,$booking->weight,$booking->length,$booking->status,$booking->price];

            $excel->sheet('Sheet 1', function ($sheet) use ($data) {
                $sheet->setOrientation('landscape');
                $sheet->fromArray($data, NULL, 'A3');
            });

        })->store('xlsx', storage_path().'/file.xlsx');
        $mail = array('name'=>"admin");
        $email = User::find($booking->user_id)->email;
      Mail::send('mail', $data, function($message) {
         $message->to($email,'user')->subject('Laravel Testing Mail with Attachment');
         $message->attach(storage_path().'/file.xlsx');
         $message->from('admin@admin.com','admin');
      });
      echo "Email Sent with attachment. Check your inbox.";
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
