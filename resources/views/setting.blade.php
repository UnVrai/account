@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>设置</h4>
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

                        <form action="{{ URL('setting') }}" id="order" style="width: 50%;" method="post">

                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            粗沙：
                            <input type="text" name="csPrice" class="form-control" value="{{ $price->csPrice }}" required="required" >
                            公分石：
                            <input type="text" name="gfsPrice" class="form-control" value="{{ $price->gfsPrice }}" required="required" >
                            细沙：
                            <input type="text" name="xsPrice" class="form-control" value="{{ $price->xsPrice }}" required="required" >
                            毛石:
                            <input type="text" name="msPrice" class="form-control" value="{{ $price->msPrice }}" required="required" >
                            <br>
                            <button class="btn btn-lg btn-primary">保存</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection