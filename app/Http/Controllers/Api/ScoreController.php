<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Score;
use App\Event;

class ScoreController extends Controller {

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $score = new Score();
        $score->comment = $request->comment;
        $score->point = $request->point;
        $score->save();

        $id_event = $request->id_event;
        $event = Event::find($id_event);
        $event->id_score = $score->id;

        return response()->json($event);
    }

}
