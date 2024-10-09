@php $editing = isset($juragan) @endphp
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('summernote.js') }}"></script>
@endpush

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="address" label="Address" :value="old('address', $editing ? $juragan->address : '')" maxlength="255" placeholder="Address" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email name="email" label="Email" :value="old('email', $editing ? $juragan->email : '')" maxlength="255" placeholder="Email" required>
        </x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="phone_number" label="Phone Number" :value="old('phone_number', $editing ? $juragan->phone_number : '')" maxlength="255"
            placeholder="Phone Number" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="copyright_text" label="Teks Copyright" :value="old('copyright_text', $editing ? $juragan->copyright_text : '')" maxlength="500"
            placeholder="Teks Copyright" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="coordinate" label="coordinate" :value="old('coordinate', $editing ? $juragan->coordinate : '')" maxlength="255" placeholder="coordinate"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="link_fb" label="link_fb" :value="old('link_fb', $editing ? $juragan->link_fb : '')" maxlength="255" placeholder="link_fb">
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="link_twitter" label="link_twitter" :value="old('link_twitter', $editing ? $juragan->link_twitter : '')" maxlength="255"
            placeholder="link_twitter"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="link_instagram" label="link_instagram" :value="old('link_instagram', $editing ? $juragan->link_instagram : '')" maxlength="255"
            placeholder="link_instagram"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="link_youtube" label="link_youtube" :value="old('link_youtube', $editing ? $juragan->link_youtube : '')" maxlength="255"
            placeholder="link_youtube"></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="short_description" label="Short Description" maxlength="255" required>
            {{ old('short_description', $editing ? $juragan->short_description : '') }}
        </x-inputs.textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        {{-- <x-inputs.textarea name="long_description" label="Long Description" required>
            {{ old('long_description', $editing ? $juragan->long_description : '') }}</x-inputs.textarea> --}}
        <label for="summernote">Deskripsi halaman tentang</label>
        <textarea name="long_description" id="summernote" label="Long Description" required>
                {{ old('long_description', $editing ? $juragan->long_description : '') }}
            </textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        {{-- <x-inputs.textarea name="contact_description" label="Contact Description" maxlength="255" required>
            {{ old('contact_description', $editing ? $juragan->contact_description : '') }}
        </x-inputs.textarea> --}}
        <label for="summernte2">Deskripsi halaman contact</label>
        <textarea name="contact_description" id="summernote2" label="Contact Description" required>
                {{ old('contact_description', $editing ? $juragan->contact_description : '') }}
            </textarea>

    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $juragan->logo_website ? \Storage::url($juragan->logo_website) : '' }}')">
            <x-inputs.partials.label name="logo_website" label="Logo Website"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100%;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="logo_website" id="logo_website" @change="fileChosen" />
            </div>

            @error('logo_website')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $juragan->banner_website ? \Storage::url($juragan->banner_website) : '' }}')">
            <x-inputs.partials.label name="banner_website" label="Banner Website"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                    style="width: 100%; height: 450px;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100%; height: 300px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="banner_website" id="banner_website" @change="fileChosen" />
            </div>

            @error('banner_website')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>
</div>
