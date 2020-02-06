<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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
            form{
                display:flex;
            }
            .alert-success p{
                color: green;
            }
            .alert-danger li{
                color: red;
            }
            td{
                text-align:left;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <!-- shows success upload or failor -->
                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{$message}}</p>
                </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="upload" enctype="multipart/form-data" method="POST">
                        <label for="file">
                            <input type="file" name="file" id="file">
                            <!-- for uploading multiple files -->
                            <!-- <input type="file" name="files[]" id="file" multiple> -->
                        </label>
                    {{ csrf_field() }}
                    <button class="btn btn-primary">Upload file</button>
                </form>
                <hr>
                
                <table>
                    <tr>
                        <td><b>Files</b></td>
                        <td><b>Actions</b></td>
                    </tr>
                    @foreach($files as $file)
                    <tr><td>{{ $file ?? '' }}</td>
                        <td>
                            <form action="download/{{$file}}" method="GET">
                                <button class="btn btn-sm btn-default" type="submit">Download</button>
                            </form> 
                        </td>
                        <td>
                            <form action="delete/{{$file}}" method="GET">
                                <button class="btn btn-sm btn-danger" type="submit" id="deletefile">Delete</button>
                            </form> 
                        </td>
                    </tr>
                    @endforeach
                </table>

            </div>
        </div>
<script>
   setTimeout(function() {
        $('.alert-success').css('display','none');
    }, 500);

    $(document).ready(function($) {
      $('#deletefile').on("submit", function(e){
        if(!confirm('Are you sure, you want to delete?')){
          e.preventDefault();
        }
      });
    });
</script>
    </body>
</html>
