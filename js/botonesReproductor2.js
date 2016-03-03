var a;//audio
var previous;//cancion anterior
var aSource;//ruta cancion
var aTitle;//nombre cancion
var autoplay;
var totalTracks;//numero total de cancion
var previousTrackNum;
var ext;
var loop;//si se repite la lista o no

// Variables donde almacenar selectores de los elementos
var currentTimeInfo;
var plause;
var playlistControl;
var progressBar;
var stop;
var backward;
var forward;
var songTitle;
var timeLoaded;
var timePlayed;
var totalTime;
var tracksSection;
var playing = false;
var trackSelector;
var volumeControl;
var lt;

var started = false;

var trackNum = 0;
var vol = 0.5;
var maxlength = 65;

/*$().ready(function(){

})
//////////////////////////////
$(document).ready(function(){
    
})*/

$(function(){
    a = new Audio();
    a.autoplay = false;
    extBrowser();

    //Asignar selector a variables
    currentTimeInfo = $('#currentTime');
    plause = $('#plause');
    playlistControl = $('#playlistControl');
    progressBar = $('#progressBar');
    stop = $('#stop');
    backward = $('#backward');
    forward = $('#forward');
    songTitle = $('#songTitle');
    timeLoaded = $('#timeLoaded');
    timePlayed = $('#timePlayed');
    totalTime = $('#totalTime');
    tracksSection = $('#tracks');
    trackSelector = $('.cancion');

    volumeControl = $(':range');
    volumeControl.val(vol);

    autoplay = $('#player').attr('data-autoplay');
    loop = $('#player').attr('data-loop');

    totalTracks = trackSelector.size();

    // Agregar eventos
    a.addEventListener('timeupdate',updateTime);
    a.addEventListener('ended',endSong);
    a.addEventListener('progress',loadingTime);
    a.addEventListener('loadedmetadata',metadata);
    a.addEventListener('error',error);

    renameTracksItems();

    volumeControl.rangeinput();

    aSource = trackSelector.eq(trackNum).attr('data-source');
    a.volume = vol;
     if(a.autoplay == true){
        previousTrackNum = trackNum;
        beforePlay();
     }

     plause.click(function (){
        if(playing == true){
            a.pause();
            playing = false;
            document.getElementById("playPause").className = "play icon";
            throw "hola";
        }else{
            if(!started){
                beforePlay();
                throw "hola";
            }else{
                a.play();
                playing = true;
                document.getElementById("playPause").className = "pause icon";
                throw "hola";
            }
        }
     });

     stop.click(function (){
        a.pause();
        a.currentTime = 0;
        playing = false;

        a.removeEventListener('canplay',letsPlay);

        timePlayed.css('width','0%');
        document.getElementById("playPause").className = "play icon";
     });

     backward.click(function(){
        a.pause();
        playing = false;

        a.removeEventListener('canplay',letsPlay);

        timePlayed.css('width','0%');
        plause.css('background','url(../media/imagenes/play.png)');

        previousTrackNum = trackNum;
        
        if(trackNum == 0){
            
            if(trackNum > 0){
                
                trackNum--;
            }else{
                
                trackNum = totalTracks-1;
            }
            aSource = trackSelector.eq(trackNum).attr('data-source');
            beforePlay();
        }else{
            
            if(trackNum > 0){
                
                trackNum--;
                aSource = trackSelector.eq(trackNum).attr('data-source');
                beforePlay();
            }
        }
     });

     forward.click(function(){
        a.pause();
        playing = false;

        a.removeEventListener('canplay',letsPlay);

        timePlayed.css('width','0%');
        plause.css('background','url(../media/imagenes/play.png)');

        previousTrackNum = trackNum;

        if(trackNum == (totalTracks-1) && loop == 1){
            if(trackNum < (totalTracks-1)){
                trackNum++;
            }else{
                trackNum = 0;
            }
            aSource = trackSelector.eq(trackNum).attr('data-source');
            beforePlay();
        }else{
            if(trackNum < (totalTracks-1)){
                trackNum++;
                aSource = trackSelector.eq(trackNum).attr('data-source');
                beforePlay();
            }
        }
     });

     $(':range').change(function (e,vl){
        a.volume = vl;
        vol = vl;
     });

     trackSelector.click(function (){
        aSource = $(this).attr('data-source');

        var trackIndex = trackSelector.index(this);

        if((previous == aSource && playing == false) || previous != aSource){
            previousTrackNum = trackNum;
            trackNum = trackIndex;

            beforePlay();
        }
     });

     var positionP = progressBar.position();
     var topProgress = positionP.top - progressBar.height() + 10;
     var leftProgress = positionP.left;
     var barWidthP = progressBar.width();
     var ctWidth = currentTimeInfo.width();

     progressBar.bind({
        'click' : function (e){
            var pos = e.pageX - leftProgress;
            var newPos = (pos * a.duration) / barWidthP;

            playing=true;
            if(newPos <= lt.end(0) && playing){
                a.currentTime = newPos;
            }
        },
        'mousemove' : function (e){
            var pos = e.pageX - leftProgress;
            var currentTime = pos * a.duration / barWidthP;
            var ctLeft = e.pageX - (ctWidth / 2) + 'px';

            currentTimeInfo.css({
                'display':'block',
                'top':topProgress+'px',
                'left':ctLeft
            });

            currentTimeInfo.text(formatTime(currentTime));
        },
        'mouseout': function (e){
            currentTimeInfo.css('display','none');
        }
     });
});

function beforePlay(){
    //alert("beforePlay "+playing);
    if(playing == false){
        //alert("beforePlay if "+playing);
        a.play();
        playing = true;
        document.getElementById("playPause").className = "pause icon";
        timeLoaded.css('width','0%');
        timePlayed.css('width','0%');
    }
    //alert("beforePlay despues "+playing);
    aTitle = trackSelector.eq(trackNum).text();
    songTitle.text('Loading...');

    trackSelector.eq(previousTrackNum).removeClass('trackPlaying');
    trackSelector.eq(trackNum).addClass('trackPlaying');

    started = true;
    a.src = aSource+ext;
    a.load();

    a.addEventListener('canplay',letsPlay);
    return false;
}

function letsPlay(){
    songTitle.text(aTitle);
    a.play();
    previous = aSource;
    document.getElementById("playPause").className = "pause icon";
}

function updateTime(){
    var total = a.duration;
    var current = a.currentTime;
    var currentPercentage = (current * 100) / total;
    timePlayed.css('width',currentPercentage+'%');

    var ctText = formatTime(current);
    $('#played').text(ctText);
}

function endSong(){
    a.pause();
    playing = false;

    a.removeEventListener('canplay',letsPlay);

    timePlayed.css('width','0%');
    document.getElementById("playPause").className = "play icon";
    previousTrackNum = trackNum;

    if(trackNum == (totalTracks-1) && loop == 1){
        if(trackNum < (totalTracks-1)){
            trackNum++;
        }else{
            trackNum = 0;
        }
        aSource = trackSelector.eq(trackNum).attr('data-source');
        beforePlay();
    }else{
        if(trackNum < (totalTracks-1)){
            trackNum++;
            aSource = trackSelector.eq(trackNum).attr('data-source');
            beforePlay();
        }
    }
}

function loadingTime(){
    lt = a.buffered;

    if(lt.length > 0){
        var loadedTime = lt.end(0);
        var tl = (loadedTime * 100) / a.duration;
    }

    timeLoaded.css('width',tl+'%');
}

function metadata(){
    var total = formatTime(a.duration);
    totalTime.text(total);
}

function renameTracksItems(){
    $('.track span').each(function (){
        var st = $(this).text();

        if(st.length > maxlength){
            st = st.substring(0,maxlength-3)+'...';
            $(this).text(st);
        }
    });
}

function error(){
    if(a.error.code == 4){
        errorString = 'Codec error';
    }
    songTitle.text('Error Loading Files: '+errorString);
}

function formatTime(time){
    var s = Math.floor(time%60);
    var min = Math.floor(time/60);

    var timeText;

    if(s < 10){
        s = '0'+s;
    }
    if(min < 10){
        min = '0'+min;
    }

    timeText = min + ':' + s;
    return timeText;
}

function extBrowser(){
    if($.browser.webkit || $.browser.msie){
        ext = '.mp3';
    }else{
        if($.browser.mozilla || $.browser.opera){
            ext = '.ogg';
        }
    }
}