@extends('mainlayout')

@section('maincontent') 
    <div class="container">
        @auth('admin')
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

        <form method="POST" action="{{ route('admin.updateProfile') }}">
            @csrf
            @method('PATCH') <!-- Use PATCH method for updating records -->
        
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth('admin')->user()->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth('admin')->user()->email) }}" required>
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