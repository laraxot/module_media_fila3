<div>
     <x-card type='video'  style="width:100%">
        <x-slot name="videoSrc">{{ $model->video_url }}</x-slot>
        <x-slot name="txt">
            @if ($model->getCustomProperty('time_from', null))
                range: {{ gmdate('H:i:s', $model->getCustomProperty('time_from', null)) }} -
                {{ gmdate('H:i:s', $model->getCustomProperty('time_to', null)) }}
            @endif
            <br/> id: {{ $model->id }}
            <br/> status : {{ $model->status }}
            <br/> title ? {{ $model->title }}
            <br/> <button class="btn btn-primary" wire:click="editClip()">edit</button>
        </x-slot>
    </x-card>
</div>