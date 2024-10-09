@extends('user.layouts.main')

@section('container')
    <div class="container mt-5" style="margin-block-end: 10%;">
        <div class="row">

            @if (count($dataTransactions) > 0)
                @foreach ($dataTransactions as $data)
                    <div class="col-md-6 mb-4">
                        <div class="border shadow">
                            <div class="border-bottom p-3" style="background-image: var(--primary-color);">
                                <span class="fs-6 fw-semibold text-light">{{ $data->no_transaction }}</span>
                            </div>
                            <div class="p-3">
                                <div class="border-bottom mb-2">
                                    <p>Tanggal Transaksi : <span class="fw-semibold">{{ $data->transaction_date }}</span>
                                    </p>
                                    <p>Total Transaksi : <span class="fw-semibold">Rp.
                                            {{ number_format($data->total_transaction, 0, ',', '.') }}</span></p>
                                </div>
                                <div class="w-100 d-flex align-items-center justify-content-between">
                                    @if ($data->status === 'menunggu pembayaran')
                                        <span class="badge text-bg-secondary py-2">{{ $data->status }}</span>
                                    @endif
                                    @if ($data->status === 'menunggu konfirmasi')
                                        <span class="badge text-bg-primary py-2">{{ $data->status }}</span>
                                    @endif
                                    @if ($data->status === 'selesai')
                                        <span class="badge text-bg-success py-2">{{ $data->status }}</span>
                                    @endif
                                    @if ($data->status === 'dibatalkan')
                                        <span class="badge text-bg-danger py-2">{{ $data->status }}</span>
                                    @endif
                                    @if ($data->status === 'pengajuan pengembalian')
                                        <span class="badge text-bg-warning py-2">{{ $data->status }}</span>
                                    @endif
                                    @if ($data->status === 'pengajuan pengembalian disetujui')
                                        <span class="badge text-bg-info py-2">{{ $data->status }}</span>
                                    @endif
                                    @if ($data->status === 'pengajuan pengembalian ditolak')
                                        <span class="badge text-bg-dark py-2">{{ $data->status }}</span>
                                    @endif
                                    <div class="d-flex align-items-center gap-2">
                                        @if ($data->status === 'menunggu pembayaran')
                                            <button type="button" class="btn btn-danger cancel-btn" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal" data-id="{{ $data->id }}"
                                                style="font-size: .9em;">
                                                Batalkan
                                            </button>
                                        @endif
                                        <a href="{{ route('transaction.detail', $data->no_transaction) }}"
                                            class="btn text-light"
                                            style="font-size:   
                            .9em; background-image: var(--primary-color);">
                                            Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="row my-5">
                    <div class="alert alert-info" role="alert">
                        Anda belum memiliki trasaksi. Silahkan lakukan transaksi untuk melihat daftar transaksi yang anda
                        buat
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Batalkan Transaksi</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah anda yakin ingin membatalkan transaksi?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger run-cancel">
                        <div class="spinner-border text-light d-none spinner-cancel" role="status"
                            style="width: 18px; height: 18px;">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                        <span class="text-cancel-btn">Iya, saya yakin</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ route('transaction.cancel') }}" method="POST" id="cancel-form-transaction">
        @csrf
        @method('put')
        <input type="hidden" name="transaksi" id="input-transaksi">
    </form>
    @if (session()->has('success'))
        @component('components.user.success', ['message' => session('success')])
        @endcomponent
    @endif
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            let buttonsCancel = Array.from($(".cancel-btn"))
            let cancelTransaction = $(".run-cancel")

            buttonsCancel.forEach(button => {
                $(button).on("click", function() {
                    $("#input-transaksi").val($(this).attr("data-id"))
                })
            })

            $(cancelTransaction).on('click', function() {
                $(".spinner-cancel").removeClass("d-none")
                $(".text-cancel-btn").addClass("d-none")
                $("#cancel-form-transaction").submit()
            })
        })
    </script>
@endsection
