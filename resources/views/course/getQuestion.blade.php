@extends('welcome')
@section('title', 'Tạo câu hỏi cho buổi học')
@section('content')
    <div class="col-md-12">
        
        <form action="{{ route('course.addQuestion') }}" method="POST">
            @csrf
            <div class="d-flex justify-content-between">
                
                <a href="#" class="btn btn-primary p-2 d-flex align-items-center" onclick="Add()">
                    Tạo câu hỏi
                </a>
                <button type="submit" class="btn btn-info p-2 mt-2">Lưu</button>
            </div>
            <div class="row">
                <input type="hidden" name="course_data_id" value="{{ $id }}">
                <table class="table mt-3">
                    <tr>
                        <th>STT</th>
                        <th>Câu hỏi</th>
                        <th>A</th>
                        <th>B</th>
                        <th>C</th>
                        <th>D</th>
                        <th>Đáp án</th>
                        <th></th>

                    </tr>

                    <tbody id="body">
                        @php 
                        $sum = 0; 
                        @endphp

                        @foreach($data as $key => $value)
                            @php 
                                $sum = $sum + 1; 
                            @endphp
                            <tr>
                            <td class="index">
                                {{ $key + 1 }}
                            </td>
                            <td><input type="text" name="question_content[]" class="form-control" value="{{ $value->question_content }}" required></td>
                            <td><input type="text" name="A[]" class="form-control" value="{{ $value->A }}" required></td>
                            <td><input type="text" name="B[]" class="form-control" value="{{ $value->B }}" required></td>
                            <td><input type="text" name="C[]" class="form-control" value="{{ $value->C }}" required></td>
                            <td><input type="text" name="D[]" class="form-control" value="{{ $value->D }}" required></td>
                            <td>
                                <select name="answer[]" class="form-control" id="" required>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                            </td>
                            <td>
                                <a href="#" class="btn btn-danger remove-btn p-1"><i class="fa fa-trash"></i></a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script>
        var i = {{ $sum + 1 }};

        function Add() {
            html = ` <tr>
                        <td class="index">` + (i++) + `</td>
                        <td><input type="text" name="question_content[]" class="form-control" required></td>
                        <td><input type="text" name="A[]" class="form-control" required></td>
                        <td><input type="text" name="B[]" class="form-control" required></td>
                        <td><input type="text" name="C[]" class="form-control" required></td>
                        <td><input type="text" name="D[]" class="form-control" required></td>
                        <td>
                            <select name="answer[]" class="form-control" id="" required>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger remove-btn p-1" ><i class="fa fa-trash"></i></a>
                        </td>




                    </tr> `;
            $('#body').append(html);
        }
        $(document).on('click', '.remove-btn', function() {
            $(this).closest('tr').remove(); // Xóa dòng hiện tại


            i = 1;
            $('#body tr').each(function() {
                $(this).find('.index').text(i++);
            });
        });
    </script>

@endsection
