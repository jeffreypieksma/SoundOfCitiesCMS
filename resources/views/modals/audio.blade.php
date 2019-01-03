<!--Audio modal Structure -->
<div id="audio-modal" class="audioPopup">
    
    <div class="modal-content">
        <h4 class="color-primary">{{ __('app.audio_title') }}</h4>
        <p class="subtitle">{{ __('app.select_audio') }}</p>
        <form method="POST" id="audio-form">
            {{ csrf_field() }}
            <input type="hidden" name="audio_zone_id" value="1" id="audio_zone_id" />
            
            <div class="row">      
                <span>{{ __('audio.select_audio_file') }}</span>
                <ul class="select-audio-file-list">
                   
                    @foreach($audioFiles as $audioFile)
                        <li>
                            <label>
                                <input type="radio" class="with-gap" name="audioFile" value="{{ $audioFile->id }}" id="audio_file" />
                                <span for="audioFile">{{ $audioFile->audio_url }}</span>
    
                            </label>   
                            
                        </li>
                    @endforeach
                    
                </ul>
            </div>

            <div class="row">
               
                <span>{{ __('audio.volume_control') }}</span>
                <p class="range-field">
                    <input type="range" id="audio_volume_control" min="0" max="100" />
                </p>
            </div>

            <div class="row">
               <div class="col s6">
                    <span>{{ __('audio.fadeIn') }}</span>
                    <p class="range-field">
                        <input type="range" id="audio_fadeIn" min="0" max="100" />
                    </p>
                </div>
                <div class="col s6">
                
                    <span>{{ __('audio.fadeOut') }}</span>
                    <p class="range-field">
                        <input type="range" id="audio_fadeOut" min="0" max="100" />
                    </p>
                </div>
            </div>

            <div class="row">
                <label>
                    <input type="checkbox" class="filled-in" id="audio_loopable" />
                    <span>{{ __('audio.loopable') }}</span>
                </label>
            </div>

            <div class="row">
                <label>
                    <input type="checkbox" class="filled-in" id="audio_playonce" />
                    <span>{{ __('audio.playonce') }}</span>
                </label>
            </div>
     

            <div class="row">
                <div class="input-field col s6">                         
                    <button class="btn waves-effect waves-light background-primary color-white text-center" type="submit" id="add-audio" name="action">
                        {{ __('app.save') }}
                        <i class="material-icons left">save</i>
                    </button>

                </div>
                <div class="input-field col s6">                         
                    <button class="btn waves-effect waves-light background-secondary color-white text-center" id="cancel-modal">
                        {{ __('app.cancel') }}
                        <i class="material-icons left">cancel</i>
                    </button>

                </div>
               
            </div>
        </form>

    </div>

    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">{{ __('app.cancel') }}</a>
    </div>
</div>
