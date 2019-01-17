@extends('layouts.admin')

@section('head')
 
@endsection

@section('content')
    <div class="container">
        <h3 class="collection-intro">{{ __('app.welcome') }} {{ $user->name }} </h3>
        <div class="row">
            <div class="col m12 s12"> 
                <div class="collection-index card" style="background-image: url({{ asset('svg/wind_locations_paint.svg') }});">
            
                    @if($collections->isEmpty())
                        <div id="emptyState">
                            <p>{{ __('app.collection_no_results') }}</p>
                            <a href="{{ route('create_collection_form') }}">       
                                <button class="btn waves-effect waves-light" type="submit" name="action">{{ __('app.create_new_collection') }}
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
                                <th>{{ __('app.export') }}</th>
                            </tr>
                            </thead>

                            <tbody>   
                                    @foreach ( $collections as $collection )
                                        <tr>
                                            <td>  <a href="/dashboard/{{$collection->id}}"> {{ $collection->title }}</a> </td>
                                            <td> {{ $collection->created_at}} </td>
                                            <td> <a href="/dashboard/{{ $collection->id }}">{{ __('app.view') }}</a> </td>
                                            <td> <a href="/collection/update/{{ $collection->id }}">{{ __('app.edit') }}</a> </td>
                                            <td> <a href="/collection/export/{{ $collection->id }}">{{ __('app.export') }}</a> </td>
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
            </div>
        </div>
    </div>
    <a class="btn-floating btn-large waves-effect waves-light background-accent" id="create-collection" href="{{ route('create_collection_form') }}">
        <i class="material-icons">add</i>
    </a>

@endsection

@section('scripts')

    <script src="{{ asset('js/admin.js') }}"></script>
    
@endsection