@extends('layouts.main-layout')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Add new Student mark</h5>
            <a href="{{route('stutdent.index')}}" class="btn btn-sm btn-primary">Home</a>
        </div>

        <div class="card-body">
            <form action="{{ route('stutdent.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="student_name" class="form-label">Student Name</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" value="{{ old('student_name') }}">
                    @error('student_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Mark</label>
                                    <input type="number" class="form-control mark" name="mark[]">
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
            },
            addNewInput: function() {
                newRowAdd = $('#subjectDiv').clone();
                newRowAdd.find('.mark').val('');
                $('#check').append(newRowAdd);
            },
            removeInput: function() {
                $(this).parents("#subjectDiv").remove();
            }
        }

        app.initalize();
    </script>
@endpush
