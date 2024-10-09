@php $editing = isset($contact) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="name" label="Name" :value="old('name', $editing ? $contact->name : '')" maxlength="255" placeholder="Name" required>
        </x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email name="email" label="Email" :value="old('email', $editing ? $contact->email : '')" placeholder="Email" required></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="message" label="Message" maxlength="255" required>
            {{ old('message', $editing ? $contact->message : '') }}</x-inputs.textarea>
    </x-inputs.group>
</div>
