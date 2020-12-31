<?php

namespace App\Http\Livewire\Reading;

use App\Http\Requests\ReadingRequest;
use App\Models\Level;
use App\Models\Reading;
use App\Models\Topic;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;

class ReadingComponent extends Component
{
    use WithPagination;

    public $readingId, $title;
    public $privateMode = false, $publicMode = false;
    public $view = 'disable';

    //opciones de filtrado
    public $all = true,
        $actived = false,
        $disabled = false;

    //Opciones de búsqueda
    public $typeSearch = '', $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'typeSearch' => ['except' => ''],
    ];

    public function render(Request $request)
    {
        $user = $request->user(); //se obtiene al usuario que está realizando la petición
        $readings = $this->filterReadings($user);

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

    /**
     * Método que permite listar a todas las lecturas
     */
    public function allReadings()
    {
        $this->all = true;
        $this->actived = false;
        $this->disabled = false;
    }

    /**
     * Método que permite el filtrado de lecturas publicadas
     */
    public function activatedReadings()
    {
        $this->actived = true;
        $this->disabled = false;
        $this->all = false;
    }

    /**
     * Método que permitr el filtrado de lecturas ocultadas o desactivadas
     */
    public function disabledReadings()
    {
        $this->disabled = true;
        $this->actived = false;
        $this->all = false;
    }

    public function filterReadings(User $user)
    {
        $readings = $user->readings();

        if (!empty($this->search)) {

            switch ($this->typeSearch) {
                case 'topic':
                    $topics = Topic::where('title', 'LIKE', "$this->search%")->get()->toArray();
                    $idTopicsFound = array_column($topics, 'id');
                    $readings = $readings->whereIn('topic_id', $idTopicsFound);
                    break;
                    
                case 'level':
                    //Se debe buscar a los profesores en base a su nickname
                    $levels = Level::where('name', 'LIKE', "$this->search%")->get()->toArray();
                    $idLevelsFound = array_column($levels, 'id');
                    $readings = $readings->whereIn('level_id', $idLevelsFound);
                    break;

                default: //por defecto es el título de la lectura para realizar la búsqueda
                    $readings = $readings->where("title", 'LIKE', "%$this->search%");
                    break;
            }
        }

        if ($this->all) {
            $readings = $readings;
        }
        if ($this->actived) {
            $readings = $readings->where('status', true);
        }
        if ($this->disabled) {
            $readings = $readings->where('status', false);
        }

        return $readings->latest()->paginate(10);
    }
}
