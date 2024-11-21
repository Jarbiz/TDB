@extends('welcome')

@section('title', 'Danh sách khuyến mãi')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>
        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .width-90 {
            width: 90px !important;
        }

        .rounded-3 {
            border-radius: 0.5rem !important;
        }

        a {
            text-decoration: none;
        }

        .timeline {
            position: relative;
            padding: 20px 0;
            list-style: none;
            max-width: 1200px;
            margin: 0 auto;
        }

        .timeline:before {
            content: " ";
            position: absolute;
            top: 0;
            bottom: 0;
            left: 50%;
            width: 3px;
            margin-left: -1.5px;
            background-color: #e9ecef;
        }

        .timeline>.timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline>.timeline-item:after,
        .timeline>.timeline-item:before {
            content: " ";
            display: table;
        }

        .timeline>.timeline-item:after {
            clear: both;
        }

        .timeline>.timeline-item>.timeline-panel {
            float: left;
            position: relative;
            width: 46%;
            padding: 20px;
            border: 1px solid #e9ecef;
            border-radius: 2px;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
        }

        .timeline>.timeline-item>.timeline-panel:before {
            content: " ";
            display: inline-block;
            position: absolute;
            top: 26px;
            right: -8px;
            border-color: transparent #e9ecef;
            border-style: solid;
            border-width: 8px 0 8px 8px;
        }

        .timeline>.timeline-item>.timeline-panel:after {
            content: " ";
            display: inline-block;
            position: absolute;
            top: 27px;
            right: -7px;
            border-color: transparent #fff;
            border-style: solid;
            border-width: 7px 0 7px 7px;
        }

        .timeline>.timeline-item>.timeline-badge {
            z-index: 10;
            position: absolute;
            top: 16px;
            left: 50%;
            width: 55px;
            height: 55px;
            margin-left: -25px;
            border-radius: 50% 50% 50% 50%;
            text-align: center;
            font-size: 1.4em;
            line-height: 50px;
            color: #fff;
            overflow: hidden;
        }

        .timeline>.timeline-item.timeline-inverted>.timeline-panel {
            float: right;
        }

        .timeline>.timeline-item.timeline-inverted>.timeline-panel:before {
            right: auto;
            left: -8px;
            border-right-width: 8px;
            border-left-width: 0;
        }

        .timeline>.timeline-item.timeline-inverted>.timeline-panel:after {
            right: auto;
            left: -7px;
            border-right-width: 7px;
            border-left-width: 0;
        }

        .timeline-badge.primary {
            background-color: #7460ee;
        }

        .timeline-badge.success {
            background-color: #39c449;
        }

        .timeline-badge.warning {
            background-color: #ffbc34;
        }

        .timeline-badge.danger {
            background-color: #f62d51;
        }

        .timeline-badge.info {
            background-color: #009efb;
        }

        .timeline-title {
            margin-top: 0;
            color: inherit;
            font-weight: 400;
        }

        .timeline-body>p,
        .timeline-body>ul {
            margin-bottom: 0;
        }

        .timeline-left:before {
            left: 30px;
        }

        .timeline-left>.timeline-item>.timeline-badge {
            left: 30px;
            top: 9px;
        }

        .timeline-left>.timeline-item>.timeline-panel {
            width: calc(100% - 80px);
        }

        .timeline-right:before {
            right: 30px;
            left: auto;
        }

        .timeline-right>.timeline-item>.timeline-badge {
            right: 5px;
            top: 9px;
            left: auto;
        }

        .timeline-right>.timeline-item>.timeline-panel {
            width: calc(100% - 80px);
        }
    </style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div id="msg-box">
                            <?php //Hiển thị thông báo thành công
                            ?>
                            @if (Session::has('success'))
                                <div class="alert alert-success solid alert-dismissible fade show">
                                    <span><i class="mdi mdi-check"></i></span>
                                    <strong>{{ Session::get('success') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>
                            @endif
                            <?php //Hiển thị thông báo lỗi
                            ?>
                            @if (Session::has('error'))
                                <div class="alert alert-danger solid alert-end-icon alert-dismissible fade show">
                                    <span><i class="mdi mdi-help"></i></span>
                                    <strong>{{ Session::get('errors') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                                    </button>
                                </div>
                            @endif
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h4 class="card-title">Xem bình luận sản phẩm</h4>

                                </div>

                            </div>
                            <div class="table-responsive">
                                <div class="container">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a href="#info" role="tab" data-toggle="tab" class="nav-link active"> Chưa
                                                duyệt </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#ratings" role="tab" data-toggle="tab" class="nav-link"> Đã duyệt
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#plus" role="tab" data-toggle="tab" class="nav-link"> Từ chối
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" role="tabpanel" id="info">
                                            <h3 class="mt-3"> Chưa duyệt </h3>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="timeline timeline-left">
                                                                    @php
                                                                        use Illuminate\Support\Carbon;
                                                                    @endphp
                                                                      @php 
                                                                            $a = 1;
                                                                      @endphp
                                                                    @foreach ($rateYos as $rate)
                                                                        {{-- {{ dd($rate) }} --}}
                                                                        @if($rate->status == 1)
                                                                        @php 
                                                                                $a = $a + 1;
                                                                        @endphp
                                                                        <li class="timeline-inverted timeline-item">
                                                                            <div class="timeline-badge success" style="">
                                                                                <img src="{{ $rate->User->images ? '' . $rate->User->images : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' }}"
                                                                                    alt="img" class="img-fluid"
                                                                                    style="width:100%; height:100%;" />
                                                                            </div>
                                                                            <div class="timeline-panel">
                                                                                <div class="timeline-heading">
                                                                                    <h4 class="timeline-title">{{ $rate->User->email }}
                                                                                    </h4>
                                                                                    @php
                                                                                        $rating = $rate->rate;
                                                                                    @endphp
                                                                                    <div>
                                                                                        @foreach (range(1, 5) as $i)
                                                                                            @if ($i <= $rating)
                                                                                                <i class="fa-solid fa-star"
                                                                                                    style="color: gold;"></i>
                                                                                            @else
                                                                                                <i class="fa-solid fa-star"
                                                                                                    style="color: gray;"></i>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <p>
                                                                                        <small class="text-muted"><i
                                                                                                class="fa fa-clock-o"></i>
                                                                                            Thời gian bình luận:
                                                                                            {{ Carbon::parse($rate->created_at)->format('d-m-Y') }}
                                                                                        </small>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="timeline-body">
                                                                                    <p>
                                                                                        {{ $rate->comment }}
                                                                                    </p>
                                                                                </div>
                                                                                <div>
                                                                                    <a href="{{ route('rateYo.update_web', ['id' => $rate->id, 'status' => 2]) }}" class="btn btn-success">Duyệt</a>
                                                                                    <a href="{{ route('rateYo.update_web', ['id' => $rate->id, 'status' => 3]) }}" class="btn btn-danger">Từ chối</a>

                                                                                 
            
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                        @endif
                                                                    @endforeach
                                                                    @if($a == 1)
                                                                        <img class="d-flex justify-between-center text-center align-items-center m-auto" src="https://png.pngtree.com/png-vector/20190719/ourmid/pngtree-empty-box-icon-for-your-project-png-image_1548720.jpg" alt="">
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="ratings">
                                            <h3 class="mt-3"> Đã duyệt </h3>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="timeline timeline-left">
                                                                    @php 
                                                                        $a = 1;
                                                                    @endphp
                                                                    @foreach ($rateYos as $rate)
                                                                        
                                                                        @if($rate->status == 2)
                                                                            @php 
                                                                                $a = $a + 1;
                                                                            @endphp
                                                                        <li class="timeline-inverted timeline-item">
                                                                            <div class="timeline-badge success" style="">
                                                                                <img src="{{ $rate->User->images ?  $rate->User->images : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' }}"
                                                                                    alt="img" class="img-fluid"
                                                                                    style="width:100%; height:100%;" />
                                                                            </div>
                                                                            <div class="timeline-panel">
                                                                                <div class="timeline-heading">
                                                                                    <h4 class="timeline-title">{{ $rate->User->email }}
                                                                                    </h4>
                                                                                    @php
                                                                                        $rating = $rate->rate;
                                                                                    @endphp
                                                                                    <div>
                                                                                        @foreach (range(1, 5) as $i)
                                                                                            @if ($i <= $rating)
                                                                                                <i class="fa-solid fa-star"
                                                                                                    style="color: gold;"></i>
                                                                                            @else
                                                                                                <i class="fa-solid fa-star"
                                                                                                    style="color: gray;"></i>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                    <p>
                                                                                        <small class="text-muted"><i
                                                                                                class="fa fa-clock-o"></i>
                                                                                            Thời gian bình luận:
                                                                                            {{ Carbon::parse($rate->created_at)->format('d-m-Y') }}
                                                                                        </small>
                                                                                    </p>
                                                                                </div>
                                                                                <div class="timeline-body">
                                                                                    <p>
                                                                                        {{ $rate->comment }}
                                                                                    </p>
                                                                                </div>
                                                                             
                                                                            </div>
                                                                        </li>
                                                                        @endif
                                                                    @endforeach

                                                                    @if($a == 1)
                                                                        <img class="d-flex justify-between-center text-center align-items-center m-auto" src="https://png.pngtree.com/png-vector/20190719/ourmid/pngtree-empty-box-icon-for-your-project-png-image_1548720.jpg" alt="">
                                                                    @endif
            
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="plus">
                                            <h3 class="mt-3"> Từ chối </h3>
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <ul class="timeline timeline-left">
                                                                    @php 
                                                                        $a = 1;
                                                                    @endphp
                                                                    @foreach ($rateYos as $rate)
                                                                        @if($rate->status == 3)
                                                                                @php 
                                                                                    $a = $a + 1;
                                                                                @endphp
                                                                            <li class="timeline-inverted timeline-item  ">
                                                                                <div class="timeline-badge success" style="">
                                                                                    <img src="{{ $rate->User->images ?  $rate->User->images : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' }}"
                                                                                        alt="img" class="img-fluid"
                                                                                        style="width:100%; height:100%;" />
                                                                                </div>
                                                                                <div class="timeline-panel ">
                                                                                    <div class="timeline-heading">
                                                                                        <h4 class="timeline-title">{{ $rate->User->email }}
                                                                                        </h4>
                                                                                        @php
                                                                                            $rating = $rate->rate;
                                                                                        @endphp
                                                                                        <div>
                                                                                            @foreach (range(1, 5) as $i)
                                                                                                @if ($i <= $rating)
                                                                                                    <i class="fa-solid fa-star"
                                                                                                        style="color: gold;"></i>
                                                                                                @else
                                                                                                    <i class="fa-solid fa-star"
                                                                                                        style="color: gray;"></i>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        </div>
                                                                                        <p>
                                                                                            <small class="text-muted"><i
                                                                                                    class="fa fa-clock-o"></i>
                                                                                                Thời gian bình luận:
                                                                                                {{ Carbon::parse($rate->created_at)->format('d-m-Y') }}
                                                                                            </small>
                                                                                        </p>
                                                                                    </div>
                                                                                    <div class="timeline-body">
                                                                                        <p>
                                                                                            {{ $rate->comment }}
                                                                                        </p>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </li>
                                                                        
                                                                        @endif
                                                                    @endforeach
                                                                    @if($a == 1)
                                                                        <img class="d-flex justify-between-center text-center align-items-center m-auto" src="https://png.pngtree.com/png-vector/20190719/ourmid/pngtree-empty-box-icon-for-your-project-png-image_1548720.jpg" alt="">
                                                                    @endif
            
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                                    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
                                </script>
                                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                                    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
                                </script>
                                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
                                    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
                                </script>
                              
                            </div>
                            <div class="mt-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
