@extends('layouts.admin')

@section('head')
 
@endsection

@section('content')

    <div id="create_collection_form" class="container collection-wrapper" style="background-image: url({{ asset('svg/wind_layers_paint.svg') }});">
        <div class="row">
            <div class="col m8 offset-m2 s12"> 
                <h3 class="collection-intro">{{ __('app.collection_update') }}</h3>
                <div id="error-wrapper">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
        
                <form method="POST" action="{{ route('update_collections') }}" enctype="multipart/form-data"  class="card">
                    {{ csrf_field() }}
                    
                    <input type="hidden" name="id" value="{{ $collection->id }}" />

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="collection_title" type="text" name="title" class="validate" value="{{ $collection->title}}">
                            <label for="collection_title">{{ __('collection.title') }}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="collection_description" type="text" name="description" class="validate" value="{{ $collection->description }}">
                            <label for="collection_description">{{ __('collection.description') }}</label>
                        </div>
                    </div>
                
                    <ul>
                        @foreach($collection->tracks as $track)
                            <li> {{ $track->name }} </li> 
                        @endforeach

                    </ul>
                    
                    <div class="row">
                        <div class="file-field input-field col s12">
                            <div class="btn color-white background-primary">
                                <span>{{ __('app.upload_audio_files') }}</span>
                        
                                <input type="file" name="audio[]" id="audio-files" multiple/>
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s2">                         
                            <button class="btn waves-effect waves-light color-white background-primary" type="submit" id="store-collection" name="action">{{ __('app.save') }}
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                        <div class="input-field col s3">  
                            <a href="{{ route('collections') }}">
                                <button class="btn waves-effect waves-light background-secondary color-white text-center">                
                                    {{ __('app.cancel') }}
                                    <i class="material-icons left">cancel</i>         
                                </button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection