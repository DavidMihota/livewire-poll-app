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
        $poll = Poll::create([
            'title' => $this->title
        ]);

        foreach($this->options as $option)
        {
            $poll->option()->create([
                'name' => $option
            ]);
        }
        return $this->reset(['title', 'options']);
    }
}
