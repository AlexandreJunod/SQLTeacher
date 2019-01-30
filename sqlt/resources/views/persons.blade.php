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
                <div class="title m-b-md">
                    SQLApp
                </div>
                @if(Session::has('Error'))
                  <h3>{{ Session::get('Error') }}</h3>
                @endif
                <table>
                    <th>
                        Professeurs & élèves
                    </th>
                    <form method="post" action="/persons/crud">
                    @csrf
                    <tr>
                        <td><input type="text" name="firstname" placeholder="Prenom"></td>
                        <td><input type="text" name="lastname" placeholder="Nom"></td>
                        <td><input type="text" name="email" placeholder="Email"></td>
                        <td><input type="text" name="acronym" placeholder="Acronyme"></td>
                        <td><button name="create">Ajouter</button></td>
                    </tr>
                    @foreach($datapersons as $dataperson)
                    <tr>
                        @if(isset($toUpdate) && $toUpdate == $dataperson->id)
                            <td><input type="text" name="firstname" placeholder="{{ $dataperson->firstname }}"></td>
                            <td><input type="text" name="lastname" placeholder="{{ $dataperson->lastname }}"></td>
                            <td><input type="text" name="email" placeholder="{{ $dataperson->email }}"></td>
                            <td><input type="text" name="acronym" placeholder="{{ $dataperson->acronym }}"></td>
                            <td><button name="confirm" value="{{ $dataperson->id }}">Valider</button></td>
                        @else
                            <td>{{ $dataperson->firstname }}</td>
                            <td>{{ $dataperson->lastname }}</td>
                            <td>{{ $dataperson->email }}</td>
                            <td>{{ $dataperson->acronym }}</td>
                            <td><button name="update" value="{{ $dataperson->id }}">Modifier</button></td>
                            <td><button name="delete" value="{{ $dataperson->id }}">Supprimer</button></td>
                        @endif
                    </tr>
                    @endforeach
                    </form>
                </table>
            </div>
        </div>
    </body>
</html>
