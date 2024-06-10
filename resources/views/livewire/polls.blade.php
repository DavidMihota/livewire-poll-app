<div>
    @forelse ($polls as $poll)
        <div class="mb-4 card bg-white rounded-md">
            <h3 class="text-xl mb-4 border-b-2 border-neutral-100">
                {{ $poll->title }}
            </h3>

            @foreach ($poll->options as $option)
                <div class="mb-2">
                    <button class="btn" wire:click.prevent="vote({{ $option->id }})">Vote</button>
                    {{ $option->name }} ({{ $option->votes->count() }})
                </div>
            @endforeach
        </div>
    @empty
        <div class="text-gray-500">
            No polls available!
        </div>
    @endforelse
</div>
