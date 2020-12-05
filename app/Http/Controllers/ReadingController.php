<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadingRequest;
use Illuminate\Http\Request;

class ReadingController extends Controller
{
    public function __construct()
    {
        //
    }

    public function create(){
        return view('livewire.reading.create');
    }

    public function store(ReadingRequest $request){
        $validate = $request->validated();
        return $validate;
    }
}