<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <title>Laravel</title>

        <style>
        html, body{
            margin-top: 10vh;
            text-align: center;
            background-color: #2c2c43;
            color: #b3b3b3;
        }

        h3{
            display: inline-block;
        }

        input[type=submit]{
            width: 15vw;
            height: auto;
            border: none;
            background-color: #9e379f;
            cursor: pointer;
            font-size: 1.5em;
        }

        input[type=submit]:hover{
            background-color: #e86af0;
        }

        select{
            margin: 0px 20px 0px 0px;
        }
        </style>
    </head>
    <body>
        <h1>{{$title}}</h1>
        <?php
            use App\Converter;

            $url = "http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml";
            $converter = new \App\Converter(file_get_contents($url));
        ?>

        <?php
            if( isset($_GET['submit']) ){
                $amount = htmlentities($_GET['amount']);
                $from = htmlentities($_GET['from']);
                $to = htmlentities($_GET['to']);

                $result = $converter->convert($amount, $from, $to);
            }
        ?>

        <form action="" method="get">
            <h3>Indsæt tal:  <input type="text" name="amount" id="amount"></h3>
            <br />
            <h3>FRA:  
            <select name="from">
                <option value="USD">USD</option>
                <option value="JPY">JPY</option>
                <option value="BGN">BGN</option>
                <option value="CZK">CZK</option>
                <option value="DKK">DKK</option>
                <option value="GBP">GBP</option>
                <option value="HUF">HUF</option>
                <option value="PLN">PLN</option>
                <option value="RON">RON</option>
                <option value="SEK">SEK</option>
                <option value="EUR">EUR</option>
            </select>
            </h3>
            <h3>Til: 
            <select name="to">
                <option value="EUR">EUR</option>
                <option value="USD">USD</option>
                <option value="JPY">JPY</option>
                <option value="BGN">BGN</option>
                <option value="CZK">CZK</option>
                <option value="DKK">DKK</option>
                <option value="GBP">GBP</option>
                <option value="HUF">HUF</option>
                <option value="PLN">PLN</option>
                <option value="RON">RON</option>
                <option value="SEK">SEK</option>
            </select>
            </h3>
            <br />
            <input type="submit" name="submit" value="Find Valuta" />
        </form>

        <h2>
            <br />
            <?php 
                if(isset($result)) echo $result;  
            ?>
        </h2>
    </body>
</html>
