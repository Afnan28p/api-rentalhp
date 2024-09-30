<?php

namespace App\Http\Controllers;

use App\Models\rentals;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rental = rentals::with(['devices', 'users'])->get();
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
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|string|max:50'
        ]);

        // Tentukan harga per hari (misal 100.000)
        $harga_per_hari = 100000;

        // Hitung selisih hari antara tanggal mulai dan tanggal selesai
        $tanggal_mulai = Carbon::parse($request->tanggal_mulai);
        $tanggal_selesai = Carbon::parse($request->tanggal_selesai);
        $jumlah_hari = $tanggal_selesai->diffInDays($tanggal_mulai) + 1; // +1 agar hari pertama dihitung

        // Hitung total harga
        $total_harga = $jumlah_hari * $harga_per_hari;

        // Simpan data ke database
        $rental = new Rental();
        $rental->id = (string) Str::uuid();
        $rental->name = $request->name;
        $rental->user_id = $request->user_id;
        $rental->device_id = $request->device_id;
        $rental->tanggal_mulai = $tanggal_mulai;
        $rental->tanggal_selesai = $tanggal_selesai;
        $rental->total_harga = $total_harga;
        $rental->status = $request->status;
        $rental->save();

        return response()->json(['message' => 'Rental berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(rentals $rentals)
    {
        //
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
    public function update(Request $request, rentals $rentals)
    {
        $validate = $request->validate([
            'name' => 'required|max:50|unique:rentals,name,' . $rental->id,
            'user_id' => 'required|exists:users,id',
            'device_id' => 'required|exists:devices,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'status' => 'required|string|max:50'
        ]);

        $harga_per_hari = 100000;

        $tanggal_mulai = Carbon::parse($request->tanggal_mulai);
        $tanggal_selesai = Carbon::parse($request->tanggal_selesai);
        $jumlah_hari = $tanggal_selesai->diffInDays($tanggal_mulai) + 1;

        $total_harga = $jumlah_hari * $harga_per_hari;

        $rental->name = $request->name;
        $rental->user_id = $request->user_id;
        $rental->device_id = $request->device_id;
        $rental->tanggal_mulai = $tanggal_mulai;
        $rental->tanggal_selesai = $tanggal_selesai;
        $rental->total_harga = $total_harga;
        $rental->status = $request->status;
        $rental->save();

        return response()->json(['message' => 'Rental berhasil diperbarui'], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rentals $rentals)
    {
        $rental->delete();
        return response()->json(['message' => 'Rental berhasil dihapus'], Response::HTTP_OK);
    }
}
