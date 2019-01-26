<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SQLTeacher</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            table {
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="/">Home</a>
            </div>

            <div class="content">
                @foreach($exercises as $exercise)
                    <h2>{{ $exercise->description }}</h2>
                    <table>
                    <tr>
                        <th>N°</th>
                        <th>Question</th>
                    </tr>
                        @foreach($exercise->querie as $querie)
                            <tr>
                                <td>{{ $querie->order }}</td>
                                <td>{{ $querie->formulation }}</td>
                            </tr>
                        @endforeach
                    </table>
                @endforeach
                <h2>Soumettre une réponse</h2>
                <table>
                    <form method="post" action="/exercises/answer">
                    @csrf
                    <tr>
                        <td>Acronyme</td>
                        <td><input type="text" name="acronym" required></td>
                    </tr>
                    <tr>
                        <td>Question</td>
                        <td><input type="number" name="question" required></td>
                    </tr>
                    <tr>
                        <td>Réponse</td>
                        <td><textarea name="answer" rows="20" cols="200" required></textarea></td>
                    </tr>
                    <tr>
                        <td><button name="sendAnswer">Ok</button></td>
                    </tr>
                    </form>
                </table>
                <h2>Résultats</h2>
                <table>
                    <th>Ordre</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Résultat</th>
                    @foreach($scores as $score)
                    <tr>
                        <td>{{ $score->querie->order }}</td>
                        <td>{{ $score->people->firstname }}</td>
                        <td>{{ $score->people->lastname }}</td>
                        <td>{{ $score->people->email }}</td>
                        @if($score->success)
                            <td>Reussi</td>
                        @else
                            <td>Raté</td>
                        @endif
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
