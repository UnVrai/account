@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>支出</h4>
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

                        <form action="{{ URL('repay') }}" id="order" style="width: 50%;" method="post">

                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $debtor->id }}">
                            还款人：
                            <input type="text" name="name" class="form-control" readonly value="{{ $debtor->name }}">
                            欠款：
                            <input type="text" name="account" class="form-control" readonly value="{{ $debtor->account }}" >
                            还款：
                            <input type="text" name="repay" class="form-control" required="required" >
                            冲账:
                            <input type="text" name="number" class="form-control" required="required" >
                            <br>
                            <button class="btn btn-lg btn-primary">保存</button>
                            <a href="/debtors" class="btn btn-lg btn-warning"  style="margin-left: 50px" >返回</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection