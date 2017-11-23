@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <h4 style="margin-left: 20px">收入记录</h4>
                        <br>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-2">时间</th>
                                <th class="col-lg-1">金额</th>
                                <th class="col-lg-1">类型</th>
                                <th class="col-lg-1">单位</th>
                                <th class="col-lg-5">备注</th>
                                <th class="col-lg-2">操作</th>
                            </tr>
                            @foreach ($incomes as $income)
                                <tr class="row">
                                    <td>
                                        {{ $income->created_at }}
                                    </td>
                                    <td>
                                        {{ $income->number }}
                                    </td>
                                    <td>
                                        {{ $income->type }}
                                    </td>
                                    <td>
                                        {{ $income->person }}
                                    </td>
                                    <td>
                                        {{ $income->description }}
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteFuc('{{ URL('incomes/'.$income->id) }}')">删除</button>
                                    </td>
                                </tr>

                            @endforeach
                        </table>

                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        {{ $incomes->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/delete.js"></script>
@endsection
