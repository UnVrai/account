@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div style="float:right" class="btn-group">
                            <br>
                            <a href="{{ URL('reports?type=d') }}" class="btn {{ $type == 'd' ? 'btn-info' : 'btn-default'}}">日</a>
                            <a href="{{ URL('reports?type=m') }}" class="btn {{ $type == 'm' ? 'btn-info' : 'btn-default'}}">月</a>
                            <a href="{{ URL('reports?type=Y') }}" class="btn {{ $type == 'Y' ? 'btn-info' : 'btn-default'}}">年</a>
                        </div>
                        <h4 style="margin-left: 20px">账目</h4>
                        <br>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-2">时间</th>
                                <th class="col-lg-1">现金</th>
                                <th class="col-lg-1">记账单</th>
                                <th class="col-lg-1">收入</th>
                                <th class="col-lg-1">支出</th>
                                <th class="col-lg-1">总计</th>
                            </tr>
                            @foreach ($account as $report)
                                <tr class="row">
                                    <td>
                                        {{ $report->date }}
                                    </td>
                                    <td>
                                        {{ $report->order }}
                                    </td>
                                    <td>
                                        {{ $report->debt }}
                                    </td>
                                    <td>
                                        {{ $report->income }}
                                    </td>
                                    <td>
                                        {{ $report->expense }}
                                    </td>
                                    <td>
                                        {{ $report->total }}
                                    </td>
                                </tr>

                            @endforeach
                        </table>
                        {{ $account->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection