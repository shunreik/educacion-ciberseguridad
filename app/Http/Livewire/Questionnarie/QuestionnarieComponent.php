<?php

namespace App\Http\Livewire\Questionnarie;

use App\Models\Questionnarie;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class QuestionnarieComponent extends Component
{
    use WithPagination;
    
    public $readingId, $questionnarieId;
    public $confirmEditModal = false;
    public $view = 'confirmEdit';

    //opciones de filtrado
    public $all = true,
        $actived = false,
        $disabled = false;

    //Opciones de búsqueda
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function render(Request $request)
    {
        $user = $request->user(); //se obtiene al usuario que está realizando la petición
        $readings = $this->filterCuestionnaries($user);
        // $readings = $user->readings()->latest()->paginate(10);

        return view('livewire.questionnarie.component', [
            'readings' => $readings,
        ]);
    }

    public function questionnarie($id)
    {
        return redirect()->route('questions', $id);
    }

    public function confirmEdit($readingId, $questionnarieId)
    {
        $this->readingId = $readingId;
        $this->questionnarieId = $questionnarieId;
        $this->confirmEditModal = true;
    }

    public function privateQuestionnarie()
    {
        $questionnarie = Questionnarie::find($this->questionnarieId);
        $questionnarie->status = false;
        $questionnarie->save();

        return redirect()->route('questions', $this->readingId);
    }

    /**
     * Método que permite listar a todos los cuestionarioes
     */
    public function allCuestionnaries()
    {
        $this->all = true;
        $this->actived = false;
        $this->disabled = false;
    }

    /**
     * Método que permite el filtrado de cuestionarios publicados
     */
    public function activatedCuestionnaries()
    {
        $this->actived = true;
        $this->disabled = false;
        $this->all = false;
    }

    /**
     * Método que permitr el filtrado de cuestionarios ocultos o desactivados
     */
    public function disabledCuestionnaries()
    {
        $this->disabled = true;
        $this->actived = false;
        $this->all = false;
    }

    public function filterCuestionnaries(User $user){
        $readings = $user->readings();

        if(!empty($this->search)){
            $readings = $readings->where("title", 'LIKE', "%$this->search%");
        }

        if ($this->all) {
            $readings = $readings;
        }
        if ($this->actived) {
            $readings = $readings->whereHas('questionnarie', function (Builder $query) {
                $query->where('status', true);
            });
        }
        if ($this->disabled) {
            $readings = $readings->whereHas('questionnarie', function (Builder $query) {
                $query->where('status', false);
            });
        }
        
        return $readings->latest()->paginate(10);
    }
}
