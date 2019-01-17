<!--Audio modal Structure -->
<div id="audio-modal" class="audioPopup box-shadow-inset" style="background-image:url('/svg/wind_addsounds_paint.svg');">
    
    <div class="modal-content" >
        <h4 class="color-primary">{{ __('app.audio_title') }}</h4>
        <form method="POST" id="audio-form">
            {{ csrf_field() }}
            
            <div class="row">      
                <span>{{ __('app.select_audio_file') }}</span>
                <ul class="select-audio-file-list">
                   
                    @foreach($audioFiles as $audioFile)
                        <li>
                            <label>
                                <input type="radio" class="with-gap" name="audioFile" value="{{ $audioFile->id }}" id="audio_file" />
                                <span for="audioFile">{{ $audioFile->name }}</span>
    
                            </label>             
                        </li>
                    @endforeach
                    
                </ul>
            </div>

            <div class="row">
               
                <span>{{ __('app.volume_control') }}</span>
                <p class="range-field">
                    <input type="range" id="audio_volume_control" min="0" max="100" />
                </p>
            </div>

            <div class="row">
               <div class="col s6">
                    <span>{{ __('app.fadeIn') }}</span>
                    <p class="range-field">
                        <input type="range" id="audio_fadeIn" min="0" max="100" />
                    </p>
                </div>
                <div class="col s6">
                
                    <span>{{ __('app.fadeOut') }}</span>
                    <p class="range-field">
                        <input type="range" id="audio_fadeOut" min="0" max="100" />
                    </p>
                </div>
            </div>

            <div class="row">
                <label>
                    <input type="checkbox" class="filled-in" id="audio_loopable" />
                    <span>{{ __('app.loopable') }}</span>
                </label>
            </div>

            <div class="row">
                <label>
                    <input type="checkbox" class="filled-in" id="audio_playonce" />
                    <span>{{ __('app.playonce') }}</span>
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
</div>
