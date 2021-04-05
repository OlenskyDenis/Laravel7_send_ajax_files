@foreach ( $files as $file)
    <div class="w-100">
        <div class="upload-images d-flex">
            <div class="ml-3 mt-2">
                <img src="/storage/{{ $file[0] }}" alt="img" class="col-md-3 mb-3">
                <h6 class="mb-0 mt-3 font-weight-bold">{{ $file[1] }}</h6>
            </div>
            <div class="float-right ml-auto">
                <a class="float-right btn btn-icon btn-danger btn-sm mt-5 delete_file"><i class="fa fa-trash-o"></i></a>
            </div>
        </div>
    </div>
@endforeach

