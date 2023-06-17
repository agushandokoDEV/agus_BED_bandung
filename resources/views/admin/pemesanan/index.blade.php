@extends('admin.layouts.base')
@section('title', 'Daftar Pemesanan Tiket')
@section('assets')
<script src="/assets/js/plugin/datatables/datatables.min.js"></script>
@endsection

@section('content')
{{-- <h1 class="display-4">Role</h1> --}}

<div class="card">
    <div class="card-header">
        <div class="card-head-row">
            <div class="card-title">Daftar Users</div>
            <div class="card-tools">
                <button id="btn-refresh" class="btn btn-default btn-border btn-round btn-sm xmr-2">
                    <span class="btn-label">
                        <i class="fas fa-circle-notch"></i>
                    </span>
                    Reload
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="list-data" class="display table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Kode Pemesanan</th>
                        <th>Konser</th>
                        <th>Kelas</th>
                        <th class="text-center" style="width: 15%;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
        table = $('#list-data').DataTable({
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "/admin/pemesanan/list"
                , "type": "GET"
            },
            // "iDisplayLength": 100,
            "columnDefs": [{
                    "targets": 6
                    , "render": function(data, type, row, meta) {
                        var str = '';
                        str += `<button onclick="get_detail('/admin/users/row/${row.id}')" class="btn btn-xs btn-icon btn-round btn-link"><i class="fas fa-pen"></i></button>`;
                        // str += ` <button id="btn-del" onclick="removeByid('${row.id}')" class="btn btn-xs btn-icon btn-round btn-link"><i class="fas fa-trash"></i></button>`;

                        return "-";
                    }
                }
                , {
                    "targets": 0
                    , "orderable": false
                }
            ]
            , columns: [{
                    searchable: false
                    , render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                }
                , {
                    data: "nama_pemesan"
                }
                , {
                    data: "email_pemesan"
                }
                , {
                    data: "kode"
                }
                ,{
                    data:"konser_id",
                    render: function (data, type, row, meta) {
                        // return row?.user?.namalengkap
                        return row?.konser?.nama
                    }

                },
                {
                    data:"kelas_id",
                    render: function (data, type, row, meta) {
                    // return row?.user?.namalengkap
                    return row?.kelas?.nama
                    }

                }
            , ],

            "language": {
                "lengthMenu": "_MENU_"
                , "processing": "<img src='/assets/img/loading.gif' />"
                , 'paginate': {
                    'first': ''
                    , 'last': ''
                    , 'previous': '<i class="fa fa-arrow-left"></i>'
                    , 'next': '<i class="fa fa-arrow-right"></i>'
                }
                , "decimal": ""
                , "emptyTable": "Data tidak tersedia"
                , "info": "_START_ / _END_ Total _TOTAL_ "
                , "infoEmpty": "0 / 0 Total 0"
                , "infoFiltered": "(filtered from _MAX_ total entries)"
                , "infoPostFix": ""
                , "thousands": ","
                , "loadingRecords": "Loading...",

                "search": "Cari:"
                , "zeroRecords": "Tidak ada kecocokan data"
                , "aria": {
                    "sortAscending": ": activate to sort column ascending"
                    , "sortDescending": ": activate to sort column descending"
                }
            }
            , "order": [
                [1, 'asc']
            ]
            , "sDom": "<'row'<'col-sm-1'l><'col-sm-8'<'dt_actions'>><'col-sm-3'f>r>t<'row'<'col-sm-5'i><'col-sm-7'p>>"
        , });

        $('#btn-refresh').click(function() {
            table.ajax.reload(null, false);
        });
    });

</script>
@endsection

