<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class event_wlyhController extends Controller
{
    public function index()
    {

        $event = Event::all();

        return view('adminwil.events.event', compact('event'));
    }

}
