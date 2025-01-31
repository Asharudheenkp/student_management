@extends('layouts.main-layout')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Student mark list</h1>
            <a class="btn btn-primary mb-3" href="{{ route('stutdent.create') }}">Add new mark</a>

        </div>

        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Mark</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($studentMarks as $student)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $student->student_name }}</td>
                            <td>{{ $student->subject->subject_name }}</td>
                            <td>{{ $student->mark }}</td>
                            <td>
                                <form action="{{ route('stutdent.destroy', $student->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="6">No data found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



    {{ $studentMarks->links('pagination::bootstrap-5') }}
@endsection
