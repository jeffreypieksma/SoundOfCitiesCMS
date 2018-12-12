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

                            {{-- {{ route('update_collections', ['id' => $collection->id]) }} --}}
                        </tr>
                    @endforeach    
                    
            </body>
        </table>
        <div id="paginate-links">
            {{ $collections->links() }}
        </div>

    </div>
    <a class="btn-floating btn-large waves-effect waves-light green" id="create-collection" href="{{ route('create_collection_form') }}">
        <i class="material-icons">add_circle</i>
    </a>

@endsection

@section('scripts')

    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/admin.js') }}"></script>
@endsection