@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div style="float:right">
                            <a href="{{ URL('debtors/create') }}" class="btn btn-lg btn-primary">新增</a>
                        </div>
                        <div style="float:right; margin-right: 100px">
                            <h3>总计：{{ $total }}</h3>
                        </div>
                        <h4 style="margin-left: 20px">客户</h4>
                        <br>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-2">单位</th>
                                <th class="col-lg-2">电话</th>
                                <th class="col-lg-1">欠款人</th>
                                <th class="col-lg-2">担保人</th>
                                <th class="col-lg-1">欠款</th>
                                <th class="col-lg-4">操作</th>
                            </tr>
                            @foreach ($debtors as $debtor)
                                <tr class="row">
                                    <td>
                                        {{ $debtor->name }}
                                    </td>
                                    <td>
                                        {{ $debtor->tel }}
                                    </td>
                                    <td>
                                        {{ $debtor->debtor }}
                                    </td>
                                    <td>
                                        {{ $debtor->sponsor }}
                                    </td>
                                    <td>
                                        {{ $debtor->account }}
                                    </td>
                                    <td>
                                        <a href="{{ URL('debts/'.$debtor->id) }}" class="btn btn-info">查询</a>
                                        <a href="{{ URL('repay/'.$debtor->id) }}" class="btn btn-info">还款</a>
                                        <a href="{{ URL('debtors/'.$debtor->id.'/edit') }}" class="btn btn-success">编辑</a>
                                        <button class="btn btn-danger" onclick="deleteFuc('{{ URL('debtors/'.$debtor->id) }}')">删除</button>
                                    </td>
                                </tr>

                            @endforeach
                        </table>

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        {{ $debtors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/delete.js"></script>
@endsection
