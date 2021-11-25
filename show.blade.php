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
        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            .mt-2 {
                margin-top: .5rem
            }

            .mr-2 {
                margin-right: .5rem
            }

            .ml-2 {
                margin-left: .5rem
            }

            .mt-4 {
                margin-top: 1rem
            }

            .ml-4 {
                margin-left: 1rem
            }

            .mt-8 {
                margin-top: 2rem
            }

            .ml-12 {
                margin-left: 3rem
            }

            .-mt-px {
                margin-top: -1px
            }

            .grid-cols-1 {
                grid-template-columns: repeat(1, minmax(0, 1fr))
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
            integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

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

            .row {
                position: relative;
                right: 10px;
            }

            .h2 {
                margin-top: 50px;
            }

            .h5 {
                margin-top: 50px;
                text-align: center;
            }

            .child {
                position: absolute;
                left: 20;

            }

            .container mt-2 {
                margin: 0 auto;
            }

            .child1 {
                position: absolute;
                transform: translate(0%, 0%);
                right: 50%;

            }

            .child2 {
                position: absolute;
                bottom: -50%;
                text-align: center;
            }

            .dropdown-menu {
                margin: 0px;
                padding: 0;
            }

            .row {
                border: 0px solid #80C2B6;
                margin: 0 auto;
                max-width: 960px;
                border-radius: 0px;
                border-top-width: 0px;
                padding: 5px;
                text-align: center;
                justify-content: center;

            }

            .grid {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                column-gap: 15px;
                row-gap: 5px;
            }

            h4 {
                text-align: center;
            }

            .submit {
                text-align: center;
            }

            .flex-container {
                display: flex;
            }

            .flex-container>div {
                margin: 10px;
                padding: 20px;
                font-size: 0.9rem;
            }
            .buttom{
                text-align: center;
            }


        </style>

    </head>

    <body>
        <div class="container mt-2">
            <div class="header">
                <h2>ทะเบียนเเพะ</h2>
            </div>
            <br>
            <div class="flex-container">
                @foreach ($goats as $goat)
                    <div class="form-group mb-2">
                        <strong>รูปแพะ :</strong>
                        <img src="{{ Storage::url($goat->image) }}" height="200" width="200" alt="" /></p>
                    </div>
                @endforeach

                <div class="container mt-2">
                    <div class="row">
                        <div class="col-md-auto">
                            <div class="grid">
                                @foreach ($goats as $goat)
                                    <div class="form-group mb-2">
                                        <strong>รหัสประจำตัวแพะ :</strong> {{ $goat->goatId }}
                                    </div>
                                    <div class="form-group mb-2">
                                        <strong>ชื่อแพะ :</strong> {{ $goat->goatName }}
                                    </div>
                                    <div class="form-group mb-2">
                                        <strong>เพศ : </strong> {{ $goat->sex }}
                                    </div>
                                    <div class="form-group mb-2">
                                        <strong>พันธุ์ :</strong> {{ $goat->gene }}
                                    </div>
                                    <div class="form-group mb-2">
                                        <strong>สี :</strong> {{ $goat->colour }}
                                    </div>
                                    <div class="form-group mb-2">
                                        <strong>วัน/เดือน/ปีเกิด (พ.ศ.) :</strong> {{ $goat->dateOfBirth }}
                                    </div>
                                    <div class="form-group mb-2">
                                        <strong>น้ำหนักแรกเกิด (ก.ก.) :</strong> {{ $goat->weightOfBirth }}
                                    </div>
                                    <div class="form-group mb-2">
                                        <strong>วัน/เดือน/ปี ที่มาถึง :</strong> {{ $goat->arrivalDate }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @foreach ($goats as $goat)
                <h4>พ่อพันธุ์เเม่พันธุ์เเพะ</h4>
                    <div class="row">
                        <div class="col-md-auto">
                            <div class="grid">
                                <div class="form-group mb-2">
                                    <strong>รหัสพ่อเเพะ :</strong> {{ $goat->fatherId }}
                                </div>
                                <div class="form-group mb-2">
                                    <strong>ชื่อพ่อเเพะ :</strong> {{ $goat->fatherGoatName }}
                                </div>
                                <div class="form-group mb-2">
                                    <strong>พันธุ์:</strong> {{ $goat->fatherGene }}
                                </div>
                                <div class="form-group mb-2">
                                    <strong>รหัสเเม่เเพะ :</strong> {{ $goat->motherId }}
                                </div>
                                <div class="form-group mb-2">
                                    <strong>ชื่อเเม่เเพะ :</strong> {{ $goat->motherGoatName }}
                                </div>
                                <div class="form-group mb-2">
                                    <strong>พันธุ์ :</strong> {{ $goat->motherGene }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if($goat->sex == 'เพศเมีย')
                <br>
                <h4>ข้อมูลการผสมพันธุ์</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ผสมพันธุ์ครั้งที่ </th>
                            <th>วัน/เดือน/ปีที่ผสม</th>
                            <th>พ่อพันธุ์เเพะ</th>
                            <th>เจ้าหน้าที่</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @foreach ($breeding as $breeding)
                            <tr>
                                <td>{{ $breeding->breedNo }}</td>
                                <td>{{ $breeding->dateOfBreed }}</td>
                                <td>{{ $breeding->father_breeder }}</td>
                                <td>{{ $breeding->breed_staff }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
                @else 

                @endif
                <br>
                <h4>ข้อมูลการเจริญเติบโต</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ระยะเวลา </th>
                            <th>น้ำหนัก ก.ก.</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @foreach ($weight as $weight)
                            <tr>
                                <td>{{ $weight->timePeriod }}</td>
                                <td>{{ $weight->weight }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
                <br>
                <h4>ข้อมูลการฉีดวัคซีน</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ชนิดวัคซีน </th>
                            <th>วัน/เดือน/ปี</th>
                            <th>ผู้ฉีด</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @foreach ($vaccination as $vaccination)
                            <tr>
                                <td>{{ $vaccination->typeOfVaccine }}</td>
                                <td>{{ $vaccination->dateOfVaccine }}</td>
                                <td>{{ $vaccination->vaccine_staff }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
                <br>
                <h4>ข้อมูลสุขภาพ</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>อาการ </th>
                            <th>วัน/เดือน/ปี ที่เข้ารักษา</th>
                            <th>ผู้รักษา</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @foreach ($health as $health)
                            <tr>
                                <td>{{ $health->attitude }}</td>
                                <td>{{ $health->dateOfHealth }}</td>
                                <td>{{ $health->health_staff }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
                <br>
                <h4>ข้อมูลการตรวจโรคประจำปี</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>วัน/เดือน/ปี </th>
                            <th>โรคที่ตรวจ</th>
                            <th>ผลการตรวจโรค</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tbody>
                        @foreach ($medical as $medical)
                            <tr>
                                <td>{{ $medical->dateExamination }}</td>
                                <td>{{ $medical->typeOfDisease }}</td>
                                <td>{{ $medical->result }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    </tbody>
                </table>
                <div class="buttom">
                <button type="button" name="Button" id="print"
                    onclick="javascript:this.style.display='none';window.print();">พิมพ์เอกสาร</button>
                </div>
    </body>

    </html>