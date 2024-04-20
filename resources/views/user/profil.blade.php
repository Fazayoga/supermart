@extends('indexlayout')

@section('indexcontent') 
    <div class="container">    
        <h2>Edit Profil</h2>
        @auth('web')
        <div class="form-group">
            <h3>Nama :</h3>
            <p>{{ auth('web')->user()->name }}</p>
        </div>
        
        <div class="form-group">
            <h3>Email :</h3>
            <p>{{ auth('web')->user()->email }}</p>
        </div>
        @endauth
        <a href="{{ asset ('/edit-user') }}" class="btn btn-primary">Edit Profil</a>
    </div>
@endsection