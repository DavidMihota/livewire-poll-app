<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = [''];
    public function render()
    {
        return view('livewire.create-poll');
    }

    public function addOption()
    {
        return $this->options[] = '';
    }

    public function removeOption($index)
    {
        unset($this->options[$index]);
        return $this->options = array_values($this->options);
    }

    public function clearOption($index)
    {
        return $this->options[$index] = '';
    }

    public function createPoll()
    {
        Poll::create([
            'title' => $this->title
        ])->option()->createMany(
            collect($this->options)
                ->map(fn($option) => ['name' => $option])
                    ->all()
        );

        return $this->reset(['title', 'options']);
    }
}
