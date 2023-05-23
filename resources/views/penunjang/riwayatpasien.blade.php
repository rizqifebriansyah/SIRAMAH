<div class="card direct-chat direct-chat-primary">

    <div class="card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">RIWAYAT PASIEN</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      

        <div class="card-body table-responsive p-0" style="height: 300px;">
            <table class="table table-head-fixed text-nowrap">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Layanan</th>
                        <th>Unit</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $r)

                    <tr>
                        <td>{{$r->tgl}}</td>
                        <td>{{$r->nama_tarif}}</td>
                        <td> {{$r->nama_unit}}
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">

    </div>
    <!-- /.card-footer-->
</div>