<?php

namespace App\Http\Livewire\Content;

use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class TopicComponent extends Component
{
    use WithPagination;

    public $topicId, $topicTitle, $topicDescription;
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount($topic)
    {
        $this->topicId = $topic;
    }
    public function render()
    {
        $topic = Topic::findOrFail($this->topicId);
        $this->topicTitle = $topic->title;
        $this->topicDescription = $topic->description;

        $readings = $topic->readings();

        if(!empty($this->search)){
            $readings = $readings->where("title", 'LIKE', "%$this->search%");
        }

        //Se presnetan los últimos 9 registros de lectura
        $readings = $readings->where('status', true)->latest()->paginate(9);

        return view('livewire.content.topic', [
            'readings' => $readings,
        ]);
    }
}
