<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class FakultasController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();
        return response()->json($fakultas, Response::HTTP_OK);


        // $response['success'] = true;
        // $response['message'] = 'Fakultas ditemukan.';
        // $response['data'] = $fakultas;
        // return response()->json($response, Response::HTTP_OK);
        // atau
        // return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:fakultas',
            'singkatan' => 'required|max:4'
        ]);

        $fakultas = Fakultas::create($validate);
        if($fakultas){
            $response['success'] = true;
            $response['message'] = 'Fakultas berhasil ditambahkan.';
            return response()->json($response, Response::HTTP_CREATED);
        }
    }
}

