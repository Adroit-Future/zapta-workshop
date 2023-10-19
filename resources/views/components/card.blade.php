{{-- <div class="card">
    <div class="card-body">
      This is some text within a card body.
    </div>
  </div> --}}


  {{-- @dd(get_defined_vars()) --}}

  @props(['cardTitle' => 'Card Title2'])

  <div {{ $attributes->merge(['class'=> 'card' ,'style' => 'width: 18rem;']) }}>
    <img src="{{ $imageSrc ?? '........' }}" {{ $imageSrc->attributes->merge(['class' => ['card-img-top' ,'card-subtitle' => ] ,'alt' => '...']) }} >
    <div class="card-body">
        <h5 class="card-title"> {{ $cardTitle ?? '' }} </h5>
        <p class="card-text"> {{ $description }} .</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
     {{ $slot }}
  </div>
