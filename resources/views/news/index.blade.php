@extends('welcome')
@section('title', 'Bài viết')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">

                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#staticBackdrop">
                            Thêm mới
                        </button>
                    </div>
                    <table id="table_id" class="display">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên bài viết</th>
                                <th>Hình ảnh</th>
                                <th>Thuộc danh mục</th>

                                <th>Mô tả ngắn</th>
                                <th>Trạng thái</th>
                                <th class="text-center"><i class="fa fa-asterisk"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($query as $key => $que)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $que->title }}</td>
                                    <td><img src="{{ asset($que->images) }}" alt="" width="70" height="70">
                                    </td>
                                    <td>{{ $que->CategoryNew->name }}</td>
                                    <td>{{ $que->short_desc }}</td>
                                    <td>
                                        @if ($que->status == 1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Không hoạt động</span>
                                        @endif
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-info p-1" data-toggle="modal"
                                            data-target="#exampleModal{{ $que->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a href="{{ route('new.destroy', $que->id) }}" class="btn btn-danger p-1">
                                            <i
                                                class="fa fa-trash"></i></a>
                                    </td>


                                </tr>
                            @endforeach

                            <div class="modal fade" id="exampleModal{{ $que->id }}" data-backdrop="static"
                                data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog  modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Thêm danh mục bài viết</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('new.update') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body" style="height:70vh; overflow:auto;">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" value ="{{ $que->id }}">
                                                            <label for="title">Tên bài viết</label>
                                                            <input type="text" class="form-control" name="title"
                                                                placeholder="Nhập tên danh mục" value="{{ $que->title }}"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Nhóm bài viết</label>
                                                            <select name="category_news_id" id=""
                                                                class="form-control" required>
                                                                <option value=""> - - - Chọn nhóm bài viết - - -
                                                                </option>
                                                                @foreach ($CategoryNew as $Category)
                                                                    <option value="{{ $Category->id }}"
                                                                        @if ((int) $que->cate_new_id == (int) $Category->id) selected @endif>
                                                                        {{ $Category->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Hình ảnh</label>
                                                            <input type="file" class="form-control" name="images"
                                                                id="image" accept="image/*"
                                                                onchange="previewImage(event)">
                                                        </div>

                                                        <!-- Image preview area -->
                                                        <div class="form-group">
                                                            <label>Hình ảnh xem trước</label>
                                                            <div id="imagePreview"
                                                                style="max-width: 300px; max-height: 300px; overflow: hidden;">
                                                                <img id="imagePreviewImg" src="{{ asset($que->images) }}"
                                                                    alt="Image Preview" style=" width: 100%; height: auto;">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="short_desc">Mô tả ngắn</label>
                                                            <textarea class="form-control" name="short_desc" placeholder="Nhập mô tả" rows="5" value="{{ $que->short_desc }}"
                                                                required>{{ $que->short_desc }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Mô tả <span
                                                                    class="text-danger">*</span></label>
                                                            <div>
                                                                <textarea id="summernote" name="description" value="{{ $que->description }}">
                                                                {{ $que->description }}
                                                            </textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status">Trạng thái</label>
                                                            <select name="status" id="" class="form-control"
                                                                required>
                                                                <option value="1" {{ $que->status == 1?'selected' : '' }}>Hoạt động</option>
                                                                <option value="2" {{ $que->status == 2?'selected' : '' }}>Không hoạt động</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Đóng</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>

                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Thêm danh mục bài viết</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('new.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body" style="height:70vh; overflow:auto;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title">Tên bài viết</label>
                                                    <input type="text" class="form-control" name="title"
                                                        placeholder="Nhập tên danh mục" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Nhóm bài viết</label>
                                                    <select name="category_news_id" id="" class="form-control"
                                                        required>
                                                        <option value=""> - - - Chọn nhóm bài viết - - -</option>
                                                        @foreach ($CategoryNew as $Category)
                                                            <option value="{{ $Category->id }}">{{ $Category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Hình ảnh</label>
                                                    <input type="file" class="form-control" name="images"
                                                        id="image" accept="image/*" onchange="previewImage(event)">
                                                </div>

                                                <!-- Image preview area -->
                                                <div class="form-group">
                                                    <label>Hình ảnh xem trước</label>
                                                    <div id="imagePreview"
                                                        style="max-width: 300px; max-height: 300px; overflow: hidden;">
                                                        <img id="imagePreviewImg" src="#" alt="Image Preview"
                                                            style="display: none; width: 100%; height: auto;">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="short_desc">Mô tả ngắn</label>
                                                    <textarea class="form-control" name="short_desc" placeholder="Nhập mô tả" rows="5" required></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Mô tả <span
                                                            class="text-danger">*</span></label>
                                                    <div>
                                                        <textarea id="summernote" name="description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Trạng thái</label>
                                                    <select name="status" id="" class="form-control" required>
                                                        <option value="1">Hoạt động</option>
                                                        <option value="2">Không hoạt động</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Đóng</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#table_id').dataTable({
            language: {
                search: "Tìm kiếm:",
                lengthMenu: "Hiển thị _MENU_ độ dài trang",
                info: "Hiển thị _START_ đến _END_ trong tổng số _TOTAL_ mục",

            }
        });
    </script>
    <script>
        CKEDITOR.replace('summernote', {
            height: 300,


        });
    </script>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const imagePreview = document.getElementById('imagePreviewImg');
                imagePreview.src = reader.result;
                imagePreview.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
