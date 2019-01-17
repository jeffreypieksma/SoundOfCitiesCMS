<!--Hotspot modal Structure -->
<div id="hotspot-modal" class="hotspotPopup popup box-shadow-inset">
    
    <div class="modal-content" >
        <h4 class="color-primary">{{ __('app.hotspot') }}</h4>
        <form method="POST" id="hotspot-form">
            {{ csrf_field() }}

           <div class="row">
                <div class="input-field col s12">
                    <input id="title" type="text" class="validate">
                    <label for="title" data-error="wrong" data-success="right">{{ __('app.hotspot_title') }}</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="history" class="materialize-textarea"></textarea>
                    <label for="history">{{ __('app.hotspot_history') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="music" class="materialize-textarea"></textarea>
                    <label for="music">{{ __('app.hotspot_music') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="activities" class="materialize-textarea"></textarea>
                    <label for="activities">{{ __('app.hotspot_activities') }}</label>
                 </div>
            </div>

            <div class="row">
                <div class="input-field col s6">                         
                    <button class="btn waves-effect waves-light background-primary color-white text-center" type="submit" id="add-hotspot">
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
