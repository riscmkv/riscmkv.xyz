<!DOCTYPE html>
<html>
<head>
    <title>Submit An Image</title>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
<div class="content_outer">
    <div class="content_inner">
        <?php
            include 'auth.php';

            $username;
            $image;
            $captcha_resp;

            try {

                if(!empty($_POST['username'])){
                    $username = $_POST['username'];
                } else {
                    throw new RuntimeException('ERROR: No twitter @ provided!');
                }

                if(!empty($_POST['g-recaptcha-response'])){
                    $captcha_resp = $_POST['g-recaptcha-response'];
                } else {
                    throw new RuntimeException("ERROR: please fill in recaptcha!<br>");
                }

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $data = array(
                    'secret' => ,
                    'response' => $_POST["g-recaptcha-response"]
                );
                $options = array(
                    'http' => array (
                        'method' => 'POST',
                        'content' => http_build_query($data)
                    )
                );
                $context  = stream_context_create($options);
                $verify = file_get_contents($url, false, $context);
                $captcha_success=json_decode($verify);
            
                if (!$captcha_success->success) {
                    throw new RuntimeException('Captcha Failed!');
                }

                // Undefined | Multiple Files | $_FILES Corruption Attack
                // If this request falls under any of them, treat it invalid.
                if (
                    !isset($_FILES['meme']['error']) ||
                    is_array($_FILES['meme']['error'])
                ) {
                    throw new RuntimeException('Invalid parameters.');
                }
            
                // Check $_FILES['meme']['error'] value.
                switch ($_FILES['meme']['error']) {
                    case UPLOAD_ERR_OK:
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new RuntimeException('No file sent.');
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        throw new RuntimeException('Exceeded filesize limit.');
                    default:
                        throw new RuntimeException('Unknown errors.');
                }
            
                // You should also check filesize here.
                if ($_FILES['meme']['size'] > 1000000) {
                    throw new RuntimeException('Exceeded filesize limit.');
                }
            
                // DO NOT TRUST $_FILES['meme']['mime'] VALUE !!
                // Check MIME Type by yourself.
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                if (false === $ext = array_search(
                    $finfo->file($_FILES['meme']['tmp_name']),
                    array(
                        'jpg' => 'image/jpeg',
                        'png' => 'image/png',
                        'gif' => 'image/gif',
                    ),
                    true
                )) {
                    throw new RuntimeException('Invalid file format.');
                }
            
                // You should name it uniquely.
                // DO NOT USE $_FILES['meme']['name'] WITHOUT ANY VALIDATION !!
                // On this example, obtain safe unique name from its binary data.
                if (!move_uploaded_file(
                    $_FILES['meme']['tmp_name'],
                    sprintf('../image_submit/%s.%s.%s',
                        sha1_file($_FILES['meme']['tmp_name']),
                        $username,
                        $ext
                    )
                )) {
                    throw new RuntimeException('Failed to move uploaded file.');
                }
            
                echo '<h1>Success!!!</h1>';
                echo 'Your image has been uploaded and will be moderated soon!';
            
            } catch (RuntimeException $e) {
                echo "<h1> Something went wrong! </h1><br>";
                echo $e->getMessage();
                echo "<br>";
                echo "dm @MKVRiscy if something is wrong with the site. Copy-paste all the information on this page. <br><br>";
                echo var_dump($_POST, $_FILES);
                echo "<br>";
            }
        ?>
    </div>
</div>
</body>
</html>