@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>客户</h4>
                    </div>

                    <div class="panel-body">

                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ URL('debtors') }}" method="post">
                            <div style="width: 40%;float: left">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                单位：
                                <input type="text" name="name" class="form-control" required >
                                电话：
                                <input type="text" name="tel" class="form-control" >
                                欠款人：
                                <input type="text" name="debtor" class="form-control" >
                                担保人：
                                <input type="text" name="sponsor" class="form-control" >
                                欠款上限：
                                <input type="number" name="max" class="form-control" >
                                还款期限（天）：
                                <input type="number" name="days" class="form-control" >
                                <br>
                                <button class="btn btn-lg btn-primary">保存</button>
                                <a href="/debtors" class="btn btn-lg btn-warning"  style="margin-left: 50px" >返回</a>
                                </div>
                            <div style="width: 40%;margin-right: 100px;float: right">
                                类型：
                                <select name="type" class="form-control" required="required">
                                    <option value="qk" selected>欠款</option>
                                    <option value="yfk">预付款</option>
                                </select>
                                优惠：
                                <select name="discount" class="form-control">
                                    <option value="0" selected>无</option>
                                    <option value="dc">单车</option>
                                    <option value="dj">单价</option>
                                    <option value="sf">实方</option>
                                </select>
                                粗沙：
                                <input type="text" name="cs" class="form-control" >
                                公分石：
                                <input type="text" name="gfs" class="form-control" >
                                细沙：
                                <input type="text" name="xs" class="form-control" >
                                毛石：
                                <input type="text" name="ms" class="form-control" >

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection