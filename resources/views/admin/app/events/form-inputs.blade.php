@php $editing = isset($event) @endphp
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('summernote.js') }}"></script>
@endpush


<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="title" label="Title" :value="old('title', $editing ? $event->title : '')" maxlength="255" placeholder="Title" required
            id="title">
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime name="start_at" label="Start At"
            value="{{ old('start_at', $editing ? optional($event->start_at)->format('Y-m-d\TH:i:s') : '') }}"
            max="255" required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.datetime name="end_at" label="End At"
            value="{{ old('end_at', $editing ? optional($event->end_at)->format('Y-m-d\TH:i:s') : '') }}" max="255"
            required></x-inputs.datetime>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="type" label="Type">
            @php $selected = old('type', ($editing ? $event->type : '')) @endphp
            <option value="Offline" {{ $selected == 'Offline' ? 'selected' : '' }}>Offline</option>
            <option value="Online" {{ $selected == 'Online' ? 'selected' : '' }}>Online</option>
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" label="slug"
            value="{{ old('slug', $editing ? $event->slug : '') }}" maxlength="255" placeholder="slug" required
            style="pointer-events: none;" id="slug">
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $event->banner ? \Storage::url($event->banner) : '' }}')">
            <x-inputs.partials.label name="banner" label="Banner"></x-inputs.partials.label><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img :src="imageUrl" class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;" />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div class="border rounded border-gray-200 bg-gray-100" style="width: 100px; height: 100px;"></div>
            </template>

            <div class="mt-2">
                <input type="file" name="banner" id="banner" @change="fileChosen" />
            </div>

            @error('banner')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="summernote">Description</label>
        <textarea name="description" id="summernote" label="Description" required>
                {{ old('description', $editing ? $event->description : '') }}
            </textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="summernote2">Terms</label>
        <textarea name="terms" id="summernote2" label="Terms" required>
{{ old('terms', $editing ? $event->terms : '') }}
            </textarea>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="city_id" label="City" required>
            @php $selected = old('city_id', ($editing ? $event->city_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the City</option>
            @foreach ($cities as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="organizer_id" label="Organizer" required>
            @php $selected = old('organizer_id', ($editing ? $event->organizer_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Organizer</option>
            @foreach ($organizers as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="format_mix_id" label="Format" required>
            @php $selected = old('format_mix_id', ($editing ? $event->format_mix_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Format Mix</option>
            @foreach ($formatMixes as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="topic_mix_id" label="Topic" required>
            @php $selected = old('topic_mix_id', ($editing ? $event->topic_mix_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Topic Mix</option>
            @foreach ($topicMixes as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#title").on("change", function() {
                let value = $(this).val();

                let cleanedValue = value.replace(/[^a-zA-Z0-9 ]/g, '')

                let slug = cleanedValue.replace(/\s+/g, '-');

                slug = slug.toLowerCase();

                $("#slug").val(slug)
            })
        })
    </script>
@endpush
