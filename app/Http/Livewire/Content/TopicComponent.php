<?php

namespace App\Http\Livewire\Content;

use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class TopicComponent extends Component
{
    use WithPagination;

    public $topicId, $topicTitle, $topicDescription;
    //Opciones de búsqueda
    public $typeSearch = '', $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'typeSearch' => ['except' => ''],
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

            switch ($this->typeSearch) {
                case 'autor':
                    //Se debe buscar a los profesores en base a su nickname
                    $teacheRole = Role::where('name', 'profesor')->first();
                    $teachers = $teacheRole->users();
                    $teacherSearch = $teachers->where("nickname", 'LIKE', "$this->search%")->get()->toArray();
                    $idTeachersFound = array_column($teacherSearch, 'id');
                    $readings = $readings->whereIn("user_id", $idTeachersFound);
                    break;
                
                default://por defecto es el título de la lectura para realizar la búsqueda
                    $readings = $readings->where("title", 'LIKE', "%$this->search%");
                    break;
            }
            
        }

        //Se presentan los últimos 9 registros de lectura activas
        $readings = $readings->where('status', true)->latest()->paginate(9);

        return view('livewire.content.topic', [
            'readings' => $readings,
        ]);
    }
}
