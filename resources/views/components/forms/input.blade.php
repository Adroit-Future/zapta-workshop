
    {{-- <input {{ $attributes  }} type="text" > --}}

    @props(['type' => 'text'])
    <input {{ $attributes->merge(['type' => $type ?? 'text','class' => ( in_array($type,['radio','checkbox']) ? '': 'form-control') ])  }} >

