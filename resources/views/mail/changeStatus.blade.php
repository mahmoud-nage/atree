<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            background-color: #f7f9f7;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .content {
            font-size: 18px;
            color: #333;
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .footer {
            color: #6e6e6e;
            font-size: 14px;
            margin-top: 30px;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons img {
            width: 30px;
            margin: 0 10px;
        }

        .link {
            color: #6e6e6e;
            text-decoration: none;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>

</head>

<body>
<div class="container">
    <p class="header"><a href="https://artee.sa" class="navbar-brand">
        </a>
        <img src="https://artee.sa/storage/settings/SN26H90JxYvsDU73lOpOChdcu01eGsumxmlV8cxw.png" alt="Artee"
             class="brand-image">
        </a>
    </p>
    <p class="header">{{__('messages.order_accept', ['num' => $order->number, 'status' => $order->status->name])}}</p>
    <p class="content">{{__('messages.order_accept', ['num' => $order->number, 'status' => $order->status->name])}}</p>
    {{--    <p class="content">تم قبول الطلب الخاص بك وجاري العمل عليه الان</p>--}}
    <a href="https://artee.me" class="link">Artee.me</a>
    <div class="social-icons">
        <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg"
                         alt="Facebook"></a>
        <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/5/53/X_logo_2023_original.svg"
                         alt="X"></a>
        <a href="#"><img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png"
                         alt="Instagram"></a>
    </div>
</div>
</div>
</body>

</html>
