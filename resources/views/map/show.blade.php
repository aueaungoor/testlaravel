<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Styled Table</title>

    <!-- ✅ เพิ่ม Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ เพิ่ม CSS แบบกำหนดเอง -->
    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Arial', sans-serif;
            padding: 20px;
        }
        
        .container {
            max-width: 900px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #333;
        }

        .table {
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            border-collapse: collapse;
        }

        .table th {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 12px;
        }

        .table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table tbody tr:hover {
            background: #f1f1f1;
            transition: 0.3s;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body> 

    <div class="container">
        <h2>🌍 Location Data</h2>
        <div>
            <a href="{{ route('map.index')}}" class="btn btn-success">Back to add more location</a>
             <a href="{{ route('map.pagesall')}}" class="btn btn-success">See All Mark</a>
             <a href="{{ route('map.realtime')}}" class="btn btn-success">Goodle Realtime</a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($map as $cm)
                <tr>
                    <td>{{$cm->id_user}}</td>
                    <td>{{$cm->fname}}</td>
                    <td>{{$cm->lname}}</td>
                    <td>{{$cm->lat}}</td>
                    <td>{{$cm->lng}}</td>
                    <td><a href="
                        {{ route('map.select_mark' , ['lat' => $cm->lat , 'lng' => $cm->lng])}}"
                         class="btn btn-primary">
                         Show Route
                         </a>
                </tr>   
                @endforeach
            </tbody>
        </table>

        <!-- ✅ Pagination -->
        <div class="pagination">
            {!! $map->links('pagination::bootstrap-4') !!}
        </div>
    </div>

   
