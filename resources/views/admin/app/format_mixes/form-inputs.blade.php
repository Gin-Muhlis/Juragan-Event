@php $editing = isset($formatMix) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="format"
            label="Format"
            :value="old('format', ($editing ? $formatMix->format : ''))"
            maxlength="255"
            placeholder="Format"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
