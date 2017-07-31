@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">调拨单</div>

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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            编号：<input type="number" id="serial" name="serial" value="{{ $serial }}" class="form-control" required="required">
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
                            <input type="text" id="number" name="number" class="form-control" required="required" >
                            单价：
                            <input type="number" id="price" name="price" class="form-control" required="required" value="70" readonly>
                            合计：
                            <input type="number" id="total" name="total" class="form-control" required="required" readonly>
                            实收：
                            <input type="number" id="actual" name="actual" class="form-control" required="required">
                            <br>
                        </form>
                        <button class="btn btn-lg btn-primary" onclick="create('/print/common')">打印</button>
                        <iframe id="iPrint" style="height: 0; width: 0; border: 0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="JavaScript">
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
            var total = $('#price').val() * $('#number').val();
            $('#total').val(total);
            total = total - total % 5;
            $('#actual').val(total);
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
            $('#number').bind('input', function () {
                var total = $('#price').val() * $('#number').val();
                $('#total').val(total);
                total = total - total % 5;
                $('#actual').val(total);
            })
        })
    </script>
@endsection