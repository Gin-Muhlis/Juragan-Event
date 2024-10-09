@php $editing = isset($post) @endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/summernote/summernote.min.js') }}"></script>
    <script src="{{ asset('summernote.js') }}"></script>
@endpush

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="title" label="Title" id="title" :value="old('title', $editing ? $post->title : '')" maxlength="255" placeholder="Title"
            required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="slug">Slug</label>
        <input type="text" class="form-control" name="slug" label="slug"
            value="{{ old('slug', $editing ? $post->slug : '') }}" maxlength="255" placeholder="slug" required
            style="pointer-events: none;" id="slug">
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <label for="summernote">Content</label>
        <textarea name="content" id="summernote" label="content" required>
             {{ old('content', $editing ? $post->content : '') }}
        </textarea>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <div x-data="imageViewer('{{ $editing && $post->image ? \Storage::url($post->image) : '' }}')">
            <x-inputs.partials.label name="image" label="Image"></x-inputs.partials.label><br />

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
                <input type="file" name="image" id="image" @change="fileChosen" />
            </div>

            @error('image')
                @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $post->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach ($users as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="topic_mix_id" label="Topic Mix" required>
            @php $selected = old('topic_mix_id', ($editing ? $post->topic_mix_id : '')) @endphp
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
