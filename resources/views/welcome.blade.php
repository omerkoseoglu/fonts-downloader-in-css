<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Font downloader in css</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- DevExtreme theme -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/21.2.7/css/dx.light.css">
    <!-- DevExtreme library -->
    <!-- <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.2.7/js/dx.web.js"></script> -->
    <!-- <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.2.7/js/dx.viz.js"></script> -->
</head>
<body class="dx-viewport">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Font downloader in css</h1>
            </div>
            <div class="col-12">
                <form id="form" action="{{ route('download-fonts') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($msg = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $msg }}</strong>
                        </div>
                        <div>
                            @foreach(Session::get('fontFiles') as $fontFileUrl)
                                <p>{{ $fontFileUrl }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div id="file-uploader-max-size"></div>
                    <div id="upload-button"></div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/21.2.7/js/dx.all.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#file-uploader-max-size').dxFileUploader({
                multiple: true,
                uploadMode: 'useForm',
                uploadUrl: '{{ route('download-fonts') }}',
                maxFileSize: 4000000,
            });

            $('#upload-button').dxButton({
                text: 'Download Fonts',
                type: 'success',
                onClick() {
                    $("#form").submit();
                },
            });
        });
    </script>
</body>
</html>
