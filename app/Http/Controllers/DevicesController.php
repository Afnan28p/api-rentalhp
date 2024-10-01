<?php

namespace App\Http\Controllers;

use App\Models\devices;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $devices = devices::all();
        $data['message'] = true;
        $data['result'] = $devices;
        return response()->json($data, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nama' => 'required|unique:devices',
            'merek_device' => 'required',
            'tipe_device'=> 'required',
            'harga_sewa_per_hari'=> 'required',
            'stock'=> 'required',
            'status'=> 'required',
        ]);

        $result = devices::create($validate);//simpan ke tabel fakultas
        if ($result) {
            $data['success'] = true;
            $data['message'] = 'Data HP Berhasil Disimpan';
            $data['result'] = $result;
            return response()->json($data, Response::HTTP_CREATED);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(devices $devices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(devices $devices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $validate = $request->validate([
            'nama' => 'required',
            'merek_device' => 'required',
            'tipe_device'=> 'required',
            'harga_sewa_per_hari'=> 'required|numeric',
            'stock'=> 'required|numeric',
            'status'=> 'required',
        ]);

        $result = devices::where('id', $id)->update($validate);
        if ($result) {
            $data['success'] = true;
            $data['message'] = 'Data HP Berhasil Diupdate';
            $data['result'] = $result;
            return response()->json($data, Response::HTTP_OK);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $devices = devices::find($id);
        if($devices){
            $devices->delete();
            $data['success'] = true;
            $data['message'] = 'Data HP Berhasil Dihapus';
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['message'] = 'Data HP Tidak Ada';
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}
