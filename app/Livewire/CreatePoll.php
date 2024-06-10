<?php

namespace App\Livewire;

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
}
