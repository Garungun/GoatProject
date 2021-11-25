@extends('layouts.app')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <script src="https://unpkg.com/feather-icons"></script>
        <script src="js/bootstrap.js"></script>
        <script src="path/to/dist/feather.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

        <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/carousel/">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link href="https://getbootstrap.com/docs/5.0/examples/carousel/carousel.css" rel="stylesheet">
        <link rel="stylesheet" href="resources/css/style.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}" type="text/javascript"></script>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


        <style>
            .header {
                padding: 10px;
                margin-top: 20px;
                text-align: center;
            }

            .profile_image {
                margin: 2em;
            }

            .profile_image img {
                border-radius: 50%;
            }

            .container {
                margin-top: auto;
            }

            .row {
                position: relative;
                left: 750px;
            }

            tr:hover {
                background-color: #80C2B6;
            }

            .h2 {
                margin-top: 50px;
            }

            .row2 {
                border: 0px solid #80C2B6;
                margin: 0 auto;
                max-width: 960px;
                border-radius: 0px;
                border-top-width: 0px;
                padding: 5px;
                text-align: center;
                justify-content: center;
            }
            #goats {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #goats td,
            #goats th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #goats tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #goats tr:hover {
                background-color: #ddd;
            }

            #goats th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #80C2B6;
                color: white;
            }



            .row3 {
                text-align: center;
                justify-content: center;
            }

            .row4 {
                position: relative;
                top: -30px;
                width: 300px;
            }
            

        </style>

    </head>

    <body>
        <div class="container mt-2">
            <div class="header">
                <h2>ทะเบียนข้อมูลน้ำหนัก</h2>
            </div>

                <div class="container mt-2">
                    <table id="goats">
                        <thead>
                            <tr>
                                <th>รหัสประจำตัวเเพะ</th>
                                <th>ระยะเวลา</th>
                                <th>น้ำหนัก ก.ก.</th>
                                <th width="305px">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($weight as $weight)
                                <tr>
                                    <td>{{ $weight->goat_id }}</td>                                    
                                    <td>{{ $weight->timePeriod }}</td>
                                    <td>{{ $weight->weight }}</td>
                                    <td>
                                        <form action="{{ route('goats.destroyWeight',$weight->weightId) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">ลบข้อมูล</button>
                                        </form>
                                    </td>


                                </tr>


                            @endforeach
                        </tbody>




                    </table>
            </form>


    </body>

    </html>