<?php

namespace App\Http\Controllers\user;

use Exception;
use App\Models\Event;
use App\Models\Refund;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransactionDetail;
use App\Models\TransactionHeaders;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function show(Request $request)
    {
        // return response()->json(['message' => 'test'], 200);
        try {
            if (!Auth::check()) {
                return response()->json(['message' => 'User is Unauthenticated'], 401);
            }

            $user = Auth::user();


            $data = $request->input("dataTransaction");

            if (is_null($data['totalTransaction'])) {
                return response()->json(['message' => 'Silahkan pilih tiket terlebih dahulu'], 422);
            }

            $latestTransaction = TransactionHeaders::where('user_id', $user->id)->latest()->first();
            if ($latestTransaction && $latestTransaction->status === 'menunggu pembayaran') {
                return response()->json(['message' => 'Anda mempunyai transaksi yang belum diselesaikan'], 422);
            }

            $data_transaction_header = [
                'transaction_date' => Carbon::now()->format('Y-m-d'),
                'no_transaction' => uniqid() . mt_rand(1000000000, 9999999999),
                'total_transaction' => intval($data['totalTransaction']),
                'status' => 'menunggu pembayaran',
                'event_id' => intval($data['event_id']),
                'user_id' => $user->id,
                'payment_id' => 2
            ];

            DB::beginTransaction();


            $transactionHeader = TransactionHeaders::create($data_transaction_header);

            foreach ($data['tickets'] as $ticket) {
                $data_transaction_detail = [
                    'quantity' => intval($ticket['inputTicketQuantity']),
                    'unit_price' => intval($ticket['inputTicketUnitPrice']),
                    'total_price' => intval($ticket['inputTicketTotalPrice']),
                    'transaction_headers_id' => $transactionHeader->id,
                    'ticket_id' => intval($ticket['inputTicketId'])
                ];


                TransactionDetail::create($data_transaction_detail);
            }

            DB::commit();

            $dataTransactions = TransactionHeaders::with('transactionDetails')->where('user_id', $user->id)->latest()->get();

            return response()->json(['message' => 'pesanan berhasil dibuat']);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    public function index()
    {
        SEOMeta::setTitle('Transaksi');
        $user = Auth::user();

        $dataTransactions = TransactionHeaders::with('transactionDetails')->where('user_id', $user->id)->latest()->get();

        return view('user.details.daftarTransaksi', [
            'tittle' => 'transaction',
            'dataTransactions' => $dataTransactions
        ]);
    }

    public function detail($no_transaction)
    {
        SEOMeta::setTitle('Transaksi');
        $dataTransactions = TransactionHeaders::with('transactionDetails')->where('no_transaction', $no_transaction)->first();

        return view('user.details.transaksi', [
            'tittle' => ' detail transaction',
            'data' => $dataTransactions
        ]);
    }

    public function proof(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'proof_of_payment' => 'required|image|max:3096'
        ]);

        if ($validate->fails()) {
            return response()->json(['message' => 'Gambar tidak valid. Cek apakah yang anda kirimkan gambar dan ukurannya tidak lebih dari 3mb'], 422);
        }

        $id = $request->input('transaction_header_id');
        $transaction_header = TransactionHeaders::findOrFail($id);

        if ($request->hasFile('proof_of_payment')) {
            $image = $request->file('proof_of_payment')->store('public');
        }

        $transaction_header->update(['proof_of_payment' => $image, 'status' => 'menunggu konfirmasi']);

        return response()->json([
            'message' => 'Bukti pembayaran terkirim! Silahkan menunggu konfirmasi'
        ]);
    }

    public function cancel(Request $request)
    {
        $transaction = TransactionHeaders::findOrFail($request->input('transaksi'));

        $transaction->update(['status' => 'dibatalkan']);

        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan!');
    }

    public function refund(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'reason' => 'required|max:300',
            'header_id' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json([
                'message' => 'Alasan terlalu panjang atau data tidak valid'
            ], 422);
        }

        $isRefundMaked = Refund::where([
            ['transaction_headers_id', $request->input('header_id')],
            ['status', 'menunggu konfirmasi']
        ])->first();

        if ($isRefundMaked) {
            return response()->json(['message' => 'Pengajuan pengembalian masih menunggu konfirmasi, anda tidak bisa membuat pengajuan lagi.'], 422);
        }

        Refund::create([
            'date' => Carbon::now()->format('Y-m-d'),
            'reason' => $request->input('reason'),
            'transaction_headers_id' => $request->input('header_id'),
            'status' => 'menunggu konfirmasi'
        ]);

        $transactionHeader = TransactionHeaders::findOrFail($request->input('header_id'));
        $transactionHeader->update(['status' => 'pengajuan pengembalian']);

        return response()->json([
            'message' => 'Pengajuan berhasil, silahkan tunggu konfirmasi'
        ]);
    }
}
