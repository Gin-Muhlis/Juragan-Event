@php $editing = isset($refund) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($refund->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="reason" label="Reason" maxlength="255" required
            >{{ old('reason', ($editing ? $refund->reason : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="transaction_headers_id"
            label="Transaction Headers"
            required
        >
            @php $selected = old('transaction_headers_id', ($editing ? $refund->transaction_headers_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Transaction Headers</option>
            @foreach($allTransactionHeaders as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
