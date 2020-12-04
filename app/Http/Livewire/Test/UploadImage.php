<?php

namespace App\Http\Livewire\Test;

use Livewire\Component;
use Livewire\WithFileUploads;

class UploadImage extends Component
{
    use WithFileUploads;
    public $images = [];
    public $test;

    public function render()
    {
        return view('livewire.test.upload-image');
    }

    public function store()
    {
        $this->validate([
            'test'=>'required',
            'images.*' => 'image|max:512',
        ]);

        dd($this);
    }
}
