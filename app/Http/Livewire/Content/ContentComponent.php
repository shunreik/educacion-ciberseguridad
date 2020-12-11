<?php

namespace App\Http\Livewire\Content;

use App\Models\Topic;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class ContentComponent extends Component
{

    public function render()
    {
        //Solo de obtienen los topics que tengan lecturas asignadas y además
        //estas lecturas estén activas (publicadas)
        $topics = Topic::whereHas('readings', function (Builder $query) {
            $query->where('status', true);
        })->get();
        return view('livewire.content.component', [
            'topics' => $topics,
        ]);
    }
}
