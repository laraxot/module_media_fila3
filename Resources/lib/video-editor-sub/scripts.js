
loadCode();


var slider;
var myPlayer;
var trackEl;
var duration;
var control;
var supportPageOffset = window.pageXOffset !== undefined;
var isCSS1Compat = ((document.compatMode || "") === "CSS1Compat");

function hmsToSecondsOnly(str)
{
    var p = str.split(':'),
        s = 0, m = 1;

    while (p.length > 0) {
        s += m * p.pop();
        // s += m * parseInt(p.pop(), 10);
        m *= 60;
    }

    return s;
}

function loadCode()
{

    //var $ = jQuery.noConflict();
    myPlayer = videojs('video-editor-player', {});
    myPlayer.on("loadedmetadata", onLoadedMetadata);
    document.addEventListener('livewire:load', function () {
        myPlayer.on('timeupdate', function () {
            //@this.currentTime=this.currentTime();
            window.livewire.emit('updateCurrentTime',this.currentTime());
        });
        myPlayer.on('pause', function () {
            //console.log('pause');
            //window.livewire.emit('updateCurrentTime',this.currentTime());
            //@this.currentTime=this.currentTime();
            //console.log(window.livewire.currentTime); //undefined
        });

    });


    slider=document.getElementById('slider-range');
    var tplContent = document.querySelector('template').content
    control = document.importNode(tplContent, true);
    /*
    for(i in control){
        console.log('---');
        console.log(i);
        console.log(control.i);
    }
    */



    //var template=$('template'):
    //console.log('node');
    //console.log('control');
    //console.log(control);
    //console.log('slider');
    //console.log(slider);

    function secondsToHms(seconds)
    {
        var days = Math.floor(seconds / (24 * 60 * 60));
        seconds -= days * (24 * 60 * 60);
        var hours = Math.floor(seconds / (60 * 60));
        seconds -= hours * (60 * 60);
        var minutes = Math.floor(seconds / (60));
        seconds -= minutes * (60);
        let s = ""
        if (hours > 0) {
            s += (hours < 9 ? '0' + hours : hours) + ':'
        }
        s += (minutes < 9 ? '0' + minutes : minutes) + ':' + seconds.toFixed(3)
        return s;
    }

    function onLoadedMetadata()
    {
        trackEl= myPlayer.addRemoteTextTrack({src: $('#video-editor-player').attr('track')+'?'+Date.now(),kind:'subtitles',srclang:'en',label: 'English',mode:'showing'}, false);

        noUiSlider.create(slider, {
            start: [0, myPlayer.duration()],
            connect: true,
            range: {
                'min': 0,
                'max': myPlayer.duration()
            },
            tooltips: [
                true,
                true
            ],
            format: {
                from:  Number,
                to: function (value) {
                    return secondsToHms(value);
                }
            }

        });

        function changeSlider(values)
        {
            myPlayer.currentTime(hmsToSecondsOnly(values[0]));

        }
        slider.noUiSlider.on('slide', changeSlider);
    }

    $(document).on('click', '.play-full',async function () {
        await myPlayer.offset({
            start: 0,
            end: myPlayer.duration(),
            restart_beginning: true //Should the video go to the beginning when it ends
        });
        myPlayer.play()
    });
    $(document).on('click', '.play-slider',async function () {
        const time= slider.noUiSlider.get();
        await myPlayer.offset({
            start: hmsToSecondsOnly(time[0]),
            end:  hmsToSecondsOnly(time[1]),
            restart_beginning: true //Should the video go to the beginning when it ends
        });
        myPlayer.play()
    });
    $(document).on('click', '.play-episode', function () {
        $('body').append('<video id="episode-video" src="'+$(this).parents('.video-episode').attr('src')+'" class="video-js" controls ></video>')
        let mp4 = {
            src:  $(this).parents('.video-episode').attr('src'),
            type: "video/mp4"
        };
        let time= $(this).parents('.video-episode').attr('time')

        let readyPlayer = function () {

            this.src(mp4)

        };
        let episodePlayer = videojs("episode-video",{
            autoplay: 'muted',
        },readyPlayer);

        episodePlayer.offset({
            start: hmsToSecondsOnly(time.split(',')[0]),
            end:  hmsToSecondsOnly(time.split(',')[1]),
            restart_beginning: false //Should the video go to the beginning when it ends
        });

        var ModalDialog = videojs.getComponent('ModalDialog');

        var modal = new ModalDialog(episodePlayer, {
            temporary: true,
            closeable:true
        });
        episodePlayer.addChild(modal);

        episodePlayer.on('pause', function () {
            modal.open();
        });

        episodePlayer.on('play', function () {
            modal.close();
        });

        modal.on('modalclose', function () {
            episodePlayer.dispose();
        });

    })
    $(document).on('click', '#save-video', function () {
        $('#video-model').modal('show');
    });
    $(document).on('click', '.save-video-db', function () {
        $('.loading-wrapper').removeClass('hide');
        window.livewire.emit('save-video-db',$('#video-form').serialize());
    });
    $(document).on('click', '.download-episode', function () {
        $('.loading-wrapper').removeClass('hide');
    });
    $(document).on('click', '#merge-video', function () {
        $('.loading-wrapper').removeClass('hide');
    });
    $(document).on('click', '#save-subtitle-range', function () {
        window.livewire.emit('save-subtitle-range',{time: slider.noUiSlider.get(),text:control['text'],selectedSubtitles:control.selectedSubtitles});
    });
    $(document).on('click', '.save-subtitle-model', function () {
        window.livewire.emit('save-subtitle-model',$('#subtitle-form').serialize());
    });

    $(document).on('click', '#cut-video', function () {

        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var video = document.querySelector('video');

        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        var img_data = canvas.toDataURL('image/jpg');

        window.livewire.emit('take-episode', {image:img_data,time:slider.noUiSlider.get()});
    });

    $(document).on('click', '#get-snap', function () {
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        var video = document.querySelector('video');

        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        var img_data = canvas.toDataURL('image/jpg');
        window.livewire.emit('set-snap', img_data);

        // var filename = 'screenshot.png';

        // var myImage = frame.dataUri;
        // var link = document.getElementById("downlink");
        // link.download = "screenshot.png";
        // link.href = img_data;
        // link.click();
    })





}
function basename(path)
{
    return path.split('/').reverse()[0];
}
function refreshTrack()
{
    myPlayer.removeRemoteTextTrack(trackEl)
    trackEl=  myPlayer.addRemoteTextTrack({src: $('#video-editor-player').attr('track')+'?'+Date.now(),kind:'subtitles',srclang:'en',label: 'English',mode:'showing'}, false);
}
function isHTML(str)
{
    var doc = new DOMParser().parseFromString(str, "text/html");
    return Array.from(doc.body.childNodes).some(node => node.nodeType === 1);
}
var selectedSubtitles=[];

//control.addEventListener('pointerdown', oncontroldown, true);
//$('#test').on('pointerdown', oncontroldown);


document.querySelector('.subtitle-text').onpointerup = ()=>{

    let selection = document.getSelection();
    let text = selection.toString();

    selectedSubtitles=[];
    selectedSubtitleTexts=[];
    if (selection.rangeCount > 0) {
        range = selection.getRangeAt(0);
        var clonedSelection = range.cloneContents();
        var div = document.createElement('div');
        div.appendChild(clonedSelection);

        if (isHTML(div.innerHTML)) {
            var doc = new DOMParser().parseFromString(div.innerHTML, "text/html");
            for (var s in doc.getElementsByClassName('subtitle-item')) {
                if (doc.getElementsByClassName('subtitle-item')[s].id) {
                    selectedSubtitles.push(doc.getElementsByClassName('subtitle-item')[s].id.toString().split('-')[1]);
                    selectedSubtitleTexts.push(doc.getElementsByClassName('subtitle-item')[s].innerText.trim());
                }
            }
        } else {
            selectedSubtitles.push(selection.baseNode.parentNode.id.toString().split('-')[1]);
            selectedSubtitleTexts=[selection.toString()];
        }
    }
    if (text !== "") {
        let rect = selection.getRangeAt(0).getBoundingClientRect();
        var top=(rect.top*1.0) - 138;
        var left=(rect.left*1.0) + (rect.width*0.5) -40;
        var y = supportPageOffset ? window.pageYOffset : isCSS1Compat ? document.documentElement.scrollTop : document.body.scrollTop;
        top = window.event.clientY + y;
        left = window.event.clientX;


        $('#test').css('top',top);
        $('#test').css('left',left);

        $('#test').data('text',text);
        $('#test').data('selectedSubtitles',selectedSubtitles);
        $('#test').data('selectedSubtitleTexts',selectedSubtitleTexts);



        /*
        control.style.top = `calc(${rect.top}px - 138px)`;
        control.style.left = `calc(${rect.left}px + calc(${rect.width}px / 2) - 40px)`;
        control['text']= text;
        control['selectedSubtitles']= selectedSubtitles;
        control['selectedSubtitleTexts']= selectedSubtitleTexts;
        document.body.appendChild(control);
        */
    }
}
/*
function oncontroldown(event) {
    if(event.target.id=='edit-subtitle'){
        // $('#subtitle-model').modal('show');
        window.livewire.emit('set-selected-subtitles',control.selectedSubtitles);
    }
    if(event.target.id=='set-slider-math'){
        const index = $('#subtitle-'+control.selectedSubtitles[0]).text().trim().indexOf(control.selectedSubtitleTexts[0]);
        const index2 = $('#subtitle-'+control.selectedSubtitles[control.selectedSubtitles.length-1]).text().trim().indexOf(control.selectedSubtitleTexts[control.selectedSubtitles.length-1]);
        // const time=$('.subtitle-item.selected').attr('time');

        const time=$('#subtitle-'+control.selectedSubtitles[0]).attr('time');
        const time2=$('#subtitle-'+control.selectedSubtitles[control.selectedSubtitles.length-1]).attr('time');

        if (index !== -1) {
            const startSec=hmsToSecondsOnly(time.split(',')[0]);
            const endSec=hmsToSecondsOnly(time.split(',')[1]);
            const startSec2=hmsToSecondsOnly(time2.split(',')[0]);
            const endSec2=hmsToSecondsOnly(time2.split(',')[1]);
            if(endSec-startSec!=0){
                const secPerLetter=(endSec-startSec)/ $('#subtitle-'+control.selectedSubtitles[0]).text().trim().length;
                const secPerLetter2=(endSec2-startSec2)/$('#subtitle-'+control.selectedSubtitles[control.selectedSubtitles.length-1]).text().trim().length;
                const endIndex = index2 + control.selectedSubtitleTexts[control.selectedSubtitles.length-1].length - 1;
                slider.noUiSlider.set([startSec+index*secPerLetter,startSec2+endIndex*secPerLetter2]);
            }
        }

    }
    if(event.target.id=='set-slider'){

        const time=$('#subtitle-'+control.selectedSubtitles[0]).attr('time');
        const time2=$('#subtitle-'+control.selectedSubtitles[control.selectedSubtitles.length-1]).attr('time');

        slider.noUiSlider.set([hmsToSecondsOnly(time.split(',')[0]),hmsToSecondsOnly(time2.split(',')[1])]);
    }
    // window.livewire.emit('save-subtitle-range', {time:slider.noUiSlider.get(),text:this.text});
    // this.remove();
    // document.getSelection().removeAllRanges();
    // event.stopPropagation();
}
document.onpointerdown = ()=>{
    let control = document.querySelector('#subtitle-control');
    if (control !== null) {
        control.remove();
        //document.getSelection().removeAllRanges();
    }
}
*/

function setSlider()
{
    console.log('set slider !!!');
    var subs=$('#test').data('selectedSubtitles');
    var subs_count= subs.length;
    //console.log(subs);
    var from=$('#subtitle-'+subs[0]).data('start');
    var to=$('#subtitle-'+subs[subs_count-1]).data('end');
    console.log('from - to '+from + ' - '+to);
    //console.log(from);
    //console.log(to);
    slider.noUiSlider.set([from,to]);
    //
    /*
    const time=$('#subtitle-'+control.selectedSubtitles[0]).attr('time');
    const time2=$('#subtitle-'+control.selectedSubtitles[control.selectedSubtitles.length-1]).attr('time');


    */
}

function editSubtitle()
{
    window.livewire.emit('set-selected-subtitles',control.selectedSubtitles);
}

window.addEventListener('edit-subtitle-modal', event => {
    setTimeout(function () {
        $('#subtitle-model').modal('show');
    }, 1000)

})
window.addEventListener('subtitle-saved', event => {
    $('#subtitle-model').modal('hide');
    refreshTrack()
})
window.addEventListener('done', event => {
    $('.loading-wrapper').addClass('hide');
    $('#video-model').modal('hide');
    alert('Video saved successfully.')
})
window.addEventListener('download-file', event => {
    $('.loading-wrapper').addClass('hide');
    for (var d in event.detail) {
        var link = document.getElementById("downlink");
        link.download = basename(event.detail[d]);
        link.href = event.detail[d];
        link.click();
    }
})
