<?php

namespace App\Http\Livewire\Reading;

use App\Models\Reading;
use Livewire\Component;
use Illuminate\Http\Request;

class ReadingComponent extends Component
{
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
}
