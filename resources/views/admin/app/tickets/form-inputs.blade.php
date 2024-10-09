@php $editing = isset($ticket) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="name" label="Name" :value="old('name', $editing ? $ticket->name : '')" maxlength="255" placeholder="Name" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="description" label="Description" maxlength="255" required>
            {{ old('description', $editing ? $ticket->description : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="price" label="Price" :value="old('price', $editing ? $ticket->price : '0')" maxlength="255" placeholder="Price" required>
        </x-inputs.text>
    </x-inputs.group>


    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="quota" label="Quota" :value="old('quota', $editing ? $ticket->quota : '')" max="255" placeholder="Quota" required>
        </x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime name="star_sale_at" label="Star Sale At"
            value="{{ old('star_sale_at', $editing ? optional($ticket->star_sale_at)->format('Y-m-d\TH:i:s') : '') }}"
            max="255" required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime name="end_sale_at" label="End Sale At"
            value="{{ old('end_sale_at', $editing ? optional($ticket->end_sale_at)->format('Y-m-d\TH:i:s') : '') }}"
            max="255" required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $ticket->type : '')) @endphp
            <option value="berbayar" {{ $selected == 'berbayar' ? 'selected' : '' }}>Berbayar</option>
            <option value="gratis" {{ $selected == 'gratis' ? 'selected' : '' }}>Gratis</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="event_id" label="Event" required>
            @php $selected = old('event_id', ($editing ? $ticket->event_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Event</option>
            @foreach ($events as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="discount" label="Discount" :value="old('discount', $editing ? $ticket->discount : '0')" max="255" step="0.01"
            placeholder="Discount" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="fee_admin" label="Fee Admin" :value="old('fee_admin', $editing ? $ticket->fee_admin : '0')" max="255" step="0.01"
            placeholder="Fee Admin" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="tax_coast" label="Tax Coast" :value="old('tax_coast', $editing ? $ticket->tax_coast : '0')" max="255" step="0.01"
            placeholder="Tax Coast" required></x-inputs.number>
    </x-inputs.group>
</div>
