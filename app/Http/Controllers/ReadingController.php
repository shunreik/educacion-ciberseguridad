<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadingRequest;
use App\Models\Level;
use App\Models\Topic;
use Illuminate\Http\Request;

class ReadingController extends Controller
{
    public function __construct()
    {
        //
    }

    public function create()
    {
        $topics = Topic::all();
        $levels = Level::all();

        return view('livewire.reading.create', [
            'topics' => $topics,
            'levels' => $levels,
        ]);
    }

    public function store(ReadingRequest $request)
    {
        $validate = $request->validated();
        return response()->json(['success' => 'Registro almacenado', 'reading' => $validate]);
    }
}
