<?php

namespace App\Http\Livewire\Reading;

use App\Models\Reading;
use Livewire\Component;

class ReadingComponent extends Component
{
    public function render()
    {
        $readings = Reading::paginate(10);
        return view('livewire.reading.component', [
            'readings' => $readings,
        ]);
    }

    public function create(){
        return redirect()->route('create.reading');
    }
}
