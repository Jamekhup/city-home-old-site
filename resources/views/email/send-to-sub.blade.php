<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .main {
            width: 95%;
            margin: 20px auto;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .main h1 {
            font-size: 22px;
            font-family: 'Open Sans', sans-serif;
            padding: 10px 0px 10px 10px;
        }

        .main .bg {
            height: 420px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .main p {
            font-family: 'Roboto', sans-serif;
        }

        .main .row1 {
            display: flex;

        }

        .main .row1 p {
            margin: 5px 10px 5px 10px;
        }

        .main .row1 .price {
            font-size: 23px;
        }

        .main .row1 .list {
            font-size: 14px;
            margin-top: 13px;
        }

        .main .township {
            padding-left: 10px;
            margin-bottom: 5px;
        }

        .main .details {
            background-color: #0099CC;
            text-decoration: none;
            color: #fff;
            border-radius: 2px;
            padding: 0px 14px;
            margin-left: 10px;
        }

        .main .row2 {
            margin-top: 10px;
        }

        .main .row2 .sale {
            text-decoration: none;
            background-color: #222;
            color: #fff;
            padding: 3px 10px 0px 10px;
            margin-left: 10px;
            font-size: 14px;
        }

        .main .row2 .rent {
            text-decoration: none;
            background-color: rgb(8, 189, 196);
            color: #222;
            padding: 3px 10px 0px 10px;
            margin-left: 10px;
            font-size: 14px;
        }

        .main .regard {
            margin-top: 25px;
            font-size: 18px;
            padding-left: 10px;
        }

        .main .co {
            font-size: 14px;
            padding-left: 10px;
        }

        .main .footer {
            background-color: #0099CC;
            padding: 2px 10px 10px 10px;
            margin-top: 15px;
        }

        .main .footer small {
            color: #fff;
        }

        @media screen and (max-width:600px) {
            .main h1 {
                font-size: 18px;
            }

            .main .bg {
                height: 280px;

            }

            .main .row1 .price {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <h1>New Updated Properties {{$toGet['saleRent']}} in
            Yangon, Myanmar</h1>
        <div class="bg"
            style="background-image:url('http://localhost:8000/storage/adminUploads/{{$toGet['fileName']}}')">

        </div>
        <div class="row1">
            <p class="price">{{$toGet['money']}} {{$toGet['price']}}</p>
            <p class="list">- In {{$toGet['township']}}</p>
        </div>
        
        <a class="details"
            href="http://localhost:8000/property-{{$toGet['saleRent']}}/{{$toGet['category']}}/">View
            Detail</a>
        <br>
        <br>
        <hr>
        <div class="row2">
            <a class='rent' href="http://localhost:8000/for-rent/">Properties For Rent</a>
            <a class="sale" href="http://localhost:8000/for-sale/">Properties For Sale</a>
        </div>

        <p class="regard">Best Regards,</p>
        <p class="co">City Home Property Co.,ltd</p>

        <div class="footer">
            <small>You received this email since you have subscribed. If you want to unsubscribed, please contact admin
                via contact form. Thank you.</small>
        </div>

    </div>
</body>

</html>