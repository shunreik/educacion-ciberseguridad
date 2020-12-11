<?php

namespace App\Http\Livewire\Content;

use App\Models\Topic;
use Livewire\Component;

class ContentComponent extends Component
{
    public $view = "topics";

    public function render()
    {
        $topics = Topic::has('readings')->get();
        return view('livewire.content.component', [
            'topics' => $topics,
        ]);
    }

    public function listReadings(){
        $this->view = "readings";
    }
}
