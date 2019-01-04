@extends('layouts.admin')

@section('head')
 
@endsection

@section('content')

    <div class="container" id="create_collection_form" >
        <div id="error-wrapper">
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        
        <form method="POST" action="{{ route('create_collection') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="input-field col s6">
                    <input id="collection_title" type="text" name="title" class="validate" value="{{ old('title') }}" required>
                    <label for="collection_title">{{ __('app.collection_title') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="collection_description" type="text" name="description" class="validate" value="{{ old('description') }}">
                    <label for="collection_description">{{ __('app.collection_description') }}</label>
                </div>
            </div>     

             <div class="row">
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <span>{{ __('app.upload_audio_files') }}</span>
                
                        <input type="file" name="audio[]" id="audio-files" multiple required/>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
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


  <a class="btn-floating btn-large waves-effect waves-light background-accent" id="create-collection"><i class="material-icons">add_circle</i></a>

@endsection

@section('scripts')

    <script src="{{ asset('js/admin.js') }}"></script>
    
@endsection