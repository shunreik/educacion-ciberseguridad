<?php

namespace App\Http\Controllers;

use App\Http\Middleware\ReadingOwner;
use App\Http\Requests\ReadingRequest;
use App\Models\Image;
use App\Models\Level;
use App\Models\Reading;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReadingController extends Controller
{
    public function __construct()
    {
        $this->middleware(ReadingOwner::class)->only('show', 'edit', 'update');
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
        //Se guardan la imagen del reading
        if ($request->hasFile('newImages')) {
            foreach ($request->file('newImages') as $image) {
                $image = new Image([
                    // 'url' => $image->store('report_images', 's3'),
                    'path' => $image->store('reading_images', 's3'),
                ]);
                $reading->images()->save($image);
            }
        }

        session()->flash('success', 'Lectura registrada correctamente');
        return response()->json(['success' => 'Registro almacenado', 'reading' => $validate, 'redirect' => route('reading')]);
    }

    public function show(Reading $reading)
    {
        $topic = $reading->topic;
        $level = $reading->level;
        $images = $reading->images;

        return view('livewire.reading.show', [
            'reading' => $reading,
            'topic' => $topic,
            'level' => $level,
            'images' => $images,
        ]);
    }

    public function edit(Reading $reading)
    {
        $topics = Topic::all();
        $levels = Level::all();
        $oldImages = $reading->images;

        return view('livewire.reading.edit', [
            'reading' => $reading,
            'topics' => $topics,
            'levels' => $levels,
            'oldImages' => $oldImages,
        ]);
    }

    public function update(ReadingRequest $request, Reading $reading)
    {

        $validate = $request->validated();

        $reading->title = $validate['title'];
        $reading->description = $validate['description'];
        $reading->topic_id = $validate['topic_id'];
        $reading->level_id = $validate['level_id'];
        $reading->save();

        //Se verifica si alguna imagen de la lectura ha sido eliminada
        $oldImagesReceived = $request['oldImages'];
        $oldImagesReading = $reading->images;

        //En caso de recibir un arreglo de imagenes antiguas de la lectura
        if ($request->has('oldImages')) {
            //Se procede a recorrer las imágenes registradas de la lectura
            foreach ($oldImagesReading as $oldImageReading) {
                //Por cada imagen se verifica si ha sido borrada
                $pathOldImage = $oldImageReading->path;
                if ($this->searchDeletedImages($pathOldImage, $oldImagesReceived)) {
                    //Si ha sido eliminada se borra la imagen del servidor y BDD
                    $reading->images()->where('path', $pathOldImage)->delete();
                    if (Storage::disk('s3')->exists($pathOldImage)) {
                        Storage::disk('s3')->delete($pathOldImage);
                    }
                }
            }
        } else {
            //Verifica que la lectura no tenga imagenes registradas con anterioridad
            if (count($oldImagesReading) > 0) {
                //Si contiene imágenes, se procede a eliminar todas las imágenes
                $reading->images()->delete();
                foreach ($oldImagesReading as $oldImageReading) {
                    $pathOldImage = $oldImageReading->path;
                    if (Storage::disk('s3')->exists($pathOldImage)) {
                        Storage::disk('s3')->delete($pathOldImage);
                    }
                }
            }
        }

        //Se guardan la imagenes del reading
        if ($request->hasFile('newImages')) {
            foreach ($request->file('newImages') as $image) {
                $image = new Image([
                    'path' => $image->store('reading_images', 's3'),
                ]);
                $reading->images()->save($image);
            }
        }

        session()->flash('success', 'Lectura actualizada correctamente');
        return response()
            ->json(['success' => 'Registro actualizado', 'reading' => $validate, 'redirect' => route('reading')]);
    }

    /**
     * Check if any images were deleted
     *
     * @param  string  $search
     * @param  array  $array
     * @return boolean $imageIsDeleted
     */

    public function searchDeletedImages($search, $array)
    {
        $imageIsDeleted = true;
        foreach ($array as $image) {
            if ($image === $search) {
                $imageIsDeleted = false;
            }
        }
        return $imageIsDeleted;
    }
}
