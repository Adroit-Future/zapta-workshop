<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>

    @php($cardTitle='My Title2')
    <div class="container">
        <div class="row">
            <x-card type="new-card" class="ml-5" id="my-id" :cardTitle="$cardTitle" >
                <x-slot name="imageSrc" class="mt-5">
                    ...
                </x-slot>
                <x-slot  name="description">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </x-slot>
            </x-card>
            {{-- <x-card  type="new-card" class="ml-5" id="my-id2" >
                <x-slot name="imageSrc" class="mt-4" alt="second image">
                    ...
                </x-slot>
                <x-slot  name="description">
                    Some quick example text to build on the card title and make up the bulk of the card's content.
                </x-slot>
            </x-card> --}}
            {{-- <x-card  type="new-card"  />
            <x-card  type="new-card"  />
            <x-card  type="new-card"  /> --}}

        </div>
    </div>

    <div class="container">
         <div class="row">
             <x-forms.input type="email" name="name" placeholder="Enter Your Name" class="mt-4" />
             <x-forms.input name="name" placeholder="Enter Your Name" class="mt-4" />
             <x-forms.input type="radio" value="17" name="age" class="mt-4" />
             <x-forms.input type="radio" value="18" name="age" class="mt-4" />
         </div>
         <div class="row">

            {{-- Simple Component with slot --}}
            {{-- <x-alert type="primary" >
                This is My Primary Alert
            </x-alert> --}}

            @php($user='Usman2')

            {{-- Component With Name Slots --}}
            <x-alert type="primary" :user="$user">
                <x-slot name="title">This is My Primary Alert</x-slot>
                <x-slot name="body">This is My Primary Alert Body</x-slot>
                <x-slot name="sumMethod">
                    {{ $component->sum(5,9) }}
                </x-slot>
                Other Slot html
            </x-alert>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
