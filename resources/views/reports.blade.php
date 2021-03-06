@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div style="float:right" class="btn-group">
                            <br>
                            <a href="{{ URL('reports\d') }}" class="btn {{ $type == 'd' ? 'btn-info' : 'btn-default'}}">日</a>
                            <a href="{{ URL('reports\m') }}" class="btn {{ $type == 'm' ? 'btn-info' : 'btn-default'}}">月</a>
                            <a href="{{ URL('reports\Y') }}" class="btn {{ $type == 'Y' ? 'btn-info' : 'btn-default'}}">年</a>
                        </div>
                        <h4 style="margin-left: 20px">账目</h4>
                        <br>

                        <table class="table table-striped">
                            <tr class="row">
                                <th class="col-lg-2">时间</th>
                                <th class="col-lg-1">粗沙</th>
                                <th class="col-lg-1">公分石</th>
                                <th class="col-lg-1">细沙</th>
                                <th class="col-lg-1">毛石</th>
                                <th class="col-lg-1">实方</th>
                                <th class="col-lg-1">粗沙</th>
                                <th class="col-lg-1">公分石</th>
                                <th class="col-lg-1">细沙</th>
                                <th class="col-lg-1">毛石</th>
                            </tr>
                            @foreach ($reports as $report)
                                <tr class="row">
                                    <td>
                                        {{ $report->date }}
                                    </td>
                                    <td>
                                        {{ $report->csNum }}
                                    </td>
                                    <td>
                                        {{ $report->gfsNum }}
                                    </td>
                                    <td>
                                        {{ $report->xsNum }}
                                    </td>
                                    <td>
                                        {{ $report->msNum }}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ $report->csSf }}
                                    </td>
                                    <td>
                                        {{ $report->gfsSf }}
                                    </td>
                                    <td>
                                        {{ $report->xsSf }}
                                    </td>
                                    <td>
                                        {{ $report->msSf }}
                                    </td>
                                </tr>

                            @endforeach
                        </table>
                        {{ $reports->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection