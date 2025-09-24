<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->session()->get('user');
        $transactions = Transaction::where('user_id', $user->id)
        ->orderBy('date', 'desc')
        ->get()
        ->groupBy(function($item){
            return $item->date->format('Y-m-d');
        })

        ->map(function($itemByDate){
            return $itemByDate->groupBy('source');
        });

        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('transactions.create', ['categories' => $categories,]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $user = $request->session()->get('user');

        Transaction::create([
            'user_id' => $user->id,
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'source' => $request->source,
            'date' => $request->date,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //  
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $transaction = Transaction::findOrFail($transaction->id);
        $categories = Category::all();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'type' => 'required|in:pemasukan,pengeluaran',
            'amount' => 'required|numeric',
            'date' => 'required|date',
        ]);

        $transaction->update([
            'type' => $request->type,
            'amount' => $request->amount,
            'description' => $request->description,
            'source' => $request->source,
            'date' => $request->date,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus!');
    }
}
