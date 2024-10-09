@php $editing = isset($transactionDetail) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="quantity"
            label="Quantity"
            :value="old('quantity', ($editing ? $transactionDetail->quantity : ''))"
            max="255"
            placeholder="Quantity"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="unit_price"
            label="Unit Price"
            :value="old('unit_price', ($editing ? $transactionDetail->unit_price : ''))"
            max="255"
            placeholder="Unit Price"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total_price"
            label="Total Price"
            :value="old('total_price', ($editing ? $transactionDetail->total_price : ''))"
            max="255"
            placeholder="Total Price"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="transaction_headers_id"
            label="Transaction Headers"
            required
        >
            @php $selected = old('transaction_headers_id', ($editing ? $transactionDetail->transaction_headers_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Transaction Headers</option>
            @foreach($allTransactionHeaders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="ticket_id" label="Ticket" required>
            @php $selected = old('ticket_id', ($editing ? $transactionDetail->ticket_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Ticket</option>
            @foreach($tickets as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
