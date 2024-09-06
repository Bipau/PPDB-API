<x-layout>
    
    @isset($calonSiswa->id)
        <x-slot name="title">Edit Data Calon Siswa</x-slot>
    @else
        <x-slot name="title">Tambah Data Calon Siswa</x-slot>
    @endisset
    
    <x-slot name="card_title"> Form Siswa</x-slot>
    <form method="POST" action="{{ route('calonSiswa.store') }}" enctype="multipart/form-data">
        @csrf
       
        <div class="mb-3">
            <a href="{{ route('calonSiswa.show') }}">
                <button type="button" class="btn btn-secondary">Back</button>
            </a>
        </div>
        

        <div class="mb-3">
            <label for="NISN" class="form-label">NISN</label>
            <input type="text" class="form-control" id="NISN" name="NISN"
            value="{{ $calonSiswa->NISN }}" required>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" 
            value="{{ $calonSiswa->nama }}" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" 
            value="{{ $calonSiswa->alamat }}"></input>
        </div>
        <div class="mb-3">
            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" max="{{ date('Y-m-d') }}"
            value="{{ $calonSiswa->tgl_lahir }}" required>
        </div>
        <div class="mb-3">
            <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
            <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir" 
            value="{{ $calonSiswa->tmp_lahir }}" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label> <br>
            <input type="radio" class="form-check-input" name="jenis_kelamin" value="L" @if($calonSiswa->jenis_kelamin == 'L') checked @endif> Laki-laki
            <input type="radio" class="form-check-label" name="jenis_kelamin" value="P" @if($calonSiswa->jenis_kelamin == 'P') checked @endif> Perempuan
        </div>
        <div class="mb-3">
            <label for="agama" class="form-label">Agama</label>
            <input type="text" class="form-control" id="agama" name="agama" value="{{ $calonSiswa->agama }}" required>
        </div>
        <div class="mb-3">
            <label for="asal_sekolah" class="form-label">Asal Sekolah</label>
            <input type="text" class="form-control" id="asal_sekolah" name="asal_sekolah" 
            value="{{ $calonSiswa->asal_sekolah }}" required>
        </div>
        <div class="mb-3">
            <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
            <input type="text" class="form-control" id="nama_ortu" name="nama_ortu" 
            value="{{ $calonSiswa->nama_ortu }}" required>
        </div>
        <div class="mb-3">
            <label for="pekerjaan_ortu" class="form-label">Pekerjaan Orang Tua</label>
            <input type="text" class="form-control" id="pekerjaan_ortu" name="pekerjaan_ortu" 
            value="{{ $calonSiswa->pekerjaan_ortu }}" required>
        </div>
        <div class="mb-3">
            <label for="no_telp_ortu" class="form-label">Nomor Telepon Orang Tua</label>
            <input type="text" class="form-control" id="no_telp_ortu" name="no_telp_ortu"
            value="{{ $calonSiswa->no_telp_ortu }}" required>
        </div>
       <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        @if(isset($calonSiswa->foto))
            <div class="mb-2">
                <img src="{{ asset($calonSiswa->foto) }}" alt="Foto calonSiswa" class="img-fluid" style="max-width: 150px;">
            </div>
        @endif
        <input type="file" class="form-control" id="foto" name="foto">
    </div>
        <div class="d-flex justify-content-end mt-4"> 
            @if(isset($calonSiswa))
                <input type="hidden" value="{{ $calonSiswa->id }}" name="id">
            @endif
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
      
    </form>
</x-layout>
