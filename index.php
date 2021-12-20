<!DOCTYPE html>
<html>
<head>
    <title>Submit An Image</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2S0Z8XV28Y"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2S0Z8XV28Y');
    </script>

    <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="favicon-16x16.png" sizes="16x16">
</head>

<body>

<div class="content_outer">
    <div class="content_inner_heading">
        <h1>RISCMKV.XYZ</h1>
    </div>
</div>

<div class="content_outer">
    <div class="content_inner">
        <h2>Neural Net Guesses Memes Submissions</h2>

        Rules (please read):
        <ol>
            <li>Images must be SFW and follow Twitter ToS (duh)</li>
            <li>Images must be explicitly memes or otherwise funny. Images of your car, pet, or any other thing you want to show off will not be accepted (unless your pet is really cute or your car is exceptionally audacious).</li>
            <li>Do not submit images of people you know IRL. I've had people submit random images of their classmates and coworkers before, and I'm not about to upload random photos of random people.</li>
            <li>No politics! A meme can involve politics so long as it's wholesome/shitpost-y/funny first and a statement second. Essentially nothing that will start a flame war in the replies</li>
            <li>Memes regarding half life/cruelty squad/dark souls/engineering get bonus points.</li>
        </ol>

        <b>Important: The bot cannot process images with transparency or animated gifs. If you want to submit an image that has these qualities, the easiest solution is to open it in ms paint and save it as a jpeg, and then submit.</b>

        <br>
        <br>

        <div class="form_center">
            <form action="scripts/image_submit.php" id="meme_form" method="POST" enctype="multipart/form-data">
                Your twitter @: @
                <input type="text" id="username" name="username"><br>
                Your meme: &nbsp &nbsp &nbsp &nbsp
                <input type="file" id="meme" name="meme"> <br>
                <br><br>
                <div class="g-recaptcha" data-sitekey="6LdpMxkdAAAAAK7LkoJDpWnggtxdGyQ_v5pP_7Ed"></div>
                <br>
                <input type="submit" value="Submit meme!">
            </form>
        </div>

    </div>
</div>
</body>

</html>
