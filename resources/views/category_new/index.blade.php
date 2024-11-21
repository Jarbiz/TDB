@extends('welcome')
@section('title', 'Danh mục bài viết')
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
                                <th>Tên</th>
                                <th>Ghi chú</th>
                                <th>Trạng thái</th>

                                <th class="text-center"><i class="fa fa-asterisk"></i></th>


                            </tr>
                        </thead>
                        <tbody>
                            @foreach($CategoryNew  as $key => $category)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>
                                        @if($category->status == 1)
                                            <span class="badge badge-success">Hoạt động</span>
                                        @else
                                            <span class="badge badge-danger">Không hoạt động</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info p-1" data-toggle="modal" data-target="#exampleModal{{ $category->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <a class="btn btn-danger p-1" href="{{ route('category_new.delete',$category->id) }}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>


                                </tr>
                                <div class="modal fade" id="exampleModal{{ $category->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog ">
                                      <div class="modal-content ">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa danh mục</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <form action="{{ route('category_new.update') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <div class="form-group">
                                                            <label for="name">Tên danh mục</label>
                                                            <input type="text" class="form-control" name="name" 
                                                            placeholder="Nhập tên danh mục" value="{{ $category->name  }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Mô tả</label>
                                                            <textarea class="form-control" name="description" placeholder="Nhập mô tả" rows="5" value="{{ $category->description  }}">{{ $category->description  }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="description">Trạng thái</label>
                                                            <select name="status" id="" class="form-control">
                                                                <option value="1" {{ $category->status == 1?'selected' : '' }}>Hoạt động</option>
                                                                <option value="2" {{ $category->status == 2?'selected' : '' }}>Không hoạt động</option>
                                                            </select>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Lưu</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                            @endforeach
                          
                        </tbody>
                    </table>

                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="staticBackdropLabel">Thêm danh mục bài viết</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <form action="{{ route('category_new.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                          
                                            <div class="form-group">
                                                <label for="name">Tên danh mục</label>
                                                <input type="text" class="form-control" name="name" 
                                                placeholder="Nhập tên danh mục" >
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Mô tả</label>
                                                <textarea class="form-control" name="description" placeholder="Nhập mô tả" rows="5" ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Trạng thái</label>
                                                <select name="status" id="" class="form-control">
                                                    <option value="1" >Hoạt động</option>
                                                    <option value="2" >Không hoạt động</option>
                                                </select>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Lưu</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                
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

@endsection
