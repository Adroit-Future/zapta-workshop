<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Toaster Css -->
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}
    <!------------------------------- Toaster Js---------------------------------->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}

    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('build/assets/app-969f0978.js') }}"></script>
</head>
<body>
    Pusher

    <script>
         Pusher.logToConsole = true;
        //  console.log("window",Echo);
        //  Echo.private('premium.2')
        // .listen('.server.message', (e) => {
        //     console.log("private");
        //     console.log(e);
        //     Echo.leave('premium.2');
        // });

        Echo.join(`chat.2`)
        .here((users) => {
            console.log(users);
        })
        .joining((user) => {
            console.log(user.name);
        })
        .leaving((user) => {
            console.log(user.name);
        })
        .error((error) => {
            console.error(error);
        })
        .listen('.server.chat', (e) => {
            console.log(e);
        });

        // Echo.channel('mychannel')
        // .listen('.server.message', (e) => {
        //     console.log("public");
        //     console.log(e);
        // });
    </script>
</body>
</html>
