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

                        <form action="{{ URL('expenses') }}" id="order" style="width: 50%;" method="post">

                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            金额：
                            <input type="text" name="number" class="form-control" required="required" >
                            类型：
                            <select id="type" name="type" class="form-control" required="required">
                                @foreach($types as $type)
                                    <option value="{{ $type->name }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            经办人：
                            <input type="text" name="person" class="form-control" required="required" >
                            描述:
                            <textarea name="description" rows="5" class="form-control" required="required"></textarea>
                            <br>
                            <button class="btn btn-lg btn-primary">保存</button>
                            <a href="/expenses" class="btn btn-lg btn-warning"  style="margin-left: 50px" >返回</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#type option').eq(0).attr("selected", true);
    </script>

@endsection