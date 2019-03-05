@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 style="margin-left: 20px">记账单记录</h4>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-1">编号</th>
                                <th class="col-lg-1">单位</th>
                                <th class="col-lg-1">名称</th>
                                <th class="col-lg-1">数量</th>
                                <th class="col-lg-1">价格</th>
                                <th class="col-lg-1">总计</th>
                                <th class="col-lg-1">实收</th>
                                <th class="col-lg-1">类型</th>
                                <th width="18%">时间</th>
                                <th class="col-lg-3">操作</th>
                            </tr>
                            @foreach ($debts as $debt)
                                <tr class="row" @if ($debt->trashed())  style="color: red"  @endif>
                                    <td>
                                        {{ $debt->id }}
                                    </td>
                                    <td>
                                        {{ $debt->person }}
                                    </td>
                                    <td>
                                        {{ $debt->name }}
                                    </td>
                                    <td>
                                        {{ $debt->number }}
                                    </td>
                                    <td>
                                        {{ $debt->price }}
                                    </td>
                                    <td>
                                        {{ $debt->total }}
                                    </td>
                                    <td>
                                        {{ $debt->actual }}
                                    </td>
                                    <td>
                                        {{ $debt->type }}
                                    </td>
                                    <td>
                                        {{ $debt->created_at }}
                                    </td>
                                    <td>
                                        @if($debt->trashed())
                                            已删除
                                        @else
                                        <button class="btn btn-info" onclick="print('{{ $debt->id }}', '/print/debt')">打印</button>
                                        <button class="btn btn-danger" onclick="deleteFuc('{{ URL('debts/'.$debt->id) }}')">删除</button>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                        </table>

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <iframe id="iPrint" style="height: 0; width: 0; border: 0"></iframe>
                        {{ $debts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/delete.js"></script>
    <script src="/js/print.js"></script>
@endsection

