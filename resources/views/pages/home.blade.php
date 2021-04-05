@extends('layouts.main')

@section('title', 'Home')

@section('custom-css')
@endsection

@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h4>Форма відправки заявки з можливісттю перегляду обраних файлів і їх видалення перед відправкою</h2>
        </div>
        <div class="row">
            <div class="col-md-12 order-md-1">
                <form method="post" action="{{ route('send') }}" id="send" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" value="" required="">
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="custom-file">
                        <input type="file" id="file-input" class="custom-file-input" name="upload_files[]" multiple>
                        <label class="custom-file-label">Upload Images</label>
                    </div>
                    <div class="appload_files_grid">
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Continue</button>
                </form>
            </div>
        </div>
        <div class="my-5 pt-5 text-muted text-center text-small"></div>
    </div>
@endsection

@section('custom-js')
<script>
    $(document).ready(function() {

        $('#file-input').change(function() {
            let files = this.files;
            sendFiles(files);
        });
        function sendFiles(files) {
            let maxFileSize = 5242880;
            let Data = new FormData();

            $(files).each(function(index, file) {
                if ((file.size <= maxFileSize) && (files.length <= 3) && ((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
                    Data.append('images[]', file);
                }
            });

            $.ajax({
                url: "{{route('getUploadedFiles')}}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: Data,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('.appload_files_grid').html(data);

                    var input = $("<input>").attr("name", "mydata").val("go Rafa!");
                    $('#send').append(input);
                },
                error: function(data){
                    var errors = data.responseJSON;
                    console.log(errors);
                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    errorsHtml += '<li> Максимальний розмір файлу: 5242880 </li>';
                    errorsHtml += '<li> Максимальна кількість файлів:3 </li>';
                    errorsHtml += '</ul></div>';

                    $( '.appload_files_grid' ).html( errorsHtml );
                }
            });
        };
    });
</script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
@endsection
