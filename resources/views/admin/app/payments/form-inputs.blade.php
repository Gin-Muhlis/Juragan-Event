@php $editing = isset($payment) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $payment->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $payment->icon ? \Storage::url($payment->icon) : '' }}')"
        >
            <x-inputs.partials.label
                name="icon"
                label="Icon"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input type="file" name="icon" id="icon" @change="fileChosen" />
            </div>

            @error('icon') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="fee_service"
            label="Fee Service"
            :value="old('fee_service', ($editing ? $payment->fee_service : '0'))"
            max="255"
            step="0.01"
            placeholder="Fee Service"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
