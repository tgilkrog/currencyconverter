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
        <h1>Currency Converter</h1>
        <form action="/" method="post">
            {{ csrf_field()}}
            <h3>Indsæt tal:  <input type="text" name="amount" id="amount"></h3>
            <br />
            <h3>FRA:  
                <select name="from">
                    <option value="EUR">EUR</option>
                    <?php
                        foreach($list as $key => $value):
                        echo '<option value="'.$key.'">'.$key.'</option>';
                        endforeach;
                    ?>
                </select>
            </h3>
            <h3>Til: 
                <select name="to">
                    <?php
                        foreach($list as $key => $value):
                        echo '<option value="'.$key.'">'.$key.'</option>';
                        endforeach;
                    ?>
                    <option value="EUR">EUR</option>
                </select>
            </h3>
            <br />
            <input type="submit" name="button" value="Find Valuta" />
        </form>
        <h2>
            <br />
            {{$result}}
        </h2>
    </body>
</html>
