@php $editing = isset($city) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="city_name"
            label="City Name"
            maxlength="255"
            required
            >{{ old('city_name', ($editing ? $city->city_name : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
