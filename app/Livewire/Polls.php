<?php

namespace App\Livewire;

use App\Models\Option;
use App\Models\Poll;
use App\Models\Vote;
use Livewire\Component;
use Livewire\Attributes\On;

class Polls extends Component
{

    #[On('pollCreated')]
    public function render()
    {
        $polls = Poll::with('options.votes')->latest()->get();
        return view('livewire.polls', ['polls' => $polls]);
    }

    public function vote(Option $option)
    {
        return $option->votes()->create();
    }
}
