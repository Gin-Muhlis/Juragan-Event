@php $editing = isset($transactionHeaders) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.date name="transaction_date" label="Transaction Date"
            value="{{ old('transaction_date', $editing ? optional($transactionHeaders->transaction_date)->format('Y-m-d') : '') }}"
            required></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="no_transaction" label="No Transaction" :value="old('no_transaction', $editing ? $transactionHeaders->no_transaction : '')" placeholder="No Transaction"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="total_transaction" label="Total Transaction" :value="old('total_transaction', $editing ? $transactionHeaders->total_transaction : '')"
            placeholder="Total Transaction" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="status" label="Status">
            @php $selected = old('status', ($editing ? $transactionHeaders->status : '')) @endphp
            <option value="menunggu pembayaran" {{ $selected == 'menunggu pembayaran' ? 'selected' : '' }}>Menunggu
                pembayaran</option>
            <option value="selesai" {{ $selected == 'selesai' ? 'selected' : '' }}>Selesai</option>
            <option value="dibatalkan" {{ $selected == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="event_id" label="Event" required>
            @php $selected = old('event_id', ($editing ? $transactionHeaders->event_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Event</option>
            @foreach ($events as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $transactionHeaders->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach ($users as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="payment_id" label="Payment" required>
            @php $selected = old('payment_id', ($editing ? $transactionHeaders->payment_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Payment</option>
            @foreach ($payments as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $transactionHeaders->proof_of_payment ? \Storage::url($transactionHeaders->proof_of_payment) : '' }}')">
            <x-inputs.partials.label name="banner" label="Banner"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="proof_of_payment" id="proof_of_payment" @change="fileChosen" />
            </div>

            @error('proof_of_payment')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>
</div>
