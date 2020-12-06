<?php

namespace App\Http\Livewire\Reading;

use App\Models\Reading;
use Livewire\Component;
use Illuminate\Http\Request;

class ReadingComponent extends Component
{
    public $title, $description, $topic, $level, $images;

    public function render(Request $request)
    {
        $user = $request->user();//se obtiene al usuario que está realizando la petición
        $readings = $user->readings()->latest()->paginate(10);

        // $readings = Reading::paginate(10);
        return view('livewire.reading.component', [
            'readings' => $readings,
        ]);
    }

    public function create(){
        return redirect()->route('create.reading');
    }

    public function show($id){
        return redirect()->route('show.reading', $id);
    }
}
