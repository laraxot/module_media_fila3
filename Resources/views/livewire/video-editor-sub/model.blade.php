<?php

declare(strict_types=1);

header('Accept-Ranges: bytes'); ?>
<div>
    <div class="loading-wrapper hide">
        <img src="{{ Theme::asset('media::lib/video-editor-sub/spinner.gif') }}" class="loading-image">
    </div>

    <div class="video-editor-wrapper w-100">
        <div class="container-fluid mt-5 mb-5">
            <div class="row m-3">

                <div class="col-lg-6 col-sm-12">

                    <div wire:ignore>
                        <video id="video-editor-player" track="{{ $vtt }}" class="video-js" controls
                            preload="auto" data-setup="{}">
                            <source src="{{ $src }}" type="video/mp4" />
                            {{-- <track kind="captions" src="{{$vtt}}" srclang="en" label="English" default> --}}
                        </video>
                        <div class="{{-- mt-16mb-10 --}} mt-5">
                            <div id="slider-range"></div>
                        </div>
                    </div>


                    <div class="btn-group-vertical w-100 mt-3">
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <button class="btn btn-primary editor-btn play-full" style="width: 33%">
                                <i class="fa fa-play mr-2"></i>Play
                            </button>
                            <button class="btn btn-primary editor-btn play-slider" style="width: 33%">
                                <i class="fa fa-play mr-2"></i>Play Slider
                            </button>
                            <button class="btn btn-primary editor-btn" id="save-video" style="width: 33%">
                                <i class="fa fa-save mr-2"></i>Save in DB
                            </button>

                        </div>

                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            {{--
                            <button class="btn btn-primary editor-btn" id="get-snap" style="width: 33%">
                                <i class="fa fa-camera mr-2"></i>Snap
                            </button>
                            --}}
                            <button class="btn btn-primary editor-btn" wire:click="exportFrame" style="width: 33%">
                                <i class="fa fa-camera mr-2"></i>Snap {{ $currentTime }}
                            </button>
                            <a id="downlink" style="display:none;" download="screenshot"> </a>
                            <button class="btn btn-primary editor-btn" id="cut-video" style="width: 33%">
                                <i class="fa fa-cut mr-2"></i>Cut
                            </button>
                            <button wire:click="mergeEpisodes"
                                class="btn btn-primary editor-btn {{ count($episodes) > 0 ? '' : 'cursor-no-drop' }}"
                                id="merge-video" {{ count($episodes) > 0 ? '' : 'disabled' }} style="width: 33%">
                                <i class="fa fa-compress mr-2"></i>Merge
                            </button>
                            <input type="text" id="currentTime" wire:model="currentTime" class="form-control" />
                        </div>
                    </div>
                    @if (count($episodes) > 0)
                        <div class="grid items-center w-100 grid-cols-2 md:grid-cols-4 gap-2 my-10">
                            @foreach ($episodes as $ek => $episode)
                                <div class="bg-white p-2 shadow rounded-xl ">
                                    <div src="{{ $src }}" time="{{ implode(',', $episode['time']) }}"
                                        class="video-episode rounded-xl relative"
                                        style="background-image: url('{{ $episode['image'] }}')">
                                        <i class="fa fa-play play-episode absolute text-white"></i>
                                        <div class="absolute right-2 rounded-sm  episode-icon  text-white bg-gray-400"
                                            wire:click="deleteEpisode({{ $ek }})"><i
                                                class="fa fa-times"></i>
                                        </div>
                                        <div class="absolute right-10 rounded-sm episode-icon right-8 text-white bg-gray-400 download-episode"
                                            wire:click="downloadEpisode({{ $ek }})"><i
                                                class="fa fa-download"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    @if (count($snaps) > 0)
                        <h2>Snaps</h2>
                    @endif
                    <div class="grid items-center w-100 grid-cols-2 md:grid-cols-4 gap-2 mb-10">

                        @foreach ($snaps as $sk => $snap)
                            <div class="bg-white p-2 shadow rounded-xl ">
                                <div class="video-episode rounded-xl relative"
                                    style="background-image: url('{{ url($snap) }}')">

                                    <div class="absolute right-2 rounded-sm  episode-icon  text-white bg-gray-400"
                                        wire:click="deleteSnap({{ $sk }})"><i class="fa fa-times"></i>
                                    </div>
                                    <div class="absolute right-10 rounded-sm episode-icon right-8 text-white bg-gray-400 download-episode"
                                        wire:click="downloadSnap({{ $sk }})"><i class="fa fa-download"></i>
                                    </div>
                                </div>
                                <div class="mt-2 flex items-center">
                                    <input wire:model="primary_image" value="{{ $snap }}"
                                        class="mr-2" id="primary-image-{{ $sk }}" type="radio"
                                        name="primary_image" {{ $sk == 0 ? 'checked' : '' }}>
                                    <label for="primary-image-{{ $sk }}">Primary Image</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">

                    <div class="hadow-lg p-3 mb-5 bg-body rounded subtitle-text">
                        @foreach ($subtitles as $sk => $subtitle)
                            <span id="subtitle-{{ $sk }}" data-start="{{ $subtitle->start }}" data-end="{{ $subtitle->end }}"
                                class="{{-- flex items-center justify-between --}}  font-semibold subtitle-item rounded-xl  {{ $selectedSubtitle == $subtitle['id'] ? 'selected' : '' }}"
                                wire:click="setSelectedSubtitle({{ $subtitle['id'] }})">
                                {{ $subtitle['text'] }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <template>
                    <span id="subtitle-control">
                        <b id="set-slider1">set slider from sub</b>
                        <b id="set-slider-math1">set slider from math</b>
                        <b id="edit-subtitle1">Edit</b>
                    </span>
                </template>

                <span id="test" class="subtitle-control">
                    <button onclick="setSlider()" class="btn btn-primary">set slider</button>
                    <button onclick="editSubtitle()" class="btn btn-primary">Edit</button>
                </span>

                <div class="modal" tabindex="-1" role="dialog" id="video-model" wire:ignore>
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Save Video</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="video-form" action="">
                                    <div class="flex flex-col mb-3">
                                        <label class="w-100 mb-2">Video Name</label>
                                        <input type="text" class="form-control w-100" placeholder="Video Name"
                                            name="video_name">
                                    </div>
                                    <div class="flex flex-col mb-3">
                                        <label class="mb-2">Video Description</label>
                                        <textarea type="text" class="form-control" placeholder="Video Description" name="video_description"></textarea>
                                    </div>
                                    @if (config('video.use_category'))
                                        <div class="flex flex-col mb-3">
                                            <label class="mb-2">Video Category</label>
                                            <select class="form-control" placeholder="Category" name="video_category">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category[config('video.category_pk')] }}">
                                                        {{ $category[config('video.category_title_field')] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    @if (!empty($tags))
                                        @foreach ($tags as $tag)
                                            <div class="flex flex-col mb-3">
                                                <label class="mb-2">{{ $tag['entity'] }}</label>

                                                <select class="form-control" placeholder="{{ $tag['entity'] }}"
                                                    name="tags[{{ $tag['entity'] }}]">
                                                    @foreach ($tag['data'] as $data)
                                                        <option value="{{ $data[$tag['tag_pk']] }}">
                                                            {{ $data[$tag['tag_title']] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endforeach
                                    @endif
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary save-video-db">Save Video</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal" tabindex="-1" role="dialog" id="subtitle-model">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Subtitle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="subtitle-form" action="">
                                    @foreach ($this->selectedSubtitles as $subti)
                                        <div class="flex flex-col mb-3">
                                            <label class="w-100 mb-2">Title</label>
                                            <textarea type="text" class="form-control w-100" placeholder="" name="subtitles[{{ $subti }}]"
                                                id="subtitle_text">{{ implode(PHP_EOL, $this->subtitles[$subti]['text']) }}</textarea>
                                        </div>
                                    @endforeach

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary save-subtitle-model">Save Subtitle</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




</div>


@push('styles')
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css">
    <link href="{{ Theme::asset('media::lib/video-editor-sub/style.css') }}" rel="stylesheet">

    {{-- <linkrel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css"/> --}}
    <link href="https://vjs.zencdn.net/7.17.0/video-js.css" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="https://vjs.zencdn.net/7.17.0/video.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-offset@2.1.3/dist/videojs-offset.min.js"></script>
    <script src="{{ Theme::asset('media::lib/video-editor-sub/scripts.js') }}"></script>

    <script>
        var myPlayer = videojs('video-editor-player', {});
        myPlayer.on('timeupdate', function() {
            console.log('timeupdate');
            console.log(this.currentTime());
            @this.currentTime=this.currentTime();
            //window.livewire.emit('updateCurrentTime',this.currentTime());
        });
        myPlayer.on('pause', function() {
            console.log('pause');
            console.log(this.currentTime());
            @this.updateCurrentTime(this.currentTime());
            //window.livewire.emit('updateCurrentTime',this.currentTime());
        });


    </script>
@endpush
