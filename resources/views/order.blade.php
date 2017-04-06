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

                        <form id="order" style="width: 200px;" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            编号：<input type="number" id="serial" name="serial" class="form-control" required="required">
                            名称：
                            <select name="name" id="name" class="form-control" required="required">
                                <option value="粗沙">粗沙</option>
                                <option value="毛石">毛石</option>
                                <option value="公分石">公分石</option>
                                <option value="细沙">细沙</option>
                            </select>
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
                        <button class="btn btn-lg btn-info" onclick="create()">打印</button>
                        <iframe id="iPrint" style="height: 0; width: 0; border: 0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script language="JavaScript">
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
            $('#name').change(function(){
                if ($(this).children('option:selected').val() == '毛石') {
                    $('#price').val(40);
                } else {
                    $('#price').val(70);
                };
                var total = $('#price').val() * $('#number').val();
                $('#total').val(total);
                $('#actual').val(total);
            })
            $('#number').bind('input', function () {
                var total = $('#price').val() * $('#number').val();
                $('#total').val(total);
                $('#actual').val(total);
            })
        })
    </script>
@endsection