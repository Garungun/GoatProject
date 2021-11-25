@extends('layouts.app')

@section('content')

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">

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


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            .row {
                background-color: #80C2B6;
                margin: auto;
                margin-top: 25px;
                max-width: 400px;
                border-radius: 10px;
                border-top-width: 60px;
                border-bottom-width: 20px;
                padding: 5px;
                width: auto;
            }
            h4 {
                text-align: center;
                padding: 5px;
            }
            .pull-center{
                text-align: center;
                margin-top: 14px;
                width: 250px;
            }
            .btn-close {
                box-sizing: content-box;
                width: 1em;
                height: 1em;
                padding: .25em .25em;
                color: #000;
            }
            
        </style>
    </head>

    <body>

        <div class="container mt-2">
            <div class="row">
                
            <a class="btn-close" aria-label="Close" href="{{ route('goats.index') }}" role="button"></a>
        
                <h4>แสดงข้อมูล</h4>

                <div class="pull-center row">
                    <a class="btn btn-light"
                    href="{{ route('goats.show', $goat->goatId) }}">ข้อมูลทั้งหมด</a>
                </div>

                <div class="pull-center row">
                    <a class="btn btn-light"
                    href="{{ route('goats.indexHealth', $goat->goatId) }}">ข้อมูลสุขภาพ</a>
                </div>

                <div class="pull-center row">
                    <a class="btn btn-light"
                    href="{{ route('goats.indexVaccine', $goat->goatId) }}">ข้อมูลการฉีดวัคซีน</a>
                </div>

                <div class="pull-center row">
                    <a class="btn btn-light"
                    href="{{ route('goats.indexWeight', $goat->goatId) }}">ข้อมูลการเจริญเติบโต</a>
                </div>

                <div class="pull-center row">
                    <a class="btn btn-light"
                    href="{{ route('goats.indexMedical', $goat->goatId) }}">ข้อมูลการตรวจโรคประจำปี</a>
                </div>
                @if($goat->sex == 'เพศเมีย')
                <div class="pull-center row">
                    <a class="btn btn-light"
                    href="{{ route('goats.indexBreed', $goat->goatId) }}">ข้อมูลการผสมพันธุ์ของแม่พันธ์ุ</a>                    
                </div>
                @else

                @endif
            </div>
        </div>
        </body>

    </html>
@endsection

