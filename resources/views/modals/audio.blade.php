<!--Audio modal Structure -->
<div id="audio-modal" class="modal">
    
    <div class="modal-content">
        <h4>{{ __('app.audio_title') }}</h4>
        <form method="POST" action="" enctype="multipart/form-data" id="audio-form">
            <div class="row">
                <div class="input-field col s6">
                    <input id="title" type="text" name="title" class="validate">
                    <label for="title">{{ __('collection.title') }}</label>
                </div>
            </div>
            
            <div class="row">
                <div class="file-field input-field">
                    <div class="btn">
                        <span>Audio file: </span>
                        {{-- accept="audio/mp3,audio/*;capture=microphone" --}}
                        <input type="file" name="audioFile" id="audio-file" />
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div>

            <div class="row">
                <p class="range-field">
                    <input type="range" id="volume-control" min="0" max="100" />
                </p>
            </div>

            <div class="row">
                <label>
                    <input type="checkbox" />
                    <span>Loopable</span>
                </label>
            </div>
     

            <div class="row">
                <div class="input-field col s6">                         
                    <button class="btn waves-effect waves-light" type="submit" onclick="storeAudio();" id="save-audio" name="action">{{ __('app.save') }}
                        <i class="material-icons right">send</i>
                    </button>

                </div>
            </div>
        </form>

    </div>

    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">{{ __('app.cancel') }}</a>
    </div>
</div>
