@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row card-panel">
        <div class="panel-heading">Alle gebruikers: <span style="font-weight:bold;"> {{$users->count()}}</span></div>

        @if($users->isEmpty())
          <div class="empty-state">
            <i class="fa fa-user-o" aria-hidden="true"></i>
            <span class="no-results">Er zijn nog geen gebruikers toegevoegd</span>
            <a href="{{ route('create_user_form')}}" class="btn btn-primary">Gebruiker Toevoegen</a>
          </div>
        @else
          <div class="action-bar">
            <a href="{{ route('create_user_form')}}" class="btn btn-primary">Gebruiker Toevoegen</a>
          </div>
          <table class="table striped responsive-table highlight" id="dataTable">
            <thead class="">
              <tr><th>Name</th><th>E-mail</th><th>Role<th></tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                <tr>
                  <td><a href="{{ route('update_user_form', ['id' => $user->id])}}">{{$user->name}}</a></td>
                  <td>{{$user->email}}</td>
                  
                  <td>{{$user->is_admin === 1 ? "User" : "Admin" }}</td>
          
                </tr>
              @endforeach
            </tbody>
          </table>  
        @endif
    </div>
  </div>
  <script>
    $(document).ready( function () {

   
      $('#dataTable').DataTable({
        paging: false
      });
              
    });
  </script>
  

@endsection