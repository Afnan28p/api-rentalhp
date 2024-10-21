<?php

namespace App\Http\Controllers;

use App\Models\rentals;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rental = rentals::with('devices')->get();
        $data['message'] = true;
        $data['result'] = $rental;
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
            'name' => 'required|unique:rentals|max:50',
            'device_id' => 'required|exists:devices,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'total_harga' => 'required',
            'status' => 'required|string|max:50'
        ]);

        $result = rentals::create($validate);//simpan ke tabel rentals
        if ($result) {
            $data['success'] = true;
            $data['message'] = 'Data Rental Berhasil Disimpan';
            $data['result'] = $result;
            return response()->json($data, Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(rentals $rentals)
    {
        $rental = rentals::with('devices')->find($rentals);
        if ($rentals) {
            $data['success'] = true;
            $data['message'] = "Data rental berhasil ditemukan";
            $data['result'] = $rentals;
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['message'] = "Data rental tidak ditemukan";
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(rentals $rentals)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required|max:50|unique:rentals,name',
            'device_id' => 'required|exists:devices,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'total_harga' => 'required',
            'status' => 'required|string|max:50'
        ]);

        $result = rentals::where('id', $id)->update($validate);
        if ($result) {
            $data['success'] = true;
            $data['message'] = 'Data Rental Berhasil Diupdate';
            $data['result'] = $result;
            return response()->json($data, Response::HTTP_OK);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $devices = rentals::find($id);
        if($devices){
            $devices->delete();
            $data['success'] = true;
            $data['message'] = 'Data Rental Berhasil Dihapus';
            return response()->json($data, Response::HTTP_OK);
        } else {
            $data['success'] = false;
            $data['message'] = 'Data Rental Tidak Ada';
            return response()->json($data, Response::HTTP_NOT_FOUND);
        }
    }
}
