@extends('layouts.main-layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Add new Student mark</h5>
            <a href="{{route('stutdent.index')}}" class="btn btn-sm btn-primary">Home</a>
        </div>

        <div class="card-body">
            <form action="{{ route('stutdent.store') }}" method="POST" id="studentMarkForm">
                @csrf
                <div class="mb-3">
                    <label for="student_name" class="form-label">Student Name</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" value="{{ old('student_name') }}">
                    <span class="text-danger error" id="error-student_name"></span>
                </div>
                <div id="check">
                    <div id="subjectDiv" class="subjectDiv">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Subject</label>
                                    <select name="subject_id[]" class="form-control">
                                        <option value="">Select subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error error-subject_id" id="error-subject_id_0"></span>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Mark</label>
                                    <input type="number" class="form-control mark" name="mark[]">
                                    <span class="text-danger error error-mark" id="error-mark_0"></span>
                                </div>
                            </div>

                            <div class="col-md-2 mt-4">
                                <button id="DeleteRow" class="btn btn-danger btn-sm">remove</button>
                            </div>
                        </div>

                    </div>
                </div>

                <button type="button" id="addMore" class="btn btn-secondary btn-sm">Add more subject</button>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        let app = {
            initalize: function() {
                $("#addMore").click(app.addNewInput);
                $("body").on("click", "#DeleteRow", app.removeInput);
                $('#studentMarkForm').on('submit', app.submitForm);
            },
            addNewInput: function() {
                let totalRowCount = $('.subjectDiv').length
                newRowAdd = $('#subjectDiv').clone();
                newRowAdd.find('.mark').val('');
                newRowAdd.find('.error').html('');
                console.log(totalRowCount);

                newRowAdd.find('.error-subject_id').attr('id', 'error-subject_id_'+totalRowCount);
                newRowAdd.find('.error-mark').attr('id', 'error-mark_'+totalRowCount);

                $('#check').append(newRowAdd);
            },
            removeInput: function() {
                let totalRowCount = $('.subjectDiv').length
                if (totalRowCount > 1) {
                    $(this).parents("#subjectDiv").remove();
                    $.each($('.subjectDiv'), function() {
                        let index = $(this).index();
                        $(this).find('.error-subject_id').attr('id', 'error-subject_id_'+index);
                        $(this).find('.error-mark').attr('id', 'error-mark_'+index);
                    })
                } else {
                    alert('At least one subject should be added');
                }
            },
            submitForm: function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('stutdent.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status) {
                            window.location.href = response.url;
                        }
                    },
                    error: function(response) {
                        let error = response.responseJSON;
                        if (error.errors) {
                            app.showValidationError(error.errors)
                        }

                    }
                });
            },
            showValidationError: function(errors) {
                $('.error').html('');
                $.each(errors, function(error, message) {
                    let errorInput = error.split('.');
                    inputField = '#error-'+errorInput;
                    if (errorInput.length > 1) {
                        inputField = '#error-'+errorInput[0]+'_'+errorInput[1];
                    }

                    $(inputField).html(message[0]);
                 })
            }
        }

        app.initalize();
    </script>
@endpush
