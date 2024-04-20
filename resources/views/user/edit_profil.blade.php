@extends('indexlayout')

@section('indexcontent') 
    <div class="container">
        @auth('web')
        <h2>Edit Profil</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user.updateProfile') }}">
            @csrf
            @method('PATCH') 
        
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth('web')->user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth('web')->user()->email) }}" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="btn-primary">Simpan Perubahan</button>
        </form>
        @endauth
    </div>
@endsection