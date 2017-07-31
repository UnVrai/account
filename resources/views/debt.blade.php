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
                                <input type="number" id="price" name="price" class="form-control" value="70" readonly>
                                <input type="hidden" id="total" name="total" class="form-control" readonly>
                                实收：
                                <input type="number" id="actual" name="actual" class="form-control" readonly>
                                欠款人：
                                <input type="text" id="debtor" name="debtor" class="form-control" readonly>
                                担保人：
                                <input type="text" id="guarantor" name="guarantor" class="form-control" readonly>
                                <br>
                            </form>
                            <button class="btn btn-lg btn-primary" onclick="save()">打印</button>
                            <iframe id="iPrint" style="height: 0; width: 0; border: 0"></iframe>
                        </div>
                        <div style="margin-left: 50px;width: 250px; float: left" id="debtors">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="JavaScript">
        var debtors;
        var isSelect;
        getDebtors();
        function getDebtors() {
            $.ajax({
                url: '/debtors',
                success: function (data) {
                    debtors = data;
                    setDebtors();
                }
            })
        }
        function save() {
            if (isSelect != null) {
                create('/print/debt');
            }
        }
        function setDebtors() {
            $('#debtors').html('');
            debtors.forEach(function (debtor, i) {
                $('#debtors').append('<a href="#" class="list-group-item" onclick="selectDebtor('+ i +', this)">'+ debtor.person + '</a>');
            })
        }
        function selectDebtor(i, btn) {
            $(isSelect).removeClass('active');
            isSelect = btn;
            $(btn).addClass('active');
            $('#person').val(debtors[i].person);
            $('#debtor').val(debtors[i].debtor);
            $('#guarantor').val(debtors[i].guarantor);
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
            if (name == '毛石') {
                $('#price').val(45);
            } else {
                $('#price').val(70);
            };
            setPrice();
        }
        function openPrint() {
            document.getElementById("iPrint").focus(); document.getElementById("iPrint").contentWindow.print();
        }
        $(document).ready(function(){
            if (document.getElementById("iPrint").attachEvent) {

                document.getElementById("iPrint").attachEvent("onload", function () {
                    setTimeout('openPrint()', 500)
                });
            } else {
                document.getElementById("iPrint").onload = function () {
                    setTimeout('openPrint()', 500)
                }
            }
            $('#number').bind('input', setPrice);
        })
        function setPrice() {
            var total = $('#price').val() * $('#number').val();
            $('#total').val(total);
            total = total - total % 5;
            $('#actual').val(total);
        }
    </script>
@endsection