<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index($disposisi_id)
    {
        $transactions = Transaction::where('disposisi_id', $disposisi_id)->get();
        return response()->json($transactions);
    }

    public function store(Request $request, $disposisi_id)
    {
        $request->validate([
            'model_hp' => 'required|string|max:255',
            'tanggal_mulai_rental' => 'required|date',
            'tanggal_akhir_rental' => 'required|date|after:rental_start_date',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $transaction = Transaction::create([
            'disposisi_id' => $disposisi_id,
            'model_hp' => $request->phone_model,
            'tanggal_mulai_rental' => $request->rental_start_date,
            'tanggal_akhir_rental' => $request->rental_end_date,
            'jumlah' => $request->amount,
        ]);

        return response()->json($transaction, 201);
    }
}
