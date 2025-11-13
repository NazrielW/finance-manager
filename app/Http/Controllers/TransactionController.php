<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\Balance;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Hitung dan update balance user ke tabel balances
     */
    private function updateUserBalance($user_id)
    {
        $income = Transaction::where('user_id', $user_id)
            ->where('type', 'income')
            ->sum('amount');

        $expense = Transaction::where('user_id', $user_id)
            ->where('type', 'expense')
            ->sum('amount');

        $balance = $income - $expense;

        Balance::updateOrCreate(
            ['user_id' => $user_id],
            ['amount' => $balance]
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->session()->get('user');

        $query = Transaction::where('user_id', $user->id)
            ->when($request->filled('start_date'), fn($q) => $q->whereDate('date', '>=', $request->start_date))
            ->when($request->filled('end_date'), fn($q) => $q->whereDate('date', '<=', $request->end_date))
            ->when($request->filled('category_id'), fn($q) => $q->where('category_id', $request->category_id))
            ->when($request->filled('search'), function($q) use ($request) {
                $q->where(function ($q2) use ($request) {
                    $q2->where('source', 'like', "%{$request->search}%")
                       ->orWhere('description', 'like', "%{$request->search}%");
                });
            });

        // Group transaksi
        $transactions = $query->orderBy('date', 'desc')
            ->get()
            ->groupBy(fn($item) => $item->date->format('Y-m-d'))
            ->map(fn($itemByDate) => $itemByDate->groupBy('source'));

        $income = $query->clone()->where('type', 'income')->sum('amount');
        $expense = $query->clone()->where('type', 'expense')->sum('amount');

        $balance = $income - $expense;

        $categories = Category::all();

        return view('transactions.index', compact('transactions', 'categories', 'income', 'expense', 'balance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user = $request->session()->get('user');
        $categories = Category::where('user_id', $user->id)->get();

        return view('transactions.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->session()->get('user');

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'type'        => 'required|in:income,expense',
            'date'        => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
            'source'      => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $validated['user_id'] = $user->id;

        Transaction::create($validated);

        // ✅ Update balance setelah tambah transaksi
        $this->updateUserBalance($user->id);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Transaction $transaction)
    {
        $user = $request->session()->get('user');

        if ($transaction->user_id !== $user->id) {
            abort(403);
        }

        $categories = Category::where('user_id', $user->id)->get();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $user = $request->session()->get('user');

        if ($transaction->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'amount'      => 'required|numeric|min:0',
            'type'        => 'required|in:income,expense',
            'date'        => 'required|date',
            'category_id' => 'nullable|exists:categories,id',
            'source'      => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);

        $transaction->update($validated);

        // ✅ Update balance setelah edit transaksi
        $this->updateUserBalance($user->id);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Transaction $transaction)
    {
        $user = $request->session()->get('user');

        if ($transaction->user_id !== $user->id) {
            abort(403);
        }

        $transaction->delete();

        // ✅ Update balance setelah hapus transaksi
        $this->updateUserBalance($user->id);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
