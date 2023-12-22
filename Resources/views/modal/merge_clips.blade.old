<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    {{--
    <a href="{{ $this->panel->url('index') }}" class="btn btn-info">&laquo; Back</a>
    --}}
    <ul wire:sortable="updateTaskOrder">

        @foreach ($this->clips as $clip)
            <li wire:sortable.item="{{ $clip->id }}" wire:key="task-{{ $clip->id }}">
                <div wire:sortable.handle>
                    <x-card type="video" >
                        <x-slot name="videoSrc">{{ $clip->video_url }}</x-slot>
                        <x-slot name="txt"> {{ $clip->order_column }} </x-slot>
                    </x-card>
                </div>
            </li>
        @endforeach
    </ul>
</div>
<button class="btn btn-primary" wire:click="mergeClips()"> Merge ! </button>

@push('scripts')
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
@endpush