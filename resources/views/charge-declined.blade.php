<html>
<head>
    <title>Charge Declined</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body {
            background-color: #f9f9f9;
            color: #5e6273;
        }
        .row {
            margin: 0;
        }
        .header {
            text-align: center;
            margin-top: 3rem;
            margin-bottom: 1rem;
        }
        .card {
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0px 0px 15px rgba(0,0,0,0.05);
            border-radius: 8px;
        }
    </style>
</head>
<body>
<div class="header">
    <h2>Declined Charge...</h2>
</div>
<div class="row justify-content-md-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <p class="text-center">
                    We are very sorry that we could not be of use to you. You can activate the payment at any time and start using the app. If you still decide that the app is not useful to you, then you just need to remove the app in the admin panel on your app page.
                </p>
                <div class="list-group text-center">
                    <a href="{{ route('chargeCreate') }}" class="list-group-item list-group-item-action">Activate charge</a>
                            <a href="https://{{ $shop }}/admin/apps" class="list-group-item list-group-item-action">Go to your store dashboard for delete App</a>
                            <a href="#" class="list-group-item list-group-item-action">Get in touch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>