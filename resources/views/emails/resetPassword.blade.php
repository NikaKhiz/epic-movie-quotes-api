<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>

<body
    style="min-height:100vh;margin:0;padding:0;box-sizing:border-box;background:linear-gradient(187.16deg, #181623 0.07%, #191725 51.65%, #0D0B14 98.75%);padding:80px 35px;font-weight:400;">
    <div style="width:100%;max-width:1280px;margin:0 auto;color:#ffffff;word-wrap:break-word;">
        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;">
            <div style="width: 20px;height:20px;">
                <img src="{{ $message->embed(public_path() . '/images/quotes.png') }}" alt="quoteImg"
                    style="width:100%;display:block;object-fit:cover">

            </div>
            <p
                style="margin:0;padding:0;color:#DDCCAA;text-transform:uppercase;font-size:12px;line-height:150%;font-weight:500;">
                movie quotes</p>
        </div>

        <div style="margin-top: 70px;">
            <div style="display:flex;flex-direction:column;gap:45px;">
                <div style="display:flex;flex-direction:column;gap:24px;">
                    <p style="line-height:150%;margin:0;padding:0;">Hola {{ $name }}!</p>
                    <p style="line-height:150%;margin:0;padding:0;">Thanks for joining Movie quotes! We really
                        appreciate it. Please click the button below to recover password:</p>
                    <a href="{{ $url }}"
                        style="color:#ffffff;text-decoration:none;background-color:#E31221;max-width:max-content;border-radius:5px;margin:0;padding:7px 15px;">Recover
                        Password</a>
                </div>
                <div style="display:flex;flex-direction:column;gap:24px;">
                    <p style="line-height:150%;margin:0;padding:0;">If clicking doesn't work, you can try copying and
                        pasting it to your browser:</p>
                    <a href="{{ $url }}"
                        style="text-decoration:none;line-height:150%;margin:0;padding:0;color:#DDCCAA;">
                        {{ $url }}
                    </a>
                </div>
                <div style="display:flex;flex-direction:column;gap:24px;">
                    <p style="line-height:150%;margin:0;padding:0;">If you have any problems, please contact
                        us:support@moviequotes.ge</p>
                    <p style="line-height:150%;margin:0;padding:0;">MovieQuotes Crew</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
