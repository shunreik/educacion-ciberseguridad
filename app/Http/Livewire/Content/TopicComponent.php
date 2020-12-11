<?php

namespace App\Http\Livewire\Content;

use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class TopicComponent extends Component
{
    use WithPagination;
    public $topicId, $topicTitle, $topicDescription;

    public function mount($topic)
    {
        $this->topicId = $topic;
    }
    public function render()
    {
        $topic = Topic::findOrFail($this->topicId);
        $this->topicTitle = $topic->title;
        $this->topicDescription = $topic->description;

        //Se presnetan los últimos 9 registros de lectura
        $readings = $topic->readings()->where('status', true)->latest()->paginate(9);

        return view('livewire.content.topic', [
            'readings' => $readings,
        ]);
    }
}
