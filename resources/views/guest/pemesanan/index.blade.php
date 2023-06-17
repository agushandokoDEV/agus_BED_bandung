@extends('guest.layouts.base')
@section('title', 'Pemesanan Tiket')
@section('content')
<div class="row">
    <div class="col-md-6 offset-3">
        <form method="POST" action="/pemesanan" id="form-pemesanan-tiket">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Form Pemesanan Tiket</div>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nama">Pilih Konser :</label>
                                <select class="form-control form-control-sm" id="list_konser" name="konser_id" onchange="listkelas()">
                                    <option value="">Pilih konser</option>
                                    @foreach ($list_konser as $konser)
                                    <option value="{{ $konser->id }}">{{ $konser->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama">Pilih Konser :</label>
                                <select class="form-control form-control-sm" id="kelas_id" name="kelas_id">
                                    <option value="" disabled selected>Pilih Kelas</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="nama">Nama Pemesan :</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama lengkap pemesan tiket" required>
                            </div>
                            <div class="form-group">
                                <label for="email2">Email :</label>
                                <input type="email" class="form-control" id="email2"  name="email" placeholder="Email valid pemesan tiket" required>
                            </div>
                            {{-- <div class="form-group">
                                <label for="jumlah">Jumlah Tiket :</label>
                                <input type="number" min="0" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah tiket yang di pesan" required>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="card-action">
                    <button type="submit" id="btn-submit" class="btn btn-success">Pesan Tiket</button>
                    <br />
                    <br />

                    <div id="msg-form"></div>
                </div>
            </div>

        </form>
    </div>
</div>

<script src="/assets/js/plugin/ajaxform/dist/jquery.form.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#form-pemesanan-tiket').ajaxForm({
            beforeSend: function() {
                $('#msg-form').html('');
                $('#btn-submit')
                    .attr('disabled','true')
                    .text('Loading...');
            },
            success: function(res) {
                $('#btn-submit')
                .removeAttr('disabled')
                .text('Pesan Tiket');

                var msg=`Pemesanan berhasil dengan Kode Tiket ${res.data.kode}`;

                $('#msg-form').html(`<div class="alert alert-success">${msg}</div>`)
            },
            error:function(err){
                $('#btn-submit')
                    .removeAttr('disabled')
                    .text('Pesan Tiket');
                $('#msg-form').html('<div class="alert alert-danger">'+err.responseJSON.message+'</div>')
            }
        });
    });

    function listkelas(){
        var id = $('#list_konser').val();
        $.get(`/pemesanan/list-kelas/${id}`,function(res){
            var data=res.data;
            data.forEach(list_k)
        })
    }

    function list_k(item){
        $('#kelas_id').append(`<option value="${item.id}">${item.nama}</option>`);
    }
</script>
@endsection
