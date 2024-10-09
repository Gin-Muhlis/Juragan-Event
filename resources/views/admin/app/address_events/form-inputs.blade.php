@php $editing = isset($addressEvent) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="address" label="Address" maxlength="255" required>
            {{ old('address', $editing ? $addressEvent->address : '') }}</x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="longitude" label="Longitude" :value="old('longitude', $editing ? $addressEvent->longitude : '')" max="255" step="0.01"
            placeholder="Longitude" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="latitutde" label="Latitutde" :value="old('latitutde', $editing ? $addressEvent->latitutde : '')" max="255" step="0.01"
            placeholder="Latitutde" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="event_id" label="Event" required>
            @php $selected = old('event_id', ($editing ? $addressEvent->event_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Event</option>
            @foreach ($events as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
