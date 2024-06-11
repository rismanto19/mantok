@extends('layout.main')

@section('title','Mahasiswa')

@section('content')
<div class="row">
    {{-- formulir tambah mahasiswa --}}
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Ubah Mahasiswa</h4>
            <p class="card-description">
              Formulir Ubah Mahasiswa
            </p>
            <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa['id']) }}" 
            class ="forms-sample" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nama">NPM</label>
                <input type="text" class="form-control" name="npm" value="{{ old('npm') ? old('npm') : $mahasiswa["npm"] }}" placeholder="Npm">
                @Error('npm')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="nama">Nama Mahasiswa</label>
                <input type="text" class="form-control" name="nama" value="{{ old('nama') ? old('nama_mahasiswa') : $mahasiswa["nama_mahasiswa"] }}" placeholder="Nama mahasiswa">
                @Error('nama')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="nama">Tempat lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') ? old('tempat_lahir') : $mahasiswa["tempat_lahir"] }}" placeholder="tempat_lahir">
                @Error('tempat_lahir')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="date">Tanggal lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : $mahasiswa["tanggal_lahir"] }}" placeholder="tanggal_lahir">
                @Error('tanggal_lahir')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="nama">Alamat</label>
                <input type="text" class="form-control" name="alamat" value="{{ old('alamat') ? old('alamat') : $mahasiswa["alamat"] }}" placeholder="alamat">
                @Error('alamat')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
            <div class="form-group">
              <label for="prodi_id">Prodi</label>
              <select name="prodi_id" id="prodi_id" class="form-control">
                @foreach ($prodi as $item)
                  <option value="{{ $item['id'] }}" {{ (old('prodi_id') == $item['id']) ? "selected" : ($mahasiswa["prodi_id"] == $item[
                    'id'] ? "selected" : null ) }}>
                    {{ $item['nama']}}
                  </option>
                @endforeach
              </select>
              @Error('prodi_id')
                <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
              <div class="form-group">
                <label for="url_foto">Url Foto</label>
                <input type="file" class="form-control" name="url_foto">
                @Error('url_foto')
                    <span class="text-danger">{{$message}}</span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="{{ url('mahasiswa')}}" class="btn btn-light">Batal</a>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection