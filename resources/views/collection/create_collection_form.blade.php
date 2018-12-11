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
                <th>{{ __('app.view') }}</th>
                <th>{{ __('app.edit') }}</th>
            </tr>
            </thead>

            <tbody>   
                    @foreach ( $collections as $collection )
                        <tr>
                            <td>  <a href="/dashboard/{{$collection->id}}"> {{ $collection->title }}</a> </td>
                            <td> {{ $collection->created_at}} </td>
                            <td> <a href="/dashboard/{{ $collection->id }}">View</a> </td>
                            <td> <a href="/dashboard/edit/{{ $collection->id }}">Edit</a> </td>
                        </tr>
                    @endforeach    
                    
            </body>
        </table>
        <div id="paginate-links">
            {{ $collections->links() }}
        </div>

    </div>
    <div class="container" id="create_collection_form" >
        <form method="POST" action="{{ route('create_collection') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- <meta name="csrf" value="{{ csrf_token() }}"> --}}
            <div class="row">
                <div class="input-field col s6">
                    <input id="collection_title" type="text" name="title" class="validate">
                    <label for="collection_title">{{ __('collection.title') }}</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="collection_description" type="text" name="description" class="validate">
                    <label for="collection_description">{{ __('collection.description') }}</label>
                </div>
            </div>     

             <div class="row">
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <span>Upload multiple audio files</span>
                
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

            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

        </form>
    </div>


  <a class="btn-floating btn-large waves-effect waves-light green" id="create-collection"><i class="material-icons">add_circle</i></a>

@endsection

@section('scripts')

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection