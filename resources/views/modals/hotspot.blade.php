<!--Hotspot modal Structure -->
<div id="hotspot-modal" class="hotspotPopup popup box-shadow-inset">
    
    <div class="modal-content" >
        <h4 class="color-primary">{{ __('app.hotspot') }}</h4>
        <form method="POST" id="hotspot-form">
            {{ csrf_field() }}

           <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="validate" id="hotspot_title">
                    <label for="hotspot_title" data-error="wrong" data-success="right">{{ __('app.hotspot_title') }}</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <textarea class="materialize-textarea" id="hotspot_history"></textarea>
                    <label for="hotspot_history">{{ __('app.hotspot_history') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea class="materialize-textarea" id="hotspot_music"></textarea>
                    <label for="hotspot_music">{{ __('app.hotspot_music') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea  class="materialize-textarea" id="hotspot_activities"></textarea>
                    <label for="hotspot_activities">{{ __('app.hotspot_activities') }}</label>
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
