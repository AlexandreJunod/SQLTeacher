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

            td {
                padding: 15px;
                border-bottom: 1px solid #ddd;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="/">Home</a>
            </div>
            <div class="content">
                @if(Session::has('Error'))
                    <h3>{{ Session::get('Error') }}</h3>
                @endif
                <table>
                    <th>Titre</th>
                    <th>Requette</th>
                    <form method="post" action="/management/crud">
                        @csrf
                        <tr>
                            <td><input type="text" name="title" placeholder="Titre"></td>
                            <td><textarea rows="5" cols="120" type="text" name="db_script" placeholder="Requette + données"></textarea></td>
                            <td><button name="create">Ajouter</button></td>
                        </tr>
                        @foreach ($dataexercises as $dataexercise)
                            <tr>
                                @if(isset($toUpdate) && $toUpdate == $dataexercise->id)
                                    <td><input type="text" name="title" placeholder="{{ $dataexercise->title }}"></td>
                                    <td><textarea rows="5" cols="120" type="text" name="db_script">{{ $dataexercise->db_script }}</textarea></td>
                                    <td><button name="confirm" value="{{ $dataexercise->id }}">Valider</button></td>
                                @else
                                    <td>{{$dataexercise->title}}</td>
                                    <td>{{$dataexercise->db_script}}</td>
                                    <td><button name="update" value="{{ $dataexercise->id }}">Modifier</button></td>
                                    <td><button name="delete" value="{{ $dataexercise->id }}">Supprimer</button></td>
                                @endif
                            </tr>
                        @endforeach
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
