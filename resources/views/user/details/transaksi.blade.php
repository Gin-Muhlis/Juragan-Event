@extends('user.layouts.main')

@section('style')
    <style>
        .ticket {
            width: clamp(200px, 100%, 680px);
            border-radius: 7px;
            border: 1px solid #dc3545;
            background-color: #ffe7ea;
        }

        .detail-ticket {
            width: 100%;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            flex-direction: column;
            padding: 25px 30px;
            position: relative;
        }

        .name-ticket {
            font-size: 1em;
            font-weight: 500;
            margin-bottom: 25px;
        }

        .time-sale-ticket {
            font-size: 0.9em;
            color: #dc3545;
            margin-bottom: 25px;
        }

        .line {
            width: 100%;
            border: 1px dashed #dc3545;
            margin-bottom: 25px;
        }

        .data-ticket {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .price-ticket {
            font-size: 1em;
            font-weight: 500;
        }

        .quantity {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .quantity button {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            color: #dc3545;
            border: 1px solid #dc3545;
            background-color: #ffe7ea;
            cursor: pointer;
        }

        .quantity-ticket {
            font-size: 1em;
            color: #080808;
            font-weight: 500;
        }

        .detail-ticket::before {
            content: "";
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateX(-50%);
            border: 1px solid #dc3545;
        }

        .detail-ticket::after {
            content: "";
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #fff;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateX(50%);
            border: 1px solid #dc3545;
        }

        .button-refund {
            min-width: 70px;
            min-height: 35px;
        }

        .button-proof {
            min-width: 62px;
            min-height: 38px;
        }

        .spinner-loader {
            width: 15px;
            height: 15px;
        }

        .alert-popup {
            padding: 25px;
            border-top-right-radius: 30px;
            border-bottom-left-radius: 30px;
            color: #fff;
            font-size: 1em;
            position: fixed;
            right: 20px;
            bottom: 20px;
        }

        .success-popup {
            background: #198754;
        }

        .error-popup {
            background: #DC3545;
        }
    </style>
@endsection

@section('container')
    <div class="container my-5">
        {{-- startData --}}
        <div class="row mb-4">
            <div class="col-md-6 p-3">
                <h2 class="mb-3">Data Transaksi</h2>
                <div class="border rounded p-3 shadow">
                    <div
                        class="form-group col-sm-12 mb-3 row flex-lg-row flex-column-reverse justify-content-between align-items-center">
                        <p class="col-lg-6 fw-semibold" style="font-size: 1.1em">{{ $data->user->name }}</p>
                        <p class="col-lg-6 text-lg-end text-start px-lg-0" style="color: var(--text-color);">
                            {{ $data->event->title }}</p>
                    </div>
                    <div class="form-group col-sm-12 mb-3">
                        <p class="d-flex">No. Transaksi : &nbsp;<span>{{ $data->no_transaction }}</span></p>
                    </div>
                    <div class="form-group col-sm-12 mb-3">
                        <p class="d-flex">Tanggal Transaksi : &nbsp;<span>{{ $data->transaction_date }}</span></p>
                    </div>
                    <div class="form-group col-sm-12 mb-3">
                        <p class="d-flex">Total Transaksi :
                            &nbsp;<span>Rp. {{ number_format($data->total_transaction, 0, ',', '.') }}</span></p>
                    </div>

                    <div class="form-group col-sm-12 my-4">
                        <label for="email" class="d-block mb-1">Status :</label>
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
                    </div>
                    @if ($data->status === 'menunggu pembayaran' || $data->status === 'menunggu konfirmasi')
                        <p>Kirim bukti pembayaran :</p>
                        <div class="row">
                            <form method="POST" class="col" enctype="multipart/form-data" id="proof-form">
                                @csrf

                                <div class="rounded w-100 bg-secondary d-flex align-items-center justify-content-center position-relative"
                                    style="height: 200px;" x-data="imageViewer('{{ $data->proof_of_payment ? \Storage::url($data->proof_of_payment) : '' }}')">

                                    <template x-if="imageUrl">
                                        <img lazy="loading" :src="imageUrl"
                                            class="object-cover rounded border border-gray-200 position-absolute left-0 top-0"
                                            style="width: 100%; height: 100%; object-fit: contain;" />
                                    </template>
                                    <input type="hidden" name="transaction_header_id" value="{{ $data->id }}">
                                    <input type="file" class="position-relative" style="z-index: 1;"
                                        name="proof_of_payment" id="proof_of_payment" @change="fileChosen">
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12 d-flex justify-content-end">

                                        <button type="submit"
                                            class="btn btn-danger button-proof d-flex align-items-center justify-content-center">
                                            <div class="spinner-border text-light spinner-loader d-none loader-proof"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                            <span class="text-proof">
                                                Kirim
                                            </span>
                                        </button>
                                    </div>
                                </div>


                            </form>
                        </div>
                    @endif

                    @if (
                        ($data->status === 'menunggu konfirmasi' || $data->status === 'selesai') &&
                            !\Carbon\Carbon::parse($data->event->start_at)->isPast())
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" style="font-size: .9em;">
                                Ajukan pengembalian
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-md-6 p-3">
                <h2 class="mb-3">Tiket Pesanan</h2>
                <div class="row row-cols-1">
                    @foreach ($data->transactionDetails as $detail)
                        <div class="col">
                            <div class="ticket mb-3">
                                <div class="detail-ticket">
                                    <h3 class="name-ticket">
                                        {{ $detail->ticket->name }}
                                    </h3>
                                    <span class="line"></span>
                                    <div class="data-ticket">
                                        <p class="price-ticket">Total : Rp
                                            {{ number_format($detail->total_price, 0, ',', '.') }}</p>
                                        <div class="quantity">
                                            <span>Jumlah : </span>
                                            <div class="quantity-ticket">{{ $detail->quantity }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- enddata --}}
    </div>
    <div class="modal fade refund-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajukan Pengembalian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="form-refund">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="reason" class="form-label">Berikan alasan untuk pengajuan</label>
                            <textarea name="reason" id="reason" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit"
                            class="btn text-light d-flex align-items-center justify-content-center button-refund"
                            style="font-size:   
                            .9em; background-image: var(--primary-color);">
                            <div class="spinner-border text-light spinner-loader d-none loader-refund" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <span class="text-refund">Ajukan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row-alert">

    </div>
@endsection
@section('script')
    {{-- refund --}}
    <script>
        $(document).ready(function() {
            let header = {{ $data->id }}
            $("#form-refund").on("submit", function(e) {
                e.preventDefault();
                $('.loader-refund').removeClass("d-none")
                $(".text-refund").addClass("d-none")

                let reason = $("#reason").val()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })

                $.ajax({
                    url: "/transaction/refund",
                    type: "POST",
                    data: {
                        header_id: header,
                        reason: reason
                    },
                    success: function(response) {
                        $('.loader-refund').addClass("d-none")
                        $(".text-refund").removeClass("d-none")

                        $("#reason").val(null)

                        $(".refund-modal").modal('hide')

                        let markup = `<div class="success-popup alert-popup">
                                        ${response.message}
                                    </div>`
                        $(".row-alert").html(markup)
                        setTimeout(() => {
                            $('.success-popup').fadeOut();
                            location.reload()
                        }, 3000);

                    },
                    error: function(xhr) {
                        $('.loader-refund').addClass("d-none")
                        $(".text-refund").removeClass("d-none")

                        $(".refund-modal").modal('hide')

                        let error = JSON.parse(xhr.responseText)
                        let markup = `<div class="error-popup alert-popup">
                                        ${error.message}
                                    </div>`
                        $(".row-alert").html(markup)
                        setTimeout(() => {
                            $('.error-popup').fadeOut();
                        }, 3000);
                    }
                })
            })
        })
    </script>

    {{-- kirim bukti pembayaran --}}
    <script>
        $(document).ready(function() {
            $("#proof-form").on("submit", function(e) {
                e.preventDefault();

                $(".loader-proof").removeClass("d-none");
                $(".text-proof").addClass("d-none")

                let formData = new FormData(this);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    }
                })

                $.ajax({
                    url: "/transaction/proof",
                    type: "post",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $(".loader-proof").addClass("d-none");
                        $(".text-proof").removeClass("d-none")

                        let markup = `<div class="success-popup alert-popup">
                                        ${response.message}
                                    </div>`
                        $(".row-alert").html(markup)
                        setTimeout(() => {
                            $('.success-popup').fadeOut();
                            location.reload()
                        }, 3000);
                    },
                    error: function(xhr) {
                        $(".loader-proof").addClass("d-none");
                        $(".text-proof").removeClass("d-none")

                        let error = JSON.parse(xhr.responseText)
                        let markup = `<div class="error-popup alert-popup">
                                        ${error.message}
                                    </div>`
                        $(".row-alert").html(markup)
                        setTimeout(() => {
                            $('.error-popup').fadeOut();

                        }, 3000);
                    }
                })
            })
        })
    </script>

    <script>
        /* Simple Alpine Image Viewer */
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageViewer', (src = '') => {
                return {
                    imageUrl: src,

                    refreshUrl() {
                        this.imageUrl = this.$el.getAttribute("image-url")
                    },

                    fileChosen(event) {
                        this.fileToDataUrl(event, src => this.imageUrl = src)
                    },

                    fileToDataUrl(event, callback) {
                        if (!event.target.files.length) return

                        let file = event.target.files[0],
                            reader = new FileReader()

                        reader.readAsDataURL(file)
                        reader.onload = e => callback(e.target.result)
                    },
                }
            })
        })
    </script>
@endsection
