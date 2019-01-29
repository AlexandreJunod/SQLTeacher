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
                margin: 50px;
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
                color: black;
                font-size: 18px;
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
                    <p style="color:mediumblue;">Création de la table : {{ $exercise->statement }}</p>
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
                <h3>{{Session::get('Error')}}</h3> <!-- Show error msg -->
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
                @if(isset($error))
                    <h2>{{ $error }}</h2>
                @endif
                <h2>Résultats</h2>
                <table>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>acronyme</th>
                    @foreach($exercise->querie as $querie)
                        <th>{{ $querie->order }}</th>
                    @endforeach
                    @foreach($peoples as $people) <!-- Select every person on the DB -->
                    <tr>
                        <td>{{ $people->firstname }}</td>
                        <td>{{ $people->lastname }}</td>
                        <td>{{ $people->acronym }}</td>
                        @foreach($scores as $score) <!-- Select all the scores -->
                            @if($people->email == $score->people->email) <!-- Select the score of one person -->
                                @foreach($exercise->querie as $querie) <!-- Get the number of questions -->
                                    @if($querie->order == $score->querie->order) <!-- Select one question  -->
                                        @if($score->success)
                                            <td><span class="successful" style="background-color:lawngreen">{{ $score->attempts }}</span></td>
                                        @else
                                            <td><span class="Failed" style="background-color:tomato">{{ $score->attempts }}</span></td>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </body>
</html>
