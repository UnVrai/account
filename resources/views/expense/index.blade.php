@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div style="float:right">
                            <a href="{{ URL('expenses/create') }}" class="btn btn-lg btn-primary">新增</a>
                        </div>
                        <h4 style="margin-left: 20px">支出记录</h4>
                        <br>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-3">时间</th>
                                <th class="col-lg-1">金额</th>
                                <th class="col-lg-1">类型</th>
                                <th class="col-lg-1">经办人</th>
                                <th class="col-lg-5">备注</th>
                                <th class="col-lg-2">操作</th>
                            </tr>
                            @foreach ($expenses as $expense)
                                <tr class="row">
                                    <td>
                                        {{ $expense->created_at }}
                                    </td>
                                    <td>
                                        {{ $expense->number }}
                                    </td>
                                    <td>
                                        {{ $expense->type }}
                                    </td>
                                    <td>
                                        {{ $expense->person }}
                                    </td>
                                    <td>
                                        {{ $expense->description }}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteFuc('{{ URL('expenses/'.$expense->id) }}')">删除</button>
                                    </td>
                                </tr>

                            @endforeach
                        </table>

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        {{ $expenses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/delete.js"></script>
@endsection
