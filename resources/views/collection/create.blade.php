@extends('layouts.admin')

@section('head')
 
@endsection

@section('content')

    <div id="create_collection_form" class="container collection-wrapper" style="background-image: url({{ asset('svg/wind_layers_paint.svg') }});">
        <div class="row">
            <div class="col m12 s12"> 
                <h3 class="collection-intro">{{ __('app.collection_create') }}</h3>
                <div id="error-wrapper">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="color-warning">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            
                <form method="POST" action="{{ route('create_collection') }}" enctype="multipart/form-data" class="card">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="collection_title" type="text" name="title" class="validate" value="{{ old('title') }}" required>
                            <label for="collection_title">{{ __('app.collection_title') }}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="collection_description" type="text" name="description" class="validate" value="{{ old('description') }}">
                            <label for="collection_description">{{ __('app.collection_description') }}</label>
                        </div>
                    </div>     

                    <div class="row">
                        <div class="file-field input-field col s12 ">
                            <div class="btn color-white background-primary" >
                                <span>{{ __('app.upload_audio_files') }}</span>
                        
                                <input type="file" name="audio[]" id="audio-files" multiple required/>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                     <div class="input-field col m3 s6">  
                            <a href="{{ route('collections') }}">
                                <button class="btn waves-effect waves-light background-primary color-white text-center">                
                                    {{ __('app.cancel') }}
                                    <i class="material-icons left">cancel</i>         
                                </button>
                            </a>
                        </div>

                        <div class="input-field col m3 s6">                         
                            <button class="btn waves-effect waves-light color-white background-secondary" type="submit" id="store-collection" name="action">
                                <i class="material-icons left">send</i>
                                {{ __('app.save') }}
                                
                            </button>

                        </div>

                    </div>
                </form>     
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('js/admin.js') }}"></script>
    
@endsection