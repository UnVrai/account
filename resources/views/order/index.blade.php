@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 style="margin-left: 20px">调拨单记录</h4>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-1">编号</th>
                                <th class="col-lg-1">名称</th>
                                <th class="col-lg-1">数量</th>
                                <th class="col-lg-1">价格</th>
                                <th class="col-lg-1">总计</th>
                                <th class="col-lg-1">实收</th>
                                <th class="col-lg-3">时间</th>
                                <th class="col-lg-2">操作</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr class="row">
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        {{ $order->name }}
                                    </td>
                                    <td>
                                        {{ $order->number }}
                                    </td>
                                    <td>
                                        {{ $order->price }}
                                    </td>
                                    <td>
                                        {{ $order->total }}
                                    </td>
                                    <td>
                                        {{ $order->actual }}
                                    </td>
                                    <td>
                                        {{ $order->created_at }}
                                    </td>
                                    <td>
                                        <button class="btn btn-info" onclick="print('{{ $order->id }}', '/print/common')">打印</button>
                                        <button class="btn btn-danger" onclick="deleteFuc('{{ URL('orders/'.$order->id) }}')">删除</button>
                                    </td>
                                </tr>

                            @endforeach
                        </table>

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <iframe id="iPrint" style="height: 0; width: 0; border: 0"></iframe>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/delete.js"></script>
    <script src="/js/print.js"></script>
@endsection
