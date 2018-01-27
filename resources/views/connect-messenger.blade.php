@extends('layouts.app')

@section('content')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '{{ env('MESSENGER_APP_ID') }}',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v2.11'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-6">
                <div class="card text-center">
                    <div class="card-body">
                        <p>Connect new Profile</p>


                        <div class="fb-send-to-messenger"
                             messenger_app_id="{{ env('MESSENGER_APP_ID') }}"
                             page_id="761802990685009"
                             data-ref="{{ $shop }}"
                             color="blue"
                             size="large">
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection