<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.index')
                ->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all();
        return view('mahasiswa.create')->with('prodi',$prodi);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        // return $request;

        $val = $request->validate([
            'npm' => "required|max:10", 
            'nama' => "required",
            'tempat_lahir' => "required", 
            'tanggal_lahir' => "required", 
            'alamat' => "required", 
            'prodi_id' => "required",
            'url_foto' => "required|file|mimes:png,jpg|max:5000"
        ]);

        // ekstensi file yang di upload
        $ext = $request->url_foto->getClientOriginalExtension();
        // rename misal : npm.extensi 2226240152.png
        $val['url_foto'] = $request->npm.".".$ext;
        //upload ke dalam folder public/foto
        $request->url_foto->move('foto', $val['url_foto']);

        // simpan tabel fakultas
        Mahasiswa::create($val);

        // // radirect ke halaman list fakultas
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'], 'berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        $prodi = Prodi::all();
        return view('mahasiswa.edit')
                ->with('prodi', $prodi)
                ->with('mahasiswa',$mahasiswa);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        // dd($request)
        if($request->url_foto) { //jika ada file foto yang dilampirkan
            $val = $request->validate([
                // 'npm' => "required|max:10", 
                'nama' => "required",
                'tempat_lahir' => "required", 
                'tanggal_lahir' => "required", 
                'alamat' => "required", 
                'prodi_id' => "required",
                'url_foto' => "required|file|mimes:png,jpg|max:5000"
            ]);

            $ext = $request->url_foto->getClientOriginalExtension();
            // rename misal : npm.extensi 2226240152.png
            $val['url_foto'] = $request->npm.".".$ext;
            //upload ke dalam folder public/foto
            $request->url_foto->move('foto', $val['url_foto']);

        } else {
            $val = $request->validate([
                // 'npm' => "required|max:10", 
                'nama' => "required",
                'tempat_lahir' => "required", 
                'tanggal_lahir' => "required", 
                'alamat' => "required", 
                'prodi_id' => "required",
                // 'url_foto' => "required|file|mimes:png,jpg|max:5000"
            ]);
       
        }

        // simpan tabel fakultas
        Mahasiswa::where('id', $mahasiswa['id'])->update($val);

        // // radirect ke halaman list fakultas
        return redirect()->route('mahasiswa.index')->with('success', $val['nama'], 'berhasil diubah');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        File::delete('foto/'. $mahasiswa['url_foto']);
        $mahasiswa->delete(); //hapus data mahasiswa
        return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus.');
    }
}
