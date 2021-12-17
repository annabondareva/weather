<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <title>Weather Broadcast</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body class="antialiased">
<form method='GET' action="{{route('dashboard')}}">
    @csrf
    <div class="container" style="margin-top: 50px;">
        <div class="row">
            <div class="col-md-4">
                <input type="hidden" name="perPage" value="{{$geometries->perPage()}}">
                <select class="js-example-placeholder-multiple js-states form-control" style="width: 250px;"
                        name="events[]"
                        multiple="multiple">
                    <option value="6"
                            @if(isset($selectedCategories) && in_array(6,$selectedCategories)) selected @endif>Засуха
                    </option>
                    <option value="7"
                            @if(isset($selectedCategories) && in_array(7,$selectedCategories)) selected @endif>Пыльная
                        буря
                    </option>
                    <option value="16"
                            @if(isset($selectedCategories) && in_array(16,$selectedCategories)) selected @endif>
                        Землятресения
                    </option>
                    <option value="9"
                            @if(isset($selectedCategories) && in_array(9,$selectedCategories)) selected @endif>
                        Наводнения
                    </option>
                    <option value="14"
                            @if(isset($selectedCategories) && in_array(14,$selectedCategories)) selected @endif>Оползни
                    </option>
                    <option value="19"
                            @if(isset($selectedCategories) && in_array(19,$selectedCategories)) selected @endif>
                        Техногенное
                    </option>
                    <option value="15"
                            @if(isset($selectedCategories) && in_array(15,$selectedCategories)) selected @endif>Море и
                        ледники
                    </option>
                    <option value="10"
                            @if(isset($selectedCategories) && in_array(10,$selectedCategories)) selected @endif>Ураганы
                    </option>
                    <option value="17"
                            @if(isset($selectedCategories) && in_array(17,$selectedCategories)) selected @endif>Снег
                    </option>
                    <option value="18"
                            @if(isset($selectedCategories) && in_array(18,$selectedCategories)) selected @endif>Жара
                    </option>
                    <option value="12"
                            @if(isset($selectedCategories) && in_array(12,$selectedCategories)) selected @endif>Вулканы
                    </option>
                    <option value="13"
                            @if(isset($selectedCategories) && in_array(13,$selectedCategories)) selected @endif>
                        Загрязнения воды
                    </option>
                    <option value="8"
                            @if(isset($selectedCategories) && in_array(8,$selectedCategories)) selected @endif>Лесные
                        пожары
                    </option>
                </select>
                <input class="btn btn-primary" type="submit">
            </div>
            <div class="col-md-4">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Кл. событий на странице
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                               href="{{route('dashboard',['selectedCategories'=> $selectedCategories, 'perPage' => 5])}}">5</a>
                        </li>
                        <li><a class="dropdown-item"
                               href="{{route('dashboard', ['selectedCategories'=> $selectedCategories, 'perPage' => 10])}}">10</a>
                        </li>
                        <li><a class="dropdown-item"
                               href="{{route('dashboard', ['selectedCategories'=> $selectedCategories, 'perPage' => 20])}}">20</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div>
            <table class="table table-striped" style="margin-top: 10px">

                <thead>
                <tr>
                    <th scope="col">Event Title</th>
                    <th scope="col">Date and Time</th>
                    <th scope="col">Googlemap link</th>
                </tr>
                </thead>
                <tbody>
                @if(empty($geometries))
                    <tr>
                        <th scope="row">null</th>
                        <td>null</td>
                        <td>null</td>
                    </tr>
                @else
                    @foreach($geometries as $geometry)
                        <tr>
                            <th scope="row">{{$geometry->event->title}}</th>
                            <td>{{$geometry->date_and_time}}</td>
                            <td>
                                <a href="https://www.google.com/maps/dir//+{{json_decode($geometry->coordinates,true)['1']}}+,+{{json_decode($geometry->coordinates,true)['0']}}" target="_blank">
                                    See on the map
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
        @if(isset($geometries))
            {{ $geometries->links() }}
        @endif

    </div>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</form>
</body>

<script>
    $(".js-example-placeholder-multiple").select2({
        placeholder: "Выберете природные явления",
    });

</script>

</html>

