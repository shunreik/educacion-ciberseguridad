<?php

namespace App\Http\Livewire\Content;

use App\Models\Level;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;

class TopicComponent extends Component
{
    use WithPagination;

    public $topicId, $topicTitle, $topicDescription;
    //Opciones de filtro
    public $listReadings = true, $listCuestionnaries = false;
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

        if (!empty($this->search)) {

            switch ($this->typeSearch) {
                case 'autor':
                    //Busqueda por usuario
                    $teacheRole = Role::where('name', 'profesor')->first();
                    $teachers = $teacheRole->users();
                    $teacherSearch = $teachers->where("nickname", 'LIKE', "$this->search%")->get()->toArray();
                    $idTeachersFound = array_column($teacherSearch, 'id');
                    $readings = $readings->whereIn("user_id", $idTeachersFound);
                    break;

                case 'level':
                    //Búsqueda por nivel
                    $levels = Level::where('name', 'LIKE', "$this->search%")->get()->toArray();
                    $idLevelsFound = array_column($levels, 'id');
                    $readings = $readings->whereIn('level_id', $idLevelsFound);
                    break;

                default: //Busqueda por título
                    $readings = $readings->where("title", 'LIKE', "%$this->search%");
                    break;
            }
        }

        if($this->listCuestionnaries){
            $readings = $readings->whereHas('questionnarie', function (Builder $query) {
                $query->where('status', true);
            });
        }

        //Se presentan los últimos 9 registros de lectura activas
        $readings = $readings->where('status', true)->latest()->paginate(9);

        return view('livewire.content.topic', [
            'readings' => $readings,
        ]);
    }

    public function allReadings()
    {
        $this->listReadings = true;
        $this->listCuestionnaries = false;
    }

    public function onlyCuestionnaries()
    {
        $this->listReadings = false;
        $this->listCuestionnaries = true;
    }
}
