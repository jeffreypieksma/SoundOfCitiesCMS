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
        
        <form method="POST" action="{{ route('update_collections') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            
            <input type="hidden" name="id" value="{{ $collection->id }}" />

            <div class="row">
                <div class="input-field col s6">
                    <input id="collection_title" type="text" name="title" class="validate" value="{{ $collection->title}}">
                    <label for="collection_title">{{ __('collection.title') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
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
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <span>{{ __('app.upload_audio_files') }}</span>
                
                        <input type="file" name="audio[]" id="audio-files" multiple/>
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


  <a class="btn-floating btn-large waves-effect waves-light green" id="create-collection"><i class="material-icons">add_circle</i></a>

@endsection

@section('scripts')

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection