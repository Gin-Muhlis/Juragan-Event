@php $editing = isset($visitors) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="post_id"
            label="Post Id"
            :value="old('post_id', ($editing ? $visitors->post_id : ''))"
            max="255"
            placeholder="Post Id"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="ip_address"
            label="Ip Address"
            :value="old('ip_address', ($editing ? $visitors->ip_address : ''))"
            maxlength="255"
            placeholder="Ip Address"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
