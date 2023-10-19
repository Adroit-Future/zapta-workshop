{{-- <div class="alert alert-primary" role="alert">
    A simple primary alert—check it out!
</div> --}}

{{-- <div class="alert alert-{{ $type }}" role="alert">
    {{ $slot ?? '' }}
</div> --}}


<div class="alert alert-{{ $type }}" role="alert">
    <h1> {{ $title .'-'. $user }} </h1>
    <p> {{ $body }} </p>
    <p> {{ $sum(5,8) }} </p>
    <p> {{ $sumMethod }} </p>

    {{ $slot }}
</div>
