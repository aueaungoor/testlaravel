<!DOCTYPE html>
<thml lang="en">
<head>
    
   
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">

    <title>Laravel CRUD Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Laravel 9 CRUD Example</h2>
            </div>
            @if(Auth::check())
            <a href="{{ route('login.logout') }}">Logout</a>
            @else
                <a href="{{ route('login.form_login') }}">Login</a>
            @endif
        
           
                <div>
                    <a href="{{ route('companies.create')}}" class="btn btn-success">Create Company</a>
                    <a  style="margin-left:1%"href="{{ route('map.index')}}" class="btn btn-success">Map</a>
                </div>
    
                @if($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
    
                @endif
                <table class="table table-bordered">
                    <tr>
                        <td>No.</td>
                        <td>Company Name</td>
                        <td>Company Email</td>
                        <td>Company Address</td>
                        <td>Role</td>
                        <td width="280px">Action</td>
                    </tr>
    
                    @foreach ($companies as $cm )
                    <tr>
                        <td>{{$cm->id}}</td>
                        
                        <td>{{$cm->username}}</td>
                        <td>{{$cm->email}}</td>
                        <td>{{$cm->address}}</td> 
                        @if($cm->role == "user")
                        <td>user</td>
                        @elseif($cm->role == "chef")
                            <td>chef</td>
                        @else
                            <td>shop</td>
                        @endif
                        <td>
                            <!-- ปุ่ม Edit -->
                        <a href="{{ route('companies.edit', ['company' => $cm->id]) }}" class="btn btn-warning">Edit</a>

                        <!-- ฟอร์ม Delete -->
                         <form action="{{ route('companies.destroy', ['company' => $cm->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
    
                            
                        </td>
                    </tr>
                    @endforeach
                </table>
    
                {!! $companies->links('pagination::bootstrap-4') !!}


        </div>
    </div>
</head>


</thml>