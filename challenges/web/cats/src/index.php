<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Favorite Cats</title>
    <style>
        body {
            background-color: #ffffcc;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h1 {
            color: #990099;
        }

        p {
            color: #006600;
        }

        .cat-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 20px;
            width: 50%;
            margin: 0 auto;
        }

        .cat {
            border: 2px solid #ffcc00;
            padding: 10px;
            background-color: #ffcc99;
            border-radius: 10px;
        }

        .cat img {
            width: 100%;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <h1>My Favorite Cats</h1>
    <p>Welcome to my website dedicated to my favorite cats! I absolutely adore these fluffy creatures and wanted to share their cuteness with the world.</p>

    <div class="cat-container">
        <div class="cat">
            <img src="/cat.php?cat=1.png" alt="Snowball">
            <p>Snowball</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=2.png" alt="Mittens">
            <p>Mittens</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=3.png" alt="Whiskers">
            <p>Whiskers</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=4.png" alt="Fluffy">
            <p>Fluffy</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=5.png" alt="Shadow">
            <p>Shadow</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=6.png" alt="Smokey">
            <p>Smokey</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=7.png" alt="Cupcake">
            <p>Cupcake</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=8.png" alt="Oreo">
            <p>Oreo</p>
        </div>
        <div class="cat">
            <img src="/cat.php?cat=9.png" alt="Leo">
            <p>Leo</p>
        </div>
    </div>
</body>

</html>
