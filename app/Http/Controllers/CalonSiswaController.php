<?php

namespace App\Http\Controllers;

use App\Models\CalonSiswa;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage as image;



class CalonSiswaController extends Controller
{
    //
    public function show()
    {
        $list_calonSiswa = CalonSiswa::all();
        return view('pendaftaran.calonSiswa', ['list_calonSiswa'=>$list_calonSiswa]);
    }
    
    public function create()
    {
        $objSiswa = new CalonSiswa();

        return view('pendaftaran.form',['calonSiswa' => $objSiswa]);
    }

    public function store(Request $request):RedirectResponse
    {
        
    $request->validate([
        'NISN' => 'required',
        'nama' => 'required',
        'alamat' => 'required',
        'tgl_lahir' => 'required',
        'tmp_lahir' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'asal_sekolah' => 'required',
        'nama_ortu' => 'required',
        'pekerjaan_ortu' => 'required',
        'no_telp_ortu' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
    ]);
    $data = $request->all();

    if ($request->hasFile('foto')) {
        // Simpan file gambar ke storage
        $path = $request->file('foto')->store('public/foto_siswa');
        $data['foto'] = image::url($path); // Menyimpan URL file ke dalam database
    } else {
    // Menghapus 'foto' dari data jika tidak ada file
    unset($data['foto']);
    }
    if (isset($request->id)) {
        $calonSiswa = CalonSiswa::find($request->id);
        $calonSiswa->update($data);
        return redirect()->route('calonSiswa.show')->with('success', 'Data berhasil diubah');
    } else {
        CalonSiswa::create($data);
        return redirect()->route('calonSiswa.show')->with('success', 'Data berhasil ditambah');
    }
    }

    
    
    public function edit($id)
    {
        $objSiswa = CalonSiswa::find($id);
        return view('pendaftaran.form',['calonSiswa' => $objSiswa]);
    }

    public function view($id)
    {

    }

    public function destroy($id) : RedirectResponse
    {
        $CalonSiswa = CalonSiswa::find($id);

        if($CalonSiswa)
        {
            


            $CalonSiswa->delete();
            return redirect()->route('calonSiswa.show')->with('success','Data berhasil dihapus');
        }
        else
        {
            return redirect()->route('calonSiswa.show')->with('error','Data tidak ditemukan');
        }
    }
    
}
