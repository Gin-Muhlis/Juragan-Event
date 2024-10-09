@php $editing = isset($galery) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $galery->image ? \Storage::url($galery->image) : '' }}')">
            <x-inputs.partials.label name="image" label="Image"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                    style="width: 300px; height: 100%;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="image" id="image" @change="fileChosen" />
            </div>

            @error('image')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="caption" label="Caption" :value="old('caption', $editing ? $galery->caption : '')" maxlength="255" placeholder="Caption" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="description" label="Description" maxlength="255" required>
            {{ old('description', $editing ? $galery->description : '') }}</x-inputs.textarea>
    </x-inputs.group>
</div>
