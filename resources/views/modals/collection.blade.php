<!--Collection modal Structure -->
<div id="collection-modal" class="modal">
    
    <div class="modal-content">
        <h4>{{ __('app.collection_title') }}</h4>
        <form method="POST" action="">
            <div class="row">
                <div class="input-field col s6">
                    <input id="title" type="text" name="title" class="validate">
                    <label for="title">{{ __('collection.title') }}</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="location" type="text" name="location" class="validate">
                    <label for="location">{{ __('collection.location') }}</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="description" type="text" name="description" class="validate">
                    <label for="description">{{ __('collection.description') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">                         
                    <button class="btn waves-effect waves-light" type="submit" onclick="storeCollection();" id="save-collection" name="action">{{ __('app.save') }}
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