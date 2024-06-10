<?php

namespace App\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
    public $title;
    public $options = [''];

    protected $rules = [
        'title' => 'required|min:3|max:255',
        'options' => 'required|min:1|max:15',
        'options.*' => 'required|min:1|max:255'
    ];

    protected $messages = [
        'options.*' => 'This option can\'t be empty'
    ];
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createPoll()
    {
        $this->validate();

        Poll::create([
            'title' => $this->title
        ])->options()->createMany(
            collect($this->options)
                ->map(fn($option) => ['name' => $option])
                    ->all()
        );

        $this->reset(['title', 'options']);
        $this->dispatch('pollCreated')->to(Polls::class);
    }
}
