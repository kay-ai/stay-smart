@extends('layouts.app')
@section('title', 'Upload CSV File')

@section('content')
<!--start content-->
<main class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Upload CSV FIle</h4>
                <form method="post" action="{{route('admin.csvUpload')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Upload CSV File</label>
                        <input type="file" class="form-control" id="csv-file" name="csv_file" required>
                    </div>

                    <div class="form-group mb-3">
                        <button class="btn btn-primary" type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection
