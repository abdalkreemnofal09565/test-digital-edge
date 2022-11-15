<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://www.google.com/recaptcha/api.js"></script>  <!-- call script file -->
    <title>Document</title>
</head>
<body>
    <form action="{{route('post.re')}}" method="POST">
        @csrf

        <div class="g-recaptcha" data-sitekey="6LcMZR0UAAAAALgPMcgHwga7gY5p8QMg1Hj-bmUv"></div> <!-- render reCaptcha -->

        <button type="submit">Submit</button>
    </form>
</body>
</html>