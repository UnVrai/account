@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h3 style="margin-left: 20px">调拨单记录</h3>
                        <br>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-2">编号</th>
                                <th class="col-lg-2">名称</th>
                                <th class="col-lg-2">数量</th>
                                <th width="15%">价格</th>
                                <th class="col-lg-2">总计</th>
                                <th class="col-lg-1">实收</th>
                                <th class="col-lg-2">时间</th>
                                <th width="10%">操作</th>
                            </tr>
                            @foreach ($orders as $order)
                                <tr class="row">
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td valign="middle">
                                        {{ $order->name }}
                                    </td>
                                    <td>
                                        {{ $order->number }}
                                    </td>
                                    <td>
                                        {{ $good->created_at }}
                                    </td>
                                    <td>
                                        {{ $good->updated_at }}
                                    </td>
                                    <td>
                                        <a href="{{ URL('good/'.$good->id.'/edit') }}" class="btn btn-success">编辑</a>
                                    </td>
                                    <td>
                                        @if (!$good->isUse)
                                            <form action="{{ URL('good/'.$good->id.'/usable') }}" method="POST"
                                                  style="display: inline;">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="btn btn-primary">上架</button>
                                            </form>
                                        @else
                                            {{--<form action="{{ URL('good/'.$good->id) }}" method="POST"--}}
                                                  {{--style="display: inline;">--}}
                                                {{--<input name="_method" type="hidden" value="DELETE">--}}
                                                {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
                                                {{--<button type="submit" class="btn btn-danger">下架</button>--}}
                                            {{--</form>--}}
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection