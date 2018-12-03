<!--Collection modal Structure -->
<div id="collection-modal" class="modal">
    
    <div class="modal-content">
        <h4>{{ __('app.collection_title') }}</h4>
        <form method="POST">
            <div class="row">
                <div class="input-field col s6">
                    <input id="collection_title" type="text" name="collection_title" class="validate">
                    <label for="collection_title">{{ __('collection.title') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="collection_description" type="text" name="collection_description" class="validate">
                    <label for="collection_description">{{ __('collection.description') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">                         
                    <button class="btn waves-effect waves-light" type="submit" id="store-collection" name="action">{{ __('app.save') }}
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