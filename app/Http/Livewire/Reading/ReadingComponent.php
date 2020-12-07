<?php

namespace App\Http\Livewire\Reading;

use App\Http\Requests\ReadingRequest;
use App\Models\Reading;
use Livewire\Component;
use Illuminate\Http\Request;

class ReadingComponent extends Component
{
    public $readingId, $title;
    public $privateMode = false, $publicMode = false;
    public $view = 'disable';

    public function render(Request $request)
    {
        $user = $request->user(); //se obtiene al usuario que está realizando la petición
        $readings = $user->readings()->latest()->paginate(10);

        // $readings = Reading::paginate(10);
        return view('livewire.reading.component', [
            'readings' => $readings,
        ]);
    }

    public function create()
    {
        return redirect()->route('create.reading');
    }

    public function show($id)
    {
        return redirect()->route('show.reading', $id);
    }

    public function edit($id)
    {
        return redirect()->route('edit.reading', $id);
    }

    public function confirmPrivate($id)
    {
        $this->view = 'disable';
        $reading = Reading::find($id);
        $this->readingId = $reading->id;
        $this->title = $reading->title;
        $this->privateMode = true;
    }

    public function private()
    {
        $reading = Reading::find($this->readingId);
        $reading->status = false;
        $reading->save();
        $this->privateMode = false;
        session()->flash('success', 'Lectura privada correctamente');
    }

    public function comfirmPublic($id)
    {
        $this->view = 'active';
        $reading = Reading::find($id);
        $this->readingId = $reading->id;
        $this->title = $reading->title;
        $this->publicMode = true;
    }

    public function public()
    {
        $reading = Reading::find($this->readingId);
        $reading->status = true;
        $reading->save();
        $this->publicMode = false;
        session()->flash('success', 'Lectura publicada correctamente');
    }
}
