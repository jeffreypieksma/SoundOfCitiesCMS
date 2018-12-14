@extends('layouts.admin')

@section('head')
 
@endsection

@section('content')

    <div class="container">
        <h3 class="collection-intro">Welcome {{ $user->name }} </h3>

        @if($collections->isEmpty())
            <div id="emptyState">
                <p>{{ __('collection.no_results') }}</p>
                <a href="{{ route('create_collection_form') }}">       
                    <button class="btn waves-effect waves-light" type="submit" name="action">{{ __('collection.create_new_collection') }}
                        <i class="material-icons right">send</i>
                    </button>
                </a>
            </div>

        @else
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
                                <td> <a href="/collection/update/{{ $collection->id }}">Edit</a> </td>

                                {{-- {{ route('update_collections', ['id' => $collection->id]) }} --}}
                            </tr>
                        @endforeach    
                        
                </body>
            </table>
            <div id="paginate-links">
                {{ $collections->links() }}
            </div>
        @endif

    </div>
    <a class="btn-floating btn-large waves-effect waves-light" id="create-collection" href="{{ route('create_collection_form') }}">
        <i class="material-icons">add</i>
    </a>

@endsection

@section('scripts')

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection