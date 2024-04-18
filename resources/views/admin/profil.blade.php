@extends('mainlayout')

@section('maincontent') 
    <div class="container">    
        <h2>Edit Profil</h2>
        @auth('admin')
        <div class="form-group">
            <h3>Nama :</h3>
            <p>{{ auth('admin')->user()->name }}</p>
        </div>
        
        <div class="form-group">
            <h3>Email :</h3>
            <p>{{ auth('admin')->user()->email }}</p>
        </div>
        @endauth
    </div>
    <a href="{{ asset ('/edit-admin') }}" class="btn btn-primary">Edit Profil</a>
@endsection