@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.refunds.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr class="text-light"
                                style="background-image: radial-gradient(circle farthest-corner at 10.2% 55.8%, rgba(252, 37, 103, 1) 0%, rgba(250, 38, 151, 1) 46.2%, rgba(186, 8, 181, 1) 90.1%);">
                                <th class="text-left">
                                    @lang('crud.refunds.inputs.date')
                                </th>
                                <th class="text-left">
                                    @lang('crud.refunds.inputs.reason')
                                </th>
                                <th class="text-left">
                                    @lang('crud.refunds.inputs.transaction_headers_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.refunds.inputs.status')
                                </th>
                                <th class="text-center">
                                    Persetujuan
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($refunds as $refund)
                                <tr>
                                    <td>{{ $refund->date ?? '-' }}</td>
                                    <td>{{ $refund->reason ?? '-' }}</td>
                                    <td>
                                        {{ optional($refund->transactionHeaders)->no_transaction ?? '-' }}
                                    </td>
                                    <td>
                                        {{ $refund->status ?? '-' }}</ </td>
                                    <td class="text-center d-flex align-items-center justify-content-center">
                                        @if ($refund->status === 'menunggu konfirmasi')
                                            <form onsubmit="return confirm('Apakah anda yakin?')"
                                                action="{{ route('refund.action', $refund) }}" method="post"
                                                id="accept-form">
                                                @csrf
                                                <input type="hidden" name="status" value="disetujui">
                                                <button type="submit" class="btn btn-success mr-2"
                                                    style="font-size: .8em;">Setujui</button>
                                            </form>

                                            <form onsubmit="return confirm('Apakah anda yakin?')"
                                                action="{{ route('refund.action', $refund) }}" method="post"
                                                id="reject-form">
                                                @csrf
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" class="btn btn-danger mr-2"
                                                    style="font-size: .8em;">Tolak</button>
                                            </form>
                                        @else
                                            <span class="badge text-light p-2 fs-5 bg-primary">{{ $refund->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $refund)
                                                <a href="{{ route('refunds.edit', $refund) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $refund)
                                                <a href="{{ route('refunds.show', $refund) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $refund)
                                                <form action="{{ route('refunds.destroy', $refund) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="accept-modal" tabindex="-1" aria-labelledby="accept-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Setujui pengajuan pengembalian?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="$('#accept-form').submit()">Setujui</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="reject-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Tolak pengajuan pengembalian?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" onclick="$('#reject-form').submit()">Tolak</button>
                </div>
            </div>
        </div>
    </div>
   
@endsection
