@php $editing = isset($topicMix) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="topic" label="Topic">
            @php $selected = old('topic', ($editing ? $topicMix->topic : '')) @endphp
        </x-inputs.select>
    </x-inputs.group>
</div>
