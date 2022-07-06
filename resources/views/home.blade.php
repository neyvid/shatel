<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <script>
        window.csrf_token='{{csrf_token()}}'
    </script>


    <title>Document</title>
</head>
<body>
@auth()
    <script>
        window.user = {
            name: '{{auth('sanctum')->user()->name}}',
            lastname: '{{auth('sanctum')->user()->lastname}}',
            image: '{{auth('sanctum')->user()->image}}',
            email: '{{auth('sanctum')->user()->email}}',
            role:   '{{auth('sanctum')->user()->role}}',
            mobile: '{{auth('sanctum')->user()->mobile}}',
            authType: '{{auth('sanctum')->user()->mobile===null? 'email':'mobile'}}',
            isVerified: {{auth('sanctum')->user()->email_verified_at===null? 1:2}},
            isMobileVerified: {{auth('sanctum')->user()->mobile_verified_at===null? 1:2}}
        }
    </script>
@endauth
{{--{{auth('sanctum')->user()}}--}}

<div id="app">


    <v-app>
        <router-view></router-view>

    </v-app>
</div>
<script src="{{asset('js/app.js')}}">

</script>
</body>
</html>

