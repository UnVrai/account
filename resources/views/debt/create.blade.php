@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">欠条</div>

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
                        <div style="margin-right: 50px;width: 300px; height: 490px; float: left; overflow: auto" id="debtors">
                        </div>
                        <div style="width: 250px;float: left">
                            <form id="order" method="post">
                                {{ csrf_field() }}
                                编号：<input type="number" id="serial" name="serial" value="{{ $serial }}" class="form-control">
                                <input type="hidden" id="person" name="person">
                                <input type="hidden" id="id" name="id">
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
                                <input type="text" id="number" name="number" class="form-control">
                                单价：
                                <input type="number" id="price" name="price" class="form-control" value="{{ $price->csPrice }}" readonly>
                                合计：
                                <input type="text" id="total" name="total" class="form-control" readonly>
                                欠款人：
                                <input type="text" id="debtor" name="debtor" class="form-control" readonly>
                                担保人：
                                <input type="text" id="sponsor" name="sponsor" class="form-control" readonly>
                                <br>
                            </form>
                            <button class="btn btn-lg btn-primary" onclick="save()">保存</button>
                            <iframe id="iPrint" style="height: 0; width: 0; border: 0"></iframe>
                        </div>
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

        var debtors;
        var isSelect;
        getDebtors();
        function getDebtors() {
            $.ajax({
                url: '/debtors?isAll=true',
                success: function (data) {
                    debtors = data;
                    setDebtors();
                }
            })
        }
        function save() {
            if (isSelect != null) {
                create('/debts', '/print/debt');
            }
        }
        function setDebtors() {
            $('#debtors').html('');
            debtors.forEach(function (debtor, i) {
                $('#debtors').append('<a href="#" class="list-group-item" onclick="selectDebtor('+ i +', this)">'+ debtor.name + '</a>');
            })
        }
        function selectDebtor(i, btn) {
            $(isSelect).removeClass('active');
            isSelect = btn;
            $(btn).addClass('active');
            $('#person').val(debtors[i].name);
            $('#debtor').val(debtors[i].debtor);
            $('#sponsor').val(debtors[i].sponsor);
            $('#number').val(debtors[i].number);
            $('#id').val(debtors[i].id);
            setPrice();
        }
        function setName(name, btn) {
            $('#cs').attr('class', 'btn btn-default');
            $('#ms').attr('class', 'btn btn-default');
            $('#gfs').attr('class', 'btn btn-default');
            $('#xs').attr('class', 'btn btn-default');
            $(btn).attr('class', 'btn btn-info');
            $('#name').val(name);
            $('#price').val(price[name]);
            setPrice();
        }

        $('#number').bind('input', setPrice);
        function setPrice() {
            var total = $('#price').val() * $('#number').val();
            $('#total').val(total);
        }
    </script>
    <script src="/js/print.js"></script>
@endsection