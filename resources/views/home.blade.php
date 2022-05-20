@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content-header', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$orders_count}}</h3>
                    <p>Orders Count</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('orders.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{number_format($total_income,2)}} {{config('settings.currency_symbol')}} </h3>
                    <p>Income</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('orders.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{number_format($income_today,2)}} {{config('settings.currency_symbol')}} </h3>

                    <p>Income Today</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('orders.index')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$customers_count}}</h3>

                    <p>Customers Count</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('customers.index') }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div>
<!-- Chart Bar -->
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Sales Char
        </div>
        <div class="card-body">
            <canvas id="myBarChart" width="100%" height="20"></canvas>
        </div>
    </div>
</div>
<!-- Chart Bar End-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Three Last Products</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Barcode</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($producti as $pro)

                            <!-- dd($pro); -->
                            @if($pro->quantity < 10) <tr class="table-danger">
                                <td>{{$pro->barcode}}</td>
                                <td>{{$pro->name}}</td>
                                <td>{{$pro->price}}</td>
                                <td>{{$pro->quantity}}</td>
                                </tr>
                                @else
                                <tr class="table-info">
                                    <td>{{$pro->barcode}}</td>
                                    <td>{{$pro->name}}</td>
                                    <td>{{$pro->price}}</td>
                                    <td>{{$pro->quantity}}</td>
                                </tr>
                                @endif
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
    <script type="text/javascript">
    var _ydata = JSON.parse('{!!json_encode($months)!!}');
    var _xdata = JSON.parse('{!!json_encode($monthCount)!!}');
    </script>
    @endsection