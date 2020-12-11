<?php

namespace App\Http\Livewire\Content;

use App\Models\Reading;
use App\Models\Topic;
use Livewire\Component;

class ReadingComponent extends Component
{
    public $readingId, $readingTitle, $readingDescription, $readingLevel,
        $readingImages, $readingAutorName, $readingAutorPhoto, $readingDate;
    public $topicId, $topicName;

    public function mount($topic, $reading)
    {
        $this->topicId = $topic;
        $this->readingId = $reading;
    }
    public function render()
    {
        $reading = Reading::findOrFail($this->readingId);
        $this->readingTitle = $reading->title;
        $this->readingDescription = $reading->description;
        $this->readingLevel = $reading->level->name;
        $this->readingImages = $reading->images;
        $this->readingAutorPhoto = $reading->user->profile_photo_url;
        $this->readingAutorName = $reading->user->nickname;
        $this->readingDate = $reading->created_at->format('d M Y');

        $topic = Topic::findOrFail($this->topicId);
        $this->topicName = $topic->title;

        return view('livewire.content.reading');
    }
}
