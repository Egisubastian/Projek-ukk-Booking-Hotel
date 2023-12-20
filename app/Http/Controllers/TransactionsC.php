<?php

namespace App\Http\Controllers;
use App\Models\TransactionsM;
use App\Models\ProductsM;
use App\Models\LogM;
use PDF;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TransactionsC extends Controller
{
    public function index()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melihat Halaman Transaksi'
        ]);
        $subtitle = "Daftar Transaksi Produk";
        $vcari = request('search');
        $transactionsM = TransactionsM::select('transactions.*', 'products.nama_produk', 'products.harga_produk', 'transactions.id AS id_trans')->join('products', 'products.id', '=', 'transactions.id_produk')->where('transactions.created_at', 'like', "%$vcari%")->orWhere('transactions.nama_pelanggan', 'like', "%$vcari%")->paginate(10);
        return view('transactions_index', compact('subtitle', 'transactionsM','vcari'));


    }

    public function create()
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Transaksi'
        ]);
        $subtitle = "Tambah Transaksi Produk";
        $productsM = ProductsM::all();
        return view('transactions_create', compact('subtitle', 'productsM'));
    }

    public function store(Request $request)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Tambah Transaksi'
        ]);
        $products = ProductsM::where("id", $request->input('id_produk'))->first();
        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'uang_bayar' => 'required',
        ]);

        $transactions = new TransactionsM;
        $transactions -> nomor_unik = $request->input('nomor_unik');
        $transactions -> nama_pelanggan = $request->input('nama_pelanggan');
        $transactions -> id_produk = $request->input('id_produk');
        $transactions -> uang_bayar = $request->input('uang_bayar');
        $transactions -> uang_kembali = $request->input('uang_bayar') - $products->harga_produk;
        $transactions -> save();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Menghapus Transaksi'
        ]);
        transactionsM::where('id', $id)->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil dihapus');
    }

    public function edit($id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Edit Transaksi'
        ]);
        $subtitle = "Edit Transaksi Produk";
        $transactions = TransactionsM::find($id);
        $productsM = ProductsM::all();
        return view('transactions_edit', compact('subtitle', 'productsM','transactions'));

    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Transaksi'
        ]);
        $products = ProductsM::where("id", $request->input('id_produk'))->first();
        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'uang_bayar' => 'required',
        ]);

        $transactions = TransactionsM::find($id);
        $transactions -> nomor_unik = $request->input('nomor_unik');
        $transactions -> nama_pelanggan = $request->input('nama_pelanggan');
        $transactions -> id_produk = $request->input('id_produk');
        $transactions -> uang_bayar = $request->input('uang_bayar');
        $transactions -> uang_kembali = $request->input('uang_bayar') - $products->harga_produk;
        $transactions -> save();

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbaharui');
    }

    public function pdf(){
        $LogM = LogM::create([

            'id_user' => Auth::user()->id,
            'activity' => 'User Membuat PDF Transaksi'
        ]);
        $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
        ->join('products', 'products.id', '=', 'transactions.id_produk')->get();

        $pdf = PDF::loadview('transactions_pdf',['transactionsM' => $transactionsM]);
        return $pdf->stream('transactions.pdf');
    }

    public function cetak($id){
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk'
        ]);

        $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
        ->join('products', 'products.id', '=', 'transactions.id_produk')->where('transactions.id', $id)->get();
        $pdf = PDF::loadview('transactions_cetak',['transactionsM' => $transactionsM]);
        return $pdf->stream('transactions.cetak');
    }

}
