<!DOCTYPE html>
<thml lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width , initial-scale=1.0">

    <title>Laravel CRUD Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>

<div class="container mt-2">
    <div class="row">
        <div class=col-lg-12>
            <h2>Edit Company</h2>
        </div>
        <div>
            <a href="{{ route('companies.index')}}" class="btn btn-primary">Back</a>
        </div>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif

        <form action="{{ Route('companies.update', $company->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @Method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <strong>Company Name</strong>
                        <input type="text" name="username"  value="{{$company->username}}"  class="form-control" placeholder="Enter CompanyName">
                        @error('name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <strong>Company Email</strong>
                        <input type="email" name="email" value="{{$company->email}}" class="form-control" placeholder="Enter CompanyEmail">
                        @error('username')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <strong>Company Address</strong>
                        <input type="text" name="address" value="{{$company->address}}" class="form-control" placeholder="Enter NewCompanyAddress">
                        @error('address')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <strong>Company Password</strong>
                        <input type="text" name="password"  class="form-control" placeholder="Enter Newpassword">
                        {{-- @error('password')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror --}}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>

</thml>