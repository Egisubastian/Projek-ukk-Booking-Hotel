<?php

namespace App\Http\Controllers;

use App\Models\TransactionsM;
use App\Models\ProductsM;
use App\Models\LogM;
use Illuminate\Support\Carbon;
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
        $transactionsM = TransactionsM::select('transactions.*', 'products.nama_produk', 'products.harga_produk', 'transactions.id AS id_trans')
        ->join('products', 'products.id', '=', 'transactions.id_produk')
        ->where(function ($query) use ($vcari) {
            $query->whereDate('transactions.tanggal_checkin', '=', $vcari) // Sesuaikan format sesuai kebutuhan
                  ->orWhere('transactions.nama_pelanggan', 'like', "%$vcari%")
                  ->orWhere('products.nama_produk', 'like', "%$vcari%");
        })
        ->paginate(10);
    
    return view('transaksi.transactions_index', compact('subtitle', 'transactionsM', 'vcari'));
    
    }

    
    public function create()
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Berada Di Halaman Tambah Transaksi'
        ]);

        $subtitle = "Tambah Transaksi Produk";
    $productsM = ProductsM::where('status', 'available')->get(); 
    return view('transaksi.transactions_create', compact('subtitle', 'productsM'));
}

    public function store(Request $request)
{
    $LogM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => 'User Melakukan Proses Tambah Transaksi'
    ]);

    $request->validate([
        'nomor_unik' => 'required',
        'nama_pelanggan' => 'required',
        'id_produk' => 'required',
        'fasilitas' => 'required',
        'uang_bayar' => 'required',
        'jumlah_hari' => 'required|integer|min:1',
        'tanggal_checkout' => 'required',
    ]);

    // Temukan produk berdasarkan ID
    $product = ProductsM::find($request->input('id_produk'));

    // Pengecekan status produk
    if ($product->status !== 'available') {
        return redirect()->back()->with('error', 'Produk tidak tersedia untuk transaksi.');
    }

    // Hitung total harga berdasarkan harga produk dan jumlah hari
    $totalHarga = $product->harga_produk * $request->input('jumlah_hari');

    // Simpan transaksi
    $transaction = new TransactionsM;
    $transaction->nomor_unik = $request->input('nomor_unik');
    $transaction->nama_pelanggan = $request->input('nama_pelanggan');
    $transaction->id_produk = $request->input('id_produk');
    $transaction->fasilitas = $request->input('fasilitas');
    $transaction->uang_bayar = $request->input('uang_bayar');
    $transaction->uang_kembali = $request->input('uang_bayar') - $totalHarga;
    $transaction->jumlah_hari = $request->input('jumlah_hari');
    $transaction->total_harga = $totalHarga;
    $transaction->tanggal_checkin = $request->input('tanggal_checkin');
    $transaction->tanggal_checkout = $request->input('tanggal_checkout');
    $transaction->save();

    // Set status produk menjadi "booked"
    $product->status = 'booked';
    $product->save();

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
        $productsM = ProductsM::where('status', 'available')->get();
    
        return view('transaksi.transactions_edit', compact('subtitle', 'transactions', 'productsM'));
    }

    public function update(Request $request, $id)
    {
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Melakukan Proses Edit Transaksi'
        ]);
    
        $request->validate([
            'nomor_unik' => 'required',
            'nama_pelanggan' => 'required',
            'id_produk' => 'required',
            'fasilitas' => 'required',
            'uang_bayar' => 'required',
            'jumlah_hari' => 'required|integer|min:1',
            'tanggal_checkin' => 'required',
            'tanggal_checkout' => 'required',
        ]);
    
        $transactions = TransactionsM::find($id);
    
        // Get the ID of the previously selected room
        $previousRoomId = $transactions->id_produk;
    
        $product = ProductsM::find($request->input('id_produk'));
    
        if (!$product) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }
    
        // Jika produk yang dipilih di form edit tidak sama dengan produk yang sudah ada dalam transaksi
        if ($request->input('id_produk') != $previousRoomId) {
            // Update the status of the previous room to "available"
            $previousRoom = ProductsM::find($previousRoomId);
            if ($previousRoom) {
                $previousRoom->status = 'available';
                $previousRoom->save();
            }
    
            // Update the status of the newly selected room to "booked"
            $product->status = 'booked';
            $product->save();
        }
    
        $hargaPerHari = $product->harga_produk;
        $jumlahHari = $request->input('jumlah_hari');
        $totalHarga = $hargaPerHari * $jumlahHari;
    
        $transactions->nomor_unik = $request->input('nomor_unik');
        $transactions->nama_pelanggan = $request->input('nama_pelanggan');
        $transactions->id_produk = $request->input('id_produk');
        $transactions->fasilitas = $request->input('fasilitas');
        $transactions->uang_bayar = $request->input('uang_bayar');
        $transactions->tanggal_checkin = $request->input('tanggal_checkin');
        $transactions->tanggal_checkout = $request->input('tanggal_checkout');
        $transactions->uang_kembali = $request->input('uang_bayar') - $totalHarga;
        $transactions->jumlah_hari = $jumlahHari;
        $transactions->total_harga = $totalHarga;
        $transactions->save();
    
        if (!is_numeric($hargaPerHari) || !is_numeric($jumlahHari)) {
            return redirect()->back()->with('error', 'Harga per hari atau jumlah hari tidak valid');
        }
    
        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil diperbaharui');
    }
    


    public function pdfFilter(Request $request) 
    { 
        $LogM = LogM::create([ 
            'id_user' => Auth::user()->id, 
            'activity' => 'User Membuat Laporan Transaksi' 
        ]); 
 
        // Ambil tanggal awal dan akhir dari request 
        $startDate = $request->input('start_date'); 
        $endDate = $request->input('end_date'); 
 
        // Jika kedua tanggal kosong, atur tanggal dari transaksi terakhir dan terbaru 
        if (empty($startDate) && empty($endDate)) { 
            $lastTransaction = TransactionsM::orderBy('tanggal_checkin', 'asc')->first(); 
 
            // Periksa apakah ada data transaksi 
            if ($lastTransaction) { 
                $startDate = $lastTransaction->	tanggal_checkin->format('Y-m-d'); 
            } else { 
                // Atur tanggal default jika tidak ada transaksi 
                $startDate = now()->format('Y-m-d'); 
            } 
 
            $endDate = now()->format('Y-m-d'); 
        } 
 
        // Query untuk mengambil data transaksi berdasarkan rentang tanggal 
        $transactionsM = TransactionsM::select('transactions.*', 'products.nama_produk', 'products.harga_produk', 'transactions.id AS id_trans') 
            ->join('products', 'products.id', '=', 'transactions.id_produk') 
            ->whereBetween('transactions.tanggal_checkin', [$startDate, $endDate . ' 23:59:59'])
            ->get(); 
 
        // Load view dan buat PDF 
        $pdf = PDF::loadview('transaksi.transactions_pdf', ['transactionsM' => $transactionsM]); 
 
        // Kembalikan response PDF 
        return $pdf->stream('transactions.pdf'); 
    }

    public function cetak($id){
        $LogM = LogM::create([
            'id_user' => Auth::user()->id,
            'activity' => 'User Mencetak Struk'
        ]);

        $transactionsM = TransactionsM::select('transactions.*', 'products.*', 'transactions.id AS id_trans')
        ->join('products', 'products.id', '=', 'transactions.id_produk')->where('transactions.id', $id)->get();
        $pdf = PDF::loadview('transaksi.transactions_cetak',['transactionsM' => $transactionsM]);
        return $pdf->stream('transactions.pdf');
    }

    public function checkout($id)
{
    // Create a log entry for the check-out process
    $logMessage = 'User Melakukan Proses Check Out Transaksi ID: ' . $id;
    $logM = LogM::create([
        'id_user' => Auth::user()->id,
        'activity' => $logMessage
    ]);

    // Temukan transaksi berdasarkan ID
    $transaction = TransactionsM::find($id);

    // Check if it's not yet time for checkout
    if (now() < \Carbon\Carbon::parse($transaction->tanggal_checkout)) {
        return redirect()->route('transactions.index')->with('error', 'Belum saatnya untuk Check Out. Tunggu hingga tanggal checkout tiba.');
    }

    // Check if the payment is not sufficient
    if ($transaction->uang_bayar < $transaction->harga_produk) {
        return redirect()->route('transactions.index')->with('error', 'Uang bayar tidak mencukupi. Silakan tuntaskan pembayaran sebelum melakukan Check Out.');
    }

    // Set status check out transaksi menjadi true
    $transaction->checkout_status = true;
    $transaction->save();

    // Temukan produk terkait transaksi
    $product = ProductsM::find($transaction->id_produk);

    // Set status produk kembali menjadi "available"
    $product->status = 'available';
    $product->save();

    return redirect()->route('transactions.index')->with('success', 'Check out berhasil dilakukan');
}

    

}

