<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadingRequest;
use App\Models\Image;
use App\Models\Level;
use App\Models\Reading;
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
        $reading = new Reading();
        $reading->title = $validate['title'];
        $reading->description = $validate['description'];
        $reading->status = true;
        $reading->user_id = $request->user()->id;
        $reading->topic_id = $validate['topic_id'];
        $reading->level_id = $validate['level_id'];
        $reading->save();
        //Se guardan la imagenes del reading
        if($request->file('newImages')){
            foreach ($request->file('newImages') as $image) {
                $image = new Image([
                    // 'url' => $image->store('report_images', 's3'),
                    'url' => $image->store('reading_images'),
                    ]);
                $reading->images()->save($image);
            }
        }

        session()->flash('success', 'Lectura registrada correctamente');
        return response()->json(['success' => 'Registro almacenado', 'reading' => $validate]);
    }
}
