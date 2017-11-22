@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>调拨单</h4>
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

                        <form id="order" style="width: 250px;" method="post">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            编号：<input type="number" id="serial" name="serial" value="{{ $serial }}" class="form-control" readonly>
                            名称：<br>
                            <input type="hidden" name="name" id="name" value="粗沙">
                            <div class="btn-group">
                                <button type="button" id="cs" class="btn btn-info" onclick="setName('粗沙', this)">粗沙</button>
                                <button type="button" id="ms" class="btn btn-default" onclick="setName('毛石', this)">毛石</button>
                                <button type="button" id="gfs" class="btn btn-default" onclick="setName('公分石', this)">公分石</button>
                                <button type="button" id="xs" class="btn btn-default" onclick="setName('细沙', this)">细沙</button>
                            </div>
                            <br>
                            数量：
                            <input type="text" id="number" name="number" class="form-control" >
                            单价：
                            <input type="number" id="price" name="price" class="form-control" value="{{ $price->csPrice }}" readonly>
                            合计：
                            <input type="number" id="total" name="total" class="form-control" readonly>
                            实收：
                            <input type="number" id="actual" name="actual" class="form-control" >
                            <br>
                        </form>

                         <button class="btn btn-lg btn-primary" onclick="create('/orders', '/print/common')">保存</button>
                        <iframe id="iPrint" style="height: 0; width: 0; border: 0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="csPrice" value="{{ $price->csPrice }}">
    <input type="hidden" id="gfsPrice" value="{{ $price->gfsPrice }}">
    <input type="hidden" id="xsPrice" value="{{ $price->xsPrice }}">
    <input type="hidden" id="msPrice" value="{{ $price->msPrice }}">

    <script language="JavaScript">
        var price = {};
        price.毛石 = $('#msPrice').val();
        price.粗沙 = $('#csPrice').val();
        price.公分石 = $('#gfsPrice').val();
        price.细沙 = $('#xsPrice').val();

        $('#number').bind('input', setTotal);
        function setName(name, btn) {
            $('#cs').attr('class', 'btn btn-default');
            $('#ms').attr('class', 'btn btn-default');
            $('#gfs').attr('class', 'btn btn-default');
            $('#xs').attr('class', 'btn btn-default');
            $(btn).attr('class', 'btn btn-info');
            $('#name').val(name);
            $('#price').val(price[name]);
            setTotal();
        }
        function setTotal() {
            var total = $('#price').val() * $('#number').val();
            $('#total').val(total);
            total = total - total % 5;
            $('#actual').val(total);
        }
    </script>
    <script src="/js/print.js"></script>
@endsection