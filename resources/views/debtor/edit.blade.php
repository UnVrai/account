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

                        <form action="{{ URL('debtors/'.$debtor->id) }}" method="post">
                            <div style="width: 40%;float: left">
                                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                单位：
                                <input type="text" name="name" class="form-control" readonly value="{{ $debtor->name }}" >
                                电话：
                                <input type="text" name="tel" class="form-control"  value="{{ $debtor->tel }}" >
                                欠款人：
                                <input type="text" name="debtor" class="form-control"  value="{{ $debtor->debtor }}" >
                                担保人：
                                <input type="text" name="sponsor" class="form-control"  value="{{ $debtor->sponsor }}" >
                                类型：
                                <select name="type" class="form-control" required="required">
                                    <option value="qk" {{ $discount->type == 'qk' ? 'selected' : ''}}>欠款</option>
                                    <option value="yfk" {{ $discount->type == 'yfk' ? 'selected' : ''}}>预付款</option>
                                </select>
                                <br>
                                <button class="btn btn-lg btn-primary">保存</button>
                                <a href="/debtors" class="btn btn-lg btn-warning"  style="margin-left: 50px" >返回</a>
                                </div>
                            <div style="width: 40%;margin-right: 100px;float: right">
                                优惠：
                                <select name="discount" class="form-control">
                                    <option value="0" {{ $discount->discount == '0' ? 'selected' : ''}}>无</option>
                                    <option value="dc"{{ $discount->discount == 'dc' ? 'selected' : ''}}>单车</option>
                                    <option value="dj"{{ $discount->discount == 'dj' ? 'selected' : ''}}>单价</option>
                                </select>
                                粗沙：
                                <input type="text" name="cs" class="form-control"  value="{{ isset($discount->cs) ? $discount->cs : '' }}">
                                公分石：
                                <input type="text" name="gfs" class="form-control"  value="{{ isset($discount->gfs) ? $discount->cs : '' }}">
                                细沙：
                                <input type="text" name="xs" class="form-control"  value="{{ isset($discount->xs) ? $discount->cs : '' }}">
                                毛石：
                                <input type="text" name="ms" class="form-control"  value="{{ isset($discount->ms) ? $discount->cs : '' }}">

                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection