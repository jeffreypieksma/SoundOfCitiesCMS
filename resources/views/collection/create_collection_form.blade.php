@extends('layouts.admin')

@section('head')
 


@endsection

@section('content')

    <div class="container">
        <h3 class="collection-intro">Welcome {{ $user->name }} </h3>

        <table>
            <thead>
            <tr>
                <th>{{ __('collection.title') }}</th>
                <th>{{ __('app.created_at') }}</th>
                <th>{{ __('app.updated_at') }}</th>
            </tr>
            </thead>

            <tbody>   
                    @foreach ( $collections as $collection )
                        <tr>
                            <td> #{{ $collection->id }} {{ $collection->title }} </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                    @endforeach    
            </body>
        </table>
    </div>
    <div class="container" id="create_collection_form" >
        <form method="POST" action="{{ route('create_collection') }}">
            {{ csrf_field() }}
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

           

             {{-- <div class="row">
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <span>Audio file: </span>
                
                        <input type="file" name="audioFile[]" id="audio-file" multiple/>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text">
                    </div>
                </div>
            </div> --}}

             <div class="row">
                <div class="input-field col s6">                         
                    <button class="btn waves-effect waves-light" type="submit" id="store-collection" name="action">{{ __('app.save') }}
                        <i class="material-icons right">send</i>
                    </button>

                </div>
            </div>

        </form>
    </div>

@endsection

@section('scripts')

<script src="{{ asset('js/app.js') }}"></script>

@endsection