<?php

namespace App\Http\Controllers;

use App\Models\mt_kode_header;
use App\Models\ts_layanan_header;
use App\Models\ts_layanan_detail;
use App\Models\assesmenawal_dokter;
use App\Models\ts_retur_header;
use App\Models\ts_retur_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Fpdf;
use Carbon\Carbon;
use simitsdk\phpjasperxml\PHPJasperXML;
use PHPJasper\PHPJasper;
use Illuminate\Support\Facades\Http;
use mysqli;

class LaboratoriumController extends Controller
{
    // public $baseUrl = "http://sim.rsudwaled.id/simrs/api/penunjang/";
    // public $baseRis = "http://sim.rsudwaled.id/simrs/api/ris/";

    public $baseUrl = "http://192.168.2.30/simrs/api/penunjang/";
    public $baseRis = "http://192.168.2.30/simrs/api/ris/";

    public function indexlaboratorium()
    {
        $unit = auth()->user()->unit;

        $now = Carbon::now()->format('Ymd');
        $pasienorder = DB::connection('mysql2')->select("CALL SP_RIWAYAT_LAYANAN_RADIOLOGI('$unit','$now','$now','')");
        $jumlahpasien = count($pasienorder);

        $orderpoli = DB::select('SELECT 
        a.* 
        ,fc_nama_px(no_rm) AS nama_pasien 
        ,fc_NAMA_PENJAMIN2(kode_penjaminx) AS penjamin
        FROM ts_layanan_header_order a 
        WHERE DATE(a.tgl_entry) = ? AND a.status_layanan = 1 AND a.kode_unit = ?', [$now, $unit]);
        $jumlahorder = count($orderpoli);
        // $order = Http::get($this->baseUrl . 'get_order_layanan', [
        //     'unit' => "3002",
        // ]);
        $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU('','','','$now')");
        $jumlahorderpasien = count($pasienkunjungan);
        // $response = Http::get($this->baseUrl . 'get_tarif_laboratorium', [
        //     'kelas' => '3',
        // ]);


        return view('penunjang.index', [
            'title' => 'SIRAMAH | PENUNJANG',
            'pasienorder' => $pasienorder,
            'pasienkunjungan' => $pasienkunjungan,
            'orderpoli' => $orderpoli,
            'jumlahpasien' => $jumlahpasien,
            'jumlahorder' => $jumlahorder,
            'jumlahorderpasien' => $jumlahorderpasien



        ]);
        # code...

    }
    public function datapasien()
    {
        $now = Carbon::now()->format('Ymd');
        $unit = auth()->user()->unit;

        $pasienkunjungan = DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU('','','','$now')");
        $orderpoli = DB::select('SELECT 
        a.* 
        ,fc_nama_px(no_rm) AS nama_pasien 
        ,fc_NAMA_PENJAMIN2(kode_penjaminx) AS penjamin
        FROM ts_layanan_header_order a 
        WHERE DATE(a.tgl_entry) = ? AND a.status_layanan = 1 AND a.kode_unit = ?', [$now, $unit]);


        return view('penunjang.tablependaftaran', [
            'pasienkunjungan' => $pasienkunjungan,
            'orderpoli' => $orderpoli,


        ]);
    }
    public function sendResponse($message, $data, $code = 200)
    {
        $response = [
            'response' => $data,
            'metadata' => [
                'message' => $message,
                'code' => $code,
            ],
        ];
        return response()->json($response, $code);
    }
    public function sendError($error, $code = 404)
    {
        $response = [
            'metadata' => [
                'message' => $error,
                'code' => $code,
            ],
        ];
        return response()->json($response, $code);
    }
    public function hitungkunjungan()
    {
        $unit = auth()->user()->unit;
        $now = Carbon::now()->format('Ymd');
        $pasienorder = DB::connection('mysql2')->select("CALL SP_RIWAYAT_LAYANAN_RADIOLOGI('$unit','$now','$now','')");
        $jumlahpasien = count($pasienorder);
        return view('penunjang.jumlahpasien', [
            'jumlahpasien' => $jumlahpasien,


        ]);
    }
    public function hitungorder()
    {
        $unit = auth()->user()->unit;
        $now = Carbon::now()->format('Ymd');
        $pasienkunjungan = DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU('','','','$now')");

        $jumlahorderpasien = count($pasienkunjungan);
        return view('penunjang.jumlahorderpasien', [
            'jumlahorderpasien' => $jumlahorderpasien,


        ]);
    }
    public function hitungorderpoli()
    {
        $unit = auth()->user()->unit;
        $now = Carbon::now()->format('Ymd');
        $orderpoli = DB::select('SELECT 
        a.* 
        ,fc_nama_px(no_rm) AS nama_pasien 
        ,fc_NAMA_PENJAMIN2(kode_penjaminx) AS penjamin
        FROM ts_layanan_header_order a 
        WHERE DATE(a.tgl_entry) = ? AND a.status_layanan = 1 AND a.kode_unit = ?', [$now, $unit]);
        $jumlahorder = count($orderpoli);
        return view('penunjang.jumlahorder', [
            'jumlahorder' => $jumlahorder,


        ]);
    }
    public function ambildata()
    {
        $unit = auth()->user()->unit;
        $now = Carbon::now()->format('Ymd');
        $pasienorder = DB::connection('mysql2')->select("CALL SP_RIWAYAT_LAYANAN_RADIOLOGI('$unit','$now','$now','')");


        return view('penunjang.ordertable', [
            'pasienorder' => $pasienorder,


        ]);
    }
    public function tampilpaket(Request $request)
    {

        $unit = auth()->user()->unit;

        $paketdetail = DB::select("CALL SP_CARI_LAYANAN_PAKET('$unit','$request->kelas','$request->idpaket')");

        return view('penunjang.tabelpaket', [
            'paketdetail' => $paketdetail,


        ]);
    }
    public function riwayatpasien(Request $request)
    {
        $riwayat = DB::select("CALL SP_RIWAYAT_LAYANAN_RADIOLOGI_PASIEN('$request->kodeunit','$request->norm')");
        return view('penunjang.riwayatpasien', [
            'riwayat' => $riwayat
        ]);
    }
    public function terpilihpasien(Request $request)

    {
        $unit = auth()->user()->unit;
        $paket = DB::select('SELECT DISTINCT 
        id_rutin AS id_paket 
        ,nama 
        ,kode_unit
        FROM mt_tarif_rutin_unit
        WHERE kode_unit = ?', [$unit]);
        // $dokter = Http::get($this->baseRis . 'dokter_get');
        $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_PLUS_PAKET('$request->norm','$request->nama','$request->alamat','$request->tgl_kunjungan')");
        if ($pasienkunjungan == null) {
            $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_RI('$request->norm','$request->nama','$request->alamat')");
        } else if ($pasienkunjungan == null) {
            $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_RAWAT_JALAN('$request->norm','$request->nama','$request->alamat','','$request->tgl_kunjungan')");
        } else {
            $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_PLUS_PAKET('$request->norm','$request->nama','$request->alamat','$request->tgl_kunjungan')");
        }
        $pasienkunjunganorder = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_ORDER_PENUNJANG('$request->kode_kunjungan','$request->norm','$request->nama','','','$unit'); ");

        // $response = Http::get($this->baseUrl . 'get_tarif_laboratorium', [
        //     'kelas' => '3',
        // ]);
        $pasienpoli = DB::select('SELECT * FROM ts_layanan_header_order WHERE id = ?;', [$request->idheader]);
        $layanan = DB::select("CALL SP_CARI_TARIF_PELAYANAN_RAD('$request->kelas_unit','','$request->kelas')");
        // if ($response->status() == 200) {
        //     // foreach ($layanan->json() as  $value) {
        //     //     dd($value['Tindakan']);# code...
        //     // }
        //     $lab = json_decode($response)->data;
        //     $dokter = json_decode($dokter)->data;
        return view('penunjang.pasienpilihan', [
            'title' => 'SIRAMAH | PENUNJANG',
            'layanan' => $layanan,
            // 'dokter' => $dokter,
            'index' => $request->index,
            'pasienkunjungan' => $pasienkunjungan,
            'unit' => $unit,
            'pasienpoli' => $pasienpoli,
            'paket' => $paket,
            'pasienkunjunganorder' => $pasienkunjunganorder



        ]);
        # code...
        // } else {

        //     # code...
        // }
    }
    public function pasienerm(Request $request)

    {
        $unit = auth()->user()->unit;

        $pasien = DB::select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU('$request->norm','$request->nama','$request->alamat','$request->tglmasuk')");
        $orderpoli = DB::select('SELECT 
        a.id
        ,id_layanan_detail
        ,a.kode_layanan_header
        ,kode_tarif_detail
        ,fc_nama_tarif(LEFT(kode_tarif_detail, 6)) AS nama_tarif
        ,total_tarif
        ,jumlah_layanan
        ,jumlah_retur
        ,b.total_layanan
        ,diskon_layanan
        ,diskon_dokter
        ,grantotal_layanan
        ,status_layanan_detail
        ,tgl_layanan_detail
        ,cyto
        ,row_id_header
        ,fc_nama_paramedis1(dok_kirim) AS nama_dokter
        ,a.diagnosa
      
        
        FROM ts_layanan_header_order  a
        INNER JOIN  ts_layanan_detail_order b ON a.id=b.row_id_header
        WHERE row_id_header = ?;', [$request->idheader]);

        return view('penunjang.ordererm', [
            'title' => 'SIRAMAH | PENUNJANG',
            'index' => $request->index,
            'unit' => $unit,
            'orderpoli' => $orderpoli,
            'pasien' => $pasien



        ]);
        # code...

    }
    public function pasienterpilih(Request $request)
    {
        // $pasienorder = DB::select("CALL ORDER_HASIL_INPUTAN_HARIAN('3002', '$request->tgl_order', '$request->no_rm')");
        $unit = auth()->user()->unit;


        $pasienorder = DB::connection('mysql2')->select("CALL ORDER_HASIL_INPUTAN_HARIAN('$unit','$request->tgl_order','$request->no_rm')");
        $order = DB::connection('mysql2')->select("CALL ORDER_HASIL_INPUTAN_HARIAN_DETAIL($request->id)");
        // $dokter = Http::get($this->baseRis.'dokter_get');
        // $response = Http::get($this->baseUrl.'get_tarif_laboratorium', [
        //     'kelas' => '3',
        // ]);
        // $pasienorder = Http::get($this->baseUrl.'get_order_layanan', [
        //     'kode_layanan_header' => $request->kode_layanan_header,
        //     'no_rm' => $request->no_rm,
        //     'unit'=> "3002"
        // ]);


        // if ($dokter->status() == 200) {
        // foreach ($layanan->json() as  $value) {
        //     dd($value['Tindakan']);# code...
        // }

        // $dokter = json_decode($dokter)->data;
        return view('penunjang.pasiendetail', [
            'title' => 'SIRAMAH | PENUNJANG',
            'order' => $order,
            'index' => $request->index,
            'pasienorder' => $pasienorder
        ]);
        //     # code...
        // } else {

        //     # code...
        // }
    }
    public function caritanggal(Request $request)
    {
        $unit = auth()->user()->unit;

        $pasienorder = DB::connection('mysql2')->select("CALL SP_RIWAYAT_LAYANAN_RADIOLOGI('$unit','$request->tgl_entry','$request->tgl_entry1','')");

        return view('penunjang.ordertable', [
            'title' => 'SIRAMAH | PENUNJANG',
            'pasienorder' => $pasienorder
        ]);
    }

    public function caripasienpendaftaran(Request $request)
    {
        $unit = auth()->user()->unit;
        $tgl = $request->tgl_kunjungan;
        $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_PLUS_PAKET('$request->norm','$request->nama','$request->alamat','$request->tgl_kunjungan')");
        if ($pasienkunjungan == null) {
            $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_RI('$request->norm','$request->nama','$request->alamat')");
        } else if ($pasienkunjungan == null) {
            $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_RAWAT_JALAN('$request->norm','$request->nama','$request->alamat','','$request->tgl_kunjungan')");
        } else {
            $pasienkunjungan = DB::connection('mysql2')->select("CALL SP_PANGGIL_PASIEN_PENUNJANG_BARU_PLUS_PAKET('$request->norm','$request->nama','$request->alamat','$request->tgl_kunjungan')");
        }
        $orderpoli = DB::select('SELECT 
        a.* 
        ,fc_nama_px(no_rm) AS nama_pasien 
        ,fc_NAMA_PENJAMIN2(kode_penjaminx) AS penjamin
        FROM ts_layanan_header_order a 
        WHERE DATE(a.tgl_entry) = ? AND a.status_layanan = 1 AND a.kode_unit = ?', [$tgl, $unit]);
        return view('penunjang.tablependaftaran', [
            'title' => 'SIRAMAH | PENUNJANG',
            'pasienkunjungan' => $pasienkunjungan,
            'orderpoli' => $orderpoli
        ]);
    }
    public function simpanorder(Request $request)
    {


        // $dt = Carbon::now()->timezone('Asia/Jakarta');
        // $date = $dt->toDateString();
        // $time = $dt->toTimeString();
        // $now = $date . ' ' . $time;
        // $unit = auth()->user()->unit;

        // $data = json_decode($_POST['data'], true);
        // foreach ($data as $nama) {
        //     $index = $nama['name'];
        //     $value = $nama['value'];
        //     $dataSet[$index] = $value;
        //     if ($index == 'cyto') {
        //         $arrayindex[] = $dataSet;
        //     }
        // }
        // $kode_header = $this->createOrderHeader('LAB');
        // $header = mt_kode_header::create([
        //     'kode_header' => $kode_header,
        //     'tgl_header' => date('Y-m-d')
        // ]);
        // $data_layanan_header = [
        //     'kode_layanan_header' => $kode_header,
        //     'tgl_entry' => $now,
        //     'kode_kunjungan' => $request->kodekunjungan,
        //     'status_layanan' => 3,
        //     'kode_unit' => $unit,
        //     'kode_tipe_transaksi' => 2,
        //     'kode_penjaminx' => $request->kodepenjamin,
        //     'pic' => auth()->user()->id,
        // ];
        // $head = ts_layanan_header::create($data_layanan_header);
        // foreach ($arrayindex as $arr) {
        //     //jika paket
        //     //looping arryindex jenis paket
        //     if ($arr['jenis'] == 'paket') {
        //         $kodepaket = $arr['kodelayanan'];
        //         $paket = DB::select("CALL SP_CARI_LAYANAN_PAKET('$unit','1','$kodepaket')");
        //         foreach ($paket as $p) {
        //             $id_detail = $this->createLayanandetail();
        //             $savedetail = [
        //                 'id_layanan_detail' => $id_detail,
        //                 'kode_layanan_header' => $kode_header,
        //                 'kode_tarif_detail' => $p->kode_tarif_detail,
        //                 'total_tarif' => $p->harga,
        //                 'jumlah_layanan' => $p->jml,
        //                 'diskon_dokter' => $arr['disc'],
        //                 'cyto' => $arr['cyto'],
        //                 'total_layanan' => $p->harga,
        //                 'grantotal_layanan' => $p->harga,
        //                 'status_layanan_detail' => 'OPN',
        //                 'dokter_pengirim' => $request->dokter,
        //                 'diagnosa' => $request->diagnosa,
        //                 'tgl_layanan_detail' => $now,
        //                 'tagihan_penjamin' => '0',
        //                 'tagihan_pribadi' => '0',
        //                 'tgl_layanan_detail_2' => $now,
        //                 'row_id_header' => $head['id']
        //             ];
        //             $ts_layanan_detail = ts_layanan_detail::create($savedetail);
        //         }
        //     } else {
        //         $id_detail = $this->createLayanandetail();
        //         $savedetail = [
        //             'id_layanan_detail' => $id_detail,
        //             'kode_layanan_header' => $kode_header,
        //             'kode_tarif_detail' => $arr['kodelayanan'],
        //             'total_tarif' => $arr['tarif'],
        //             'jumlah_layanan' => $arr['qty'],
        //             'diskon_dokter' => $arr['disc'],
        //             'cyto' => $arr['cyto'],
        //             'total_layanan' => $arr['tarif'] * $arr['qty'],
        //             'grantotal_layanan' => $arr['tarif'] * $arr['qty'],
        //             'status_layanan_detail' => 'OPN',
        //             'dokter_pengirim' => $request->dokter,
        //             'diagnosa' => $request->diagnosa,
        //             'tgl_layanan_detail' => $now,
        //             'tagihan_penjamin' => '0',
        //             'tagihan_pribadi' => '0',
        //             'tgl_layanan_detail_2' => $now,
        //             'row_id_header' => $head['id']
        //         ];
        //         $ts_layanan_detail = ts_layanan_detail::create($savedetail);
        //     }
        // }
        $umum = $request->gt;
        $kelasunit = $request->kelasunit;
        $norm  = $request->norm;
        $namaunit = $request->namaunit;
        $kelas = $request->kelas;
        $kodeunit = $request->kodeunit;
        $ukirim = $kodeunit . ' | ' . $namaunit . ' | ' . $kelas;
        $sp = 'OPN';
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $unit = auth()->user()->unit;

        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }

        foreach ($arrayindex as $arr) {
            //jika paket
            //looping arryindex jenis paket
            if ($arr['jenis'] == 'paket' and $kelasunit == '2' and $umum == 'TUNAI') {
                $kode_header = $this->createOrderHeader('LAB');
                $header = mt_kode_header::create([
                    'kode_header' => $kode_header,
                    'tgl_header' => date('Y-m-d')
                ]);
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_header,
                    'tgl_entry' => $now,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'keterangan' => 'PENDING',
                    'unit_pengirim' => $ukirim,
                    'diagnosa' => $request->diagnosa,
                    'dok_kirim' => $request->dokter,
                    'tagihan_pribadi' => $dataSet['tarif'],
                    'diskon_global' => $dataSet['disc'],
                    'status_pembayaran' => $sp,
                    'status_layanan' => 1,
                    'kode_unit' => 3002,
                    'kode_tipe_transaksi' => 2,
                    'kode_penjaminx' => $request->kodepenjamin,
                    'pic' => auth()->user()->id,
                ];
                $head = ts_layanan_header::create($data_layanan_header);
                $kodepaket = $arr['kodelayanan'];
                $paket = DB::select("CALL SP_CARI_LAYANAN_PAKET('$unit','1','$kodepaket')");
                foreach ($paket as $p) {
                    $id_detail = $this->createLayanandetail();
                    $savedetail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_header,
                        'kode_tarif_detail' =>  $kodepaket,
                        'total_tarif' => $p['tarif'],
                        'jumlah_layanan' => $p['qty'],
                        'diskon_dokter' => $p['disc'],
                        'cyto' => $p['cyto'],
                        'total_layanan' => $p['tarif'],
                        'grantotal_layanan' => $p['tarif'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_pribadi' => $p['tarif'],
                        'tagihan_pribadi' => '0',
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $head['id']
                    ];
                    $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                }
            } elseif ($umum == 'TUNAI' and $arr['jenis'] == 'paket') {
                if ($kelasunit == '1') {
                    $kode_header = $this->createOrderHeader('LAB');
                    $header = mt_kode_header::create([
                        'kode_header' => $kode_header,
                        'tgl_header' => date('Y-m-d')
                    ]);
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_header,
                        'tgl_entry' => $now,
                        'kode_kunjungan' => $request->kodekunjungan,
                        'status_pembayaran' => $sp,
                        'keterangan' => 'PENDING',
                        'unit_pengirim' => $ukirim,
                        'diagnosa' => $request->diagnosa,
                        'dok_kirim' => $request->dokter,
                        'tagihan_pribadi' => $dataSet['tarif'],
                        'diskon_global' => $dataSet['disc'],
                        'status_layanan' => 1,
                        'kode_unit' => 3002,
                        'kode_tipe_transaksi' => 1,
                        'kode_penjaminx' => $request->kodepenjamin,
                        'pic' => auth()->user()->id,
                    ];
                    $head = ts_layanan_header::create($data_layanan_header);
                    $kodepaket = $arr['kodelayanan'];
                    $paket = DB::select("CALL SP_CARI_LAYANAN_PAKET('$unit','1','$kodepaket')");
                    foreach ($paket as $p) {
                        $id_detail = $this->createLayanandetail();
                        $savedetail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_header,
                            'kode_tarif_detail' =>  $kodepaket,
                            'total_tarif' => $p['tarif'],
                            'jumlah_layanan' => $p['qty'],
                            'diskon_dokter' => $p['disc'],
                            'cyto' => $p['cyto'],
                            'total_layanan' => $p['tarif'],
                            'grantotal_layanan' => $p['tarif'],
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tagihan_pribadi' => $p['tarif'],
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $head['id']
                        ];
                        $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                    }
                } elseif ($kelasunit == '3') {
                    $kode_header = $this->createOrderHeader('LAB');
                    $header = mt_kode_header::create([
                        'kode_header' => $kode_header,
                        'tgl_header' => date('Y-m-d')
                    ]);
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_header,
                        'tgl_entry' => $now,
                        'kode_kunjungan' => $request->kodekunjungan,
                        'status_pembayaran' => $sp,
                        'keterangan' => 'PENDING',
                        'unit_pengirim' => $ukirim,
                        'diagnosa' => $request->diagnosa,
                        'dok_kirim' => $request->dokter,
                        'tagihan_pribadi' => $dataSet['tarif'],
                        'diskon_global' => $dataSet['disc'],
                        'status_layanan' => 1,
                        'kode_unit' => 3002,
                        'kode_tipe_transaksi' => 1,
                        'kode_penjaminx' => $request->kodepenjamin,
                        'pic' => auth()->user()->id,
                    ];
                    $head = ts_layanan_header::create($data_layanan_header);
                    $kodepaket = $arr['kodelayanan'];
                    $paket = DB::select("CALL SP_CARI_LAYANAN_PAKET('$unit','1','$kodepaket')");
                    foreach ($paket as $p) {
                        $id_detail = $this->createLayanandetail();
                        $savedetail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_header,
                            'kode_tarif_detail' =>  $kodepaket,
                            'total_tarif' => $p['tarif'],
                            'jumlah_layanan' => $p['qty'],
                            'diskon_dokter' => $p['disc'],
                            'cyto' => $p['cyto'],
                            'total_layanan' => $p['tarif'],
                            'grantotal_layanan' => $p['tarif'],
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tagihan_pribadi' => $p['tarif'],
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $head['id']
                        ];
                        $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                    }
                } elseif ($kelasunit == '4') {
                    $kode_header = $this->createOrderHeader('LAB');
                    $header = mt_kode_header::create([
                        'kode_header' => $kode_header,
                        'tgl_header' => date('Y-m-d')
                    ]);
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_header,
                        'tgl_entry' => $now,
                        'kode_kunjungan' => $request->kodekunjungan,
                        'status_pembayaran' => $sp,
                        'keterangan' => 'PENDING',
                        'unit_pengirim' => $ukirim,
                        'diagnosa' => $request->diagnosa,
                        'dok_kirim' => $request->dokter,
                        'tagihan_pribadi' => $dataSet['tarif'],
                        'diskon_global' => $dataSet['disc'],
                        'status_layanan' => 1,
                        'kode_unit' => 3002,
                        'kode_tipe_transaksi' => 1,
                        'kode_penjaminx' => $request->kodepenjamin,
                        'pic' => auth()->user()->id,
                    ];
                    $head = ts_layanan_header::create($data_layanan_header);
                    $kodepaket = $arr['kodelayanan'];
                    $paket = DB::select("CALL SP_CARI_LAYANAN_PAKET('$unit','1','$kodepaket')");
                    foreach ($paket as $p) {
                        $id_detail = $this->createLayanandetail();
                        $savedetail = [
                            'id_layanan_detail' => $id_detail,
                            'kode_layanan_header' => $kode_header,
                            'kode_tarif_detail' =>  $kodepaket,
                            'total_tarif' => $p['tarif'],
                            'jumlah_layanan' => $p['qty'],
                            'diskon_dokter' => $p['disc'],
                            'cyto' => $p['cyto'],
                            'total_layanan' => $p['tarif'],
                            'grantotal_layanan' => $p['tarif'],
                            'status_layanan_detail' => 'OPN',
                            'tgl_layanan_detail' => $now,
                            'tagihan_pribadi' => $p['tarif'],
                            'tgl_layanan_detail_2' => $now,
                            'row_id_header' => $head['id']
                        ];
                        $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                    }
                }
            } elseif ($kelasunit == '2' and $umum == 'TUNAI') {
                $kode_header = $this->createOrderHeader('LAB');
                $header = mt_kode_header::create([
                    'kode_header' => $kode_header,
                    'tgl_header' => date('Y-m-d')
                ]);
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_header,
                    'tgl_entry' => $now,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'keterangan' => 'PENDING',
                    'unit_pengirim' => $ukirim,
                    'diagnosa' => $request->diagnosa,
                    'dok_kirim' => $request->dokter,
                    'tagihan_pribadi' => $dataSet['tarif'],
                    'diskon_global' => $dataSet['disc'],
                    'status_pembayaran' => $sp,
                    'status_layanan' => 1,
                    'kode_unit' => 3002,
                    'kode_tipe_transaksi' => 2,
                    'kode_penjaminx' => $request->kodepenjamin,
                    'pic' => auth()->user()->id,
                ];
                $head = ts_layanan_header::create($data_layanan_header);

                $id_detail = $this->createLayanandetail();
                $savedetail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_header,
                    'kode_tarif_detail' =>  $arr['kodelayanan'],
                    'total_tarif' => $arr['tarif'],
                    'jumlah_layanan' => $arr['qty'],
                    'diskon_dokter' => $arr['disc'],
                    'cyto' => $arr['cyto'],
                    'total_layanan' => $arr['tarif'],
                    'grantotal_layanan' => $arr['tarif'],
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_pribadi' => $arr['tarif'],
                    'tagihan_pribadi' => '0',
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $head['id']
                ];
                $ts_layanan_detail = ts_layanan_detail::create($savedetail);
            } elseif ($umum == 'TUNAI') {
                if ($kelasunit == '1') {
                    $kode_header = $this->createOrderHeader('LAB');
                    $header = mt_kode_header::create([
                        'kode_header' => $kode_header,
                        'tgl_header' => date('Y-m-d')
                    ]);
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_header,
                        'tgl_entry' => $now,
                        'kode_kunjungan' => $request->kodekunjungan,
                        'status_pembayaran' => $sp,
                        'keterangan' => 'PENDING',
                        'unit_pengirim' => $ukirim,
                        'diagnosa' => $request->diagnosa,
                        'dok_kirim' => $request->dokter,
                        'tagihan_pribadi' => $dataSet['tarif'],
                        'diskon_global' => $dataSet['disc'],
                        'status_layanan' => 1,
                        'kode_unit' => 3002,
                        'kode_tipe_transaksi' => 1,
                        'kode_penjaminx' => $request->kodepenjamin,
                        'pic' => auth()->user()->id,
                    ];
                    $head = ts_layanan_header::create($data_layanan_header);

                    $id_detail = $this->createLayanandetail();
                    $savedetail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_header,
                        'kode_tarif_detail' =>  $arr['kodelayanan'],
                        'total_tarif' => $arr['tarif'],
                        'jumlah_layanan' => $arr['qty'],
                        'diskon_dokter' => $arr['disc'],
                        'cyto' => $arr['cyto'],
                        'total_layanan' => $arr['tarif'],
                        'grantotal_layanan' => $arr['tarif'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_pribadi' => $arr['tarif'],
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $head['id']
                    ];
                    $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                } elseif ($kelasunit == '3') {
                    $kode_header = $this->createOrderHeader('LAB');
                    $header = mt_kode_header::create([
                        'kode_header' => $kode_header,
                        'tgl_header' => date('Y-m-d')
                    ]);
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_header,
                        'tgl_entry' => $now,
                        'kode_kunjungan' => $request->kodekunjungan,
                        'status_pembayaran' => $sp,
                        'keterangan' => 'PENDING',
                        'unit_pengirim' => $ukirim,
                        'diagnosa' => $request->diagnosa,
                        'dok_kirim' => $request->dokter,
                        'tagihan_pribadi' => $dataSet['tarif'],
                        'diskon_global' => $dataSet['disc'],
                        'status_layanan' => 1,
                        'kode_unit' => 3002,
                        'kode_tipe_transaksi' => 1,
                        'kode_penjaminx' => $request->kodepenjamin,
                        'pic' => auth()->user()->id,
                    ];
                    $head = ts_layanan_header::create($data_layanan_header);

                    $id_detail = $this->createLayanandetail();
                    $savedetail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_header,
                        'kode_tarif_detail' =>  $arr['kodelayanan'],
                        'total_tarif' => $arr['tarif'],
                        'jumlah_layanan' => $arr['qty'],
                        'diskon_dokter' => $arr['disc'],
                        'cyto' => $arr['cyto'],
                        'total_layanan' => $arr['tarif'],
                        'grantotal_layanan' => $arr['tarif'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_pribadi' => $arr['tarif'],
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $head['id']
                    ];
                    $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                } elseif ($kelasunit == '4') {
                    $kode_header = $this->createOrderHeader('LAB');
                    $header = mt_kode_header::create([
                        'kode_header' => $kode_header,
                        'tgl_header' => date('Y-m-d')
                    ]);
                    $data_layanan_header = [
                        'kode_layanan_header' => $kode_header,
                        'tgl_entry' => $now,
                        'kode_kunjungan' => $request->kodekunjungan,
                        'status_pembayaran' => $sp,
                        'keterangan' => 'PENDING',
                        'unit_pengirim' => $ukirim,
                        'diagnosa' => $request->diagnosa,
                        'dok_kirim' => $request->dokter,
                        'tagihan_pribadi' => $dataSet['tarif'],
                        'diskon_global' => $dataSet['disc'],
                        'status_layanan' => 1,
                        'kode_unit' => 3002,
                        'kode_tipe_transaksi' => 1,
                        'kode_penjaminx' => $request->kodepenjamin,
                        'pic' => auth()->user()->id,
                    ];
                    $head = ts_layanan_header::create($data_layanan_header);

                    $id_detail = $this->createLayanandetail();
                    $savedetail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_header,
                        'kode_tarif_detail' =>  $arr['kodelayanan'],
                        'total_tarif' => $arr['tarif'],
                        'jumlah_layanan' => $arr['qty'],
                        'diskon_dokter' => $arr['disc'],
                        'cyto' => $arr['cyto'],
                        'total_layanan' => $arr['tarif'],
                        'grantotal_layanan' => $arr['tarif'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_pribadi' => $arr['tarif'],
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $head['id']
                    ];
                    $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                }
            } else {
                $kode_header = $this->createOrderHeader('LAB');
                $header = mt_kode_header::create([
                    'kode_header' => $kode_header,
                    'tgl_header' => date('Y-m-d')
                ]);
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_header,
                    'tgl_entry' => $now,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'status_pembayaran' => $sp,
                    'keterangan' => 'PENDING',
                    'unit_pengirim' => $ukirim,
                    'diagnosa' => $request->diagnosa,
                    'dok_kirim' => $request->dokter,
                    'tagihan_penjamin' => $dataSet['tarif'],
                    'diskon_global' => $dataSet['disc'],
                    'status_layanan' => 2,
                    'kode_unit' => 3002,
                    'kode_tipe_transaksi' => 2,
                    'kode_penjaminx' => $request->kodepenjamin,
                    'pic' => auth()->user()->id,
                ];
                $head = ts_layanan_header::create($data_layanan_header);

                $id_detail = $this->createLayanandetail();
                $savedetail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_header,
                    'kode_tarif_detail' =>  $arr['kodelayanan'],
                    'total_tarif' => $arr['tarif'],
                    'jumlah_layanan' => $arr['qty'],
                    'diskon_dokter' => $arr['disc'],
                    'cyto' => $arr['cyto'],
                    'total_layanan' => $arr['tarif'],
                    'grantotal_layanan' => $arr['tarif'],
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $arr['tarif'],
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $head['id']
                ];
                $ts_layanan_detail = ts_layanan_detail::create($savedetail);
            }
            // DB::select(
            //     'CAll SP_HIS2LIS_INSERT_TO_HEADER_DETAIL_LIS_IN_HIS_2(?,?)',
            //     [$kode_header, $head['id']]
            // );

        }

        // $back = [
        //     'kode' => 200,
        //     'message' => ''
        // ];
        // echo json_encode($back);
        // die;
        // DB::select(
        //     'CAll SP_HIS2LIS_INSERT_TO_HEADER_DETAIL_LIS_IN_HIS_2(?,?)',
        //     [$kode_header, $head['id']]
        // );



        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;
    }


    public function simpanorderradiologi(Request $request)
    {
        $kodepenjamin = $request->kodepenjamin;
        $kelasunit = $request->kelasunit;
        $norm  = $request->norm;
        $namaunit = $request->namaunit;
        $kelas = $request->kelas;
        $kodeunit = $request->kodeunit;
        $ukirim = $kodeunit . ' | ' . $namaunit . ' | ' . $kelas;
        $sp = 'OPN';
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }
        $count = count($arrayindex);
        $sum = -$count;
        foreach ($arrayindex as $arr) {
            $discount = $arr['disc'];
            $cyto = $arr['cyto'];
            $tarif =
                $sum += array_sum($arr);
            if ($cyto == 1) {
                $gt = $tarif + ($tarif * 50 / 100);
            } elseif ($discount == $discount) {
                $gt = $tarif - ($tarif * $discount / 100);
            } else {
                $gt = $tarif;
            }
        }

        $kode_header = $this->createOrderHeader('RAD');
        $header = mt_kode_header::create([
            'kode_header' => $kode_header,
            'tgl_header' => date('Y-m-d')
        ]);


        if ($kodepenjamin == 'P01') {
            if ($kelasunit == '2') {
                $data_layanan_header = [
                    'kode_layanan_header' => $kode_header,
                    'tgl_entry' => $now,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'qty_header' => $dataSet['qty'],
                    'keterangan' => 'PENDING',
                    'unit_pengirim' => $ukirim,
                    'diagnosa' => $request->diagnosa,
                    'dok_kirim' => $request->dokter,
                    'total_layanan' => $gt,
                    'tagihan_pribadi' => $gt,
                    'diskon_global' => $dataSet['disc'],
                    'status_pembayaran' => $sp,
                    'status_layanan' => 1,
                    'kode_unit' => 3003,
                    'kode_tipe_transaksi' => 2,
                    'kode_penjaminx' => $request->kodepenjamin,
                    'pic' => auth()->user()->id,
                ];
                $head = ts_layanan_header::create($data_layanan_header);
                $id_detail = $this->createLayanandetail();
                foreach ($arrayindex as $arr) {
                    $savedetail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_header,
                        'kode_tarif_detail' =>  $arr['kodelayanan'],
                        'total_tarif' => $arr['tarif'],
                        'jumlah_layanan' => $arr['qty'],
                        'diskon_dokter' => $arr['disc'],
                        'cyto' => $arr['cyto'],
                        'total_layanan' => $arr['tarif'],
                        'grantotal_layanan' => $arr['tarif'] * $arr['qty'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_pribadi' => $tarif,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $head['id']
                    ];
                    $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                }
            } else {

                $data_layanan_header = [
                    'kode_layanan_header' => $kode_header,
                    'tgl_entry' => $now,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'status_pembayaran' => $sp,
                    'keterangan' => 'PENDING',
                    'qty_header' => $dataSet['qty'],
                    'unit_pengirim' => $ukirim,
                    'diagnosa' => $request->diagnosa,
                    'dok_kirim' => $request->dokter,
                    'total_layanan' => $gt,
                    'tagihan_pribadi' => $gt,
                    'diskon_global' => $dataSet['disc'],
                    'status_layanan' => 1,
                    'kode_unit' => 3003,
                    'kode_tipe_transaksi' => 1,
                    'kode_penjaminx' => $request->kodepenjamin,
                    'pic' => auth()->user()->id,
                ];
                $head = ts_layanan_header::create($data_layanan_header);
                $id_detail = $this->createLayanandetail();
                foreach ($arrayindex as $arr) {
                    $savedetail = [
                        'id_layanan_detail' => $id_detail,
                        'kode_layanan_header' => $kode_header,
                        'kode_tarif_detail' =>  $arr['kodelayanan'],
                        'total_tarif' => $arr['tarif'],
                        'jumlah_layanan' => $arr['qty'],
                        'diskon_dokter' => $arr['disc'],
                        'cyto' => $arr['cyto'],
                        'total_layanan' => $arr['tarif'],
                        'grantotal_layanan' => $arr['tarif'] * $arr['qty'],
                        'status_layanan_detail' => 'OPN',
                        'tgl_layanan_detail' => $now,
                        'tagihan_pribadi' => $tarif,
                        'tgl_layanan_detail_2' => $now,
                        'row_id_header' => $head['id']
                    ];
                    $ts_layanan_detail = ts_layanan_detail::create($savedetail);
                }
            }
        } else {
            $data_layanan_header = [
                'kode_layanan_header' => $kode_header,
                'tgl_entry' => $now,
                'kode_kunjungan' => $request->kodekunjungan,
                'status_pembayaran' => $sp,
                'keterangan' => 'PENDING',
                'qty_header' => $dataSet['qty'],
                'unit_pengirim' => $ukirim,
                'diagnosa' => $request->diagnosa,
                'dok_kirim' => $request->dokter,
                'total_layanan' => $gt,
                'tagihan_penjamin' => $gt,
                'diskon_global' => $dataSet['disc'],
                'status_layanan' => 2,
                'kode_unit' => 3003,
                'kode_tipe_transaksi' => 2,
                'kode_penjaminx' => $request->kodepenjamin,
                'pic' => auth()->user()->id,
            ];
            $head = ts_layanan_header::create($data_layanan_header);
            $id_detail = $this->createLayanandetail();
            foreach ($arrayindex as $arr) {
                $savedetail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_header,
                    'kode_tarif_detail' =>  $arr['kodelayanan'],
                    'total_tarif' => $arr['tarif'],
                    'jumlah_layanan' => $arr['qty'],
                    'diskon_dokter' => $arr['disc'],
                    'cyto' => $arr['cyto'],
                    'total_layanan' => $arr['tarif'],
                    'grantotal_layanan' => $arr['tarif'] * $arr['qty'],
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $gt,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $head['id']
                ];

                $ts_layanan_detail = ts_layanan_detail::create($savedetail);
            }
        }
        $kode_header = $ts_layanan_detail['kode_layanan_header'];
        $idhed = $ts_layanan_detail['row_id_header'];

        // $receive_items = $this->cetakpdf($kode_header, $idhed);
        $back = [
            'kode' => 200,
            'idhed' => $idhed,
            'kode_header' => $kode_header,
        ];
        echo json_encode($back);
        die;


        // $idheader = $head['id'];
        // $risorder = DB::connection('mysql2')->select("CALL RIS_order_save ('$norm','$idheader','$date')");
        // // $urgensi = $risorder[0]->urgensi;
        // // api dokter
        // $dokter = DB::connection('mysql2')->select('select * from ris_dokter where id = ?', [$risorder[0]->iddokter]);
        // $url = 'http://192.168.10.22/ris/public/api/dokter';
        // $datadokter = [
        //     'id' =>  $dokter[0]->id,
        //     'nama' => $dokter[0]->nama,
        //     'jk' => $dokter[0]->jk,
        //     'tgl_lahir' => $dokter[0]->tgl_lahir,
        //     'kota' => $dokter[0]->kota,
        //     'alamat' => $dokter[0]->alamat
        // ];
        // $response = Http::post($url, $datadokter);
        // $response = json_decode($response);
        // if ($response->status == "success") {
        //     //api pasien
        //     $url = 'http://192.168.10.22/ris/public/api/pasien';
        //     $datapasien = [
        //         'id' => $risorder[0]->idpx,
        //         'nama' => $risorder[0]->nama_px,
        //         'norm' => $risorder[0]->no_rm,
        //         'jk' => $risorder[0]->JK,
        //         'tgl_lahir' => $risorder[0]->tgl_lahir,
        //         'kota' => $risorder[0]->kota,
        //         'alamat' => $risorder[0]->alamat
        //     ];
        //     $response = Http::post($url, $datapasien);
        //     $response = json_decode($response);
        //     if ($response->status == "success") {
        //           // api ruangan
        //           $ruangan = DB::connection('mysql2')->select('SELECT * FROM ris_ruangan WHERE id = ?', [$risorder[0]->idruangan]);
        //           $url = 'http://192.168.10.22/ris/public/api/ruangan';
        //           $dataruangan = [
        //               'id' => $ruangan[0]->id,
        //               'kelas' => $ruangan[0]->kelas,
        //               'ruangan' => $ruangan[0]->ruangan
        //           ];
        //           $response = Http::post($url, $dataruangan);
        //           $response = json_decode($response);
        //           if ($response->status == "success") {
        //             return $this->sendResponse("OK", null, 200);
        //         }

        //         if ($response->status == "error") {
        //             return $this->sendError($response->error_desc, 404);
        //         }
        //     }

        //     if ($response->status == "error") {
        //     //api pasien
        //     $url = 'http://192.168.10.22/ris/public/api/pasien';
        //     $datapasien = [
        //         'id' => $risorder[0]->idpx,
        //         'nama' => $risorder[0]->nama_px,
        //         'norm' => $risorder[0]->no_rm,
        //         'jk' => $risorder[0]->JK,
        //         'tgl_lahir' => $risorder[0]->tgl_lahir,
        //         'kota' => $risorder[0]->kota,
        //         'alamat' => $risorder[0]->alamat
        //     ];
        //     $response = Http::post($url, $datapasien);
        //     $response = json_decode($response); }
        // }

        // if ($response->status == "error") {
        //     //api dokter
        //     $dokter = DB::connection('mysql2')->select('select * from ris_dokter where id = ?', [$risorder[0]->iddokter]);
        //     $url = 'http://192.168.10.22/ris/public/api/dokter';
        //     $datadokter = [
        //         'id' =>  $dokter[0]->id,
        //         'nama' => $dokter[0]->nama,
        //         'jk' => $dokter[0]->jk,
        //         'tgl_lahir' => $dokter[0]->tgl_lahir,
        //         'kota' => $dokter[0]->kota,
        //         'alamat' => $dokter[0]->alamat
        //     ];
        //     $response = Http::post($url, $datadokter);
        //     $response = json_decode($response);
        // } else {
        //     return $this->sendError($response->reason(), $response->status());
        // }
        //api order
        // $url = 'http://192.168.10.22/ris/public/api/order/save';

        // $idpemeriksaan = [$risorder[0]->idpemeriksaan, $risorder[1]->idpemeriksaan];
        // foreach ($idpemeriksaan as $idp) {
        //     $saveris = [
        //         'id_pasien' => $risorder[0]->idpx,
        //         'norm' => $risorder[0]->no_rm,
        //         'nama' => $risorder[0]->nama_px,
        //         'acc_number' => $risorder[0]->acc_number,
        //         'id_dokter' => $risorder[0]->iddokter,
        //         'idjenispemeriksaan' => $idp,
        //         'tgl_pemeriksaan' => $risorder[0]->tgl_entry,
        //         'idruangan' => $risorder[0]->idruangan,
        //         'idasuransi' => $risorder[0]->idasuransi,
        //         'urgensi' => $risorder[0]->urgensi
        //     ];
        // }
        // $response = Http::post($url, $saveris);
        // $response = json_decode($response);

        // if ($response->status == "success") {
        //     return $this->sendResponse("OK", null, 200);
        // }

        // if ($response->status == "error") {
        //     return $this->sendError($response->error_desc, 404);
        // } else {
        //     return $this->sendError($response->reason(), $response->status());
        // }
        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;
    }

    public function simpanradiologi(Request $request)
    {

        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'kodelayanan') {
                $arrayindex[] = $dataSet;
            }
        }

        $kode_header = $this->createOrderHeader('RAD');
        $header = mt_kode_header::create([
            'kode_header' => $kode_header,
            'tgl_header' => date('Y-m-d')
        ]);
        $data_layanan_header = [
            'kode_layanan_header' => $kode_header,
            'tgl_entry' => $now,
            'kode_kunjungan' => $request->kodekunjungan,
            'status_layanan' => 3,
            'kode_unit' => 3003,
            'kode_tipe_transaksi' => 2,
            'kode_penjaminx' => $request->kodepenjamin,
            'pic' => auth()->user()->id,
        ];
        $head = ts_layanan_header::create($data_layanan_header);
        foreach ($arrayindex as $arr) {
            $id_detail = $this->createLayanandetail();
            $savedetail = [
                'id_layanan_detail' => $id_detail,
                'kode_layanan_header' => $kode_header,
                'kode_tarif_detail' =>  $arr['kodelayanan'],
                'total_tarif' => $arr['tarif'],
                'jumlah_layanan' => $arr['qty'],
                'diskon_dokter' => $arr['disc'],
                'cyto' => $arr['cyto'],
                'total_layanan' => $arr['tarif'],
                'grantotal_layanan' => $arr['tarif'],
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tagihan_penjamin' => '0',
                'tagihan_pribadi' => '0',
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $head['id']
            ];
            $ts_layanan_detail = ts_layanan_detail::create($savedetail);
        }
        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;
    }
    public function simpanorderpoli(Request $request)
    {

        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'kodelayanan') {
                $arrayindex[] = $dataSet;
            }
        }

        $kode_header = $this->createOrderHeader('LAB');
        $header = mt_kode_header::create([
            'kode_header' => $kode_header,
            'tgl_header' => date('Y-m-d')
        ]);
        $data_layanan_header = [
            'kode_layanan_header' => $kode_header,
            'tgl_entry' => $now,
            'kode_kunjungan' => $request->kodekunjungan,
            'status_layanan' => 3,
            'kode_unit' => 3002,
            'kode_tipe_transaksi' => 2,
            'kode_penjaminx' => $request->kodepenjamin,
            'pic' => auth()->user()->id,
        ];
        $head = ts_layanan_header::create($data_layanan_header);
        foreach ($arrayindex as $arr) {
            $id_detail = $this->createLayanandetail();
            $savedetail = [
                'id_layanan_detail' => $id_detail,
                'kode_layanan_header' => $kode_header,
                'kode_tarif_detail' =>  $arr['kodelayanan'],
                'total_tarif' => $arr['tarif'],
                'jumlah_layanan' => $arr['qty'],
                'diskon_dokter' => $arr['disc'],
                'cyto' => $arr['cyto'],
                'total_layanan' => $arr['tarif'],
                'grantotal_layanan' => $arr['tarif'],
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tagihan_penjamin' => '0',
                'tagihan_pribadi' => '0',
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $head['id']
            ];
            $ts_layanan_detail = ts_layanan_detail::create($savedetail);
        }
        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;
    }




    public function batalorder(Request $request)
    {
        $id = $request->idheader;
        $kodeheader = $request->kodeheader;

        DB::connection('mysql2')->select('DELETE FROM ts_layanan_detail_order WHERE row_id_header = ?', [$id]);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_header_order WHERE id = ?', [$id]);
        DB::select('CALL SP_HIS2LIS_UPDATE_TO_HEADER_COUNTDETAIL_LIS_IN_HIS_1(?,0)', [$kodeheader]);

        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $back = [
            'kode' => 200,
            'message' => 'order dibatalkan !'
        ];
        echo json_encode($back);
        die;
    }
    public function returorderrad(Request $request)
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $cek = $request->all();

        $kode_header = $this->createReturHeader('RETDP');
        $header = mt_kode_header::create([
            'kode_header' => $kode_header,
            'tgl_header' => date('Y-m-d')
        ]);
        $data_layanan_header = [
            'kode_kunjungan' => $request->kodekunjungan,
            'kode_retur_header' => $kode_header,
            'kode_layanan_header' => $request->kodeheader,
            'tgl_retur' => $now,
            'total_retur' => $request->qty,
            'alasan_retur' => 1,
            'status_retur' => 1,
            'pic' => auth()->user()->id,
        ];
        $head = ts_retur_header::create($data_layanan_header);
        // $get = DB::connection('mysql2')->select("CALL GET_NOMOR_LAYANAN_HEADER_RETUR('3003')");
        $cekidret = DB::connection('mysql2')->select('Select ID from TS_RETUR_HEADER 
        WHERE kode_kunjungan = ? 
	AND kode_retur_header =  ? 
	AND kode_layanan_header =  ?', [$head['kode_kunjungan'], $head['kode_retur_header'], $head['kode_layanan_header']]);

        $id_detail = $this->createReturdetail();
        $sisaqty = $request->qty - 1;
        $total_retur = $request->gt * $sisaqty;
        $savedetail = [
            'kode_retur_detail' => $id_detail,
            'tgl_retur_detail' => $now,
            'kode_retur_header' => $head['kode_retur_header'],
            'id_layanan_detail' => $request->iddet,
            'qty_Awal' => $request->qty,
            'qty_retur' => 1,
            'qty_sisa' => $sisaqty,
            'tarif_layanan' => $request->gt,
            'total_retur_detail' => $total_retur, //tarif layanan * qty sisa
            'status_retur_detail' => 'CLS',
            'row_id_header' => $request->idhed

        ];
        $ts_retur_detail = ts_retur_detail::create($savedetail);
        $statuslayanan = 'CCL';
        $updatedet = DB::connection('mysql2')->select('UPDATE ts_layanan_detail SET status_layanan_detail = "CCL", tagihan_pribadi = 0,tagihan_penjamin = 0 WHERE id = ?', array($request->iddet));

        $hitung = DB::connection('mysql2')->select('SELECT IFNULL (SUM(tagihan_pribadi),0) AS TAGPRI,IFNULL(SUM(tagihan_penjamin),0) AS TAGPEN FROM ts_layanan_detail WHERE row_id_header = ? AND status_layanan_detail = ?', [$request->idhed, 'OPN']);
        $tagpri = $hitung[0]->TAGPRI;
        $tagpen = $hitung[0]->TAGPEN;
        $updatehed = DB::connection('mysql2')->select('UPDATE ts_layanan_header	SET tagihan_pribadi = ? ,tagihan_penjamin = ?	WHERE ID = ?', [$tagpri, $tagpen, $request->idhed]);
        $back = [
            'kode' => 200,
            'message' => 'Retur Berhasil'
        ];
        echo json_encode($back);
        die;
    }
    public function returorder(Request $request)
    {
        $id = $request->idheader;
        $kodeheader = $request->kodeheader;
        $data = [
            'status' => 8,
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_detail_order WHERE id = ?', [$request->iddetail]);
        DB::select('CALL SP_HIS2LIS_UPDATE_TO_HEADER_COUNTDETAIL_LIS_IN_HIS_1(?,0)', [$kodeheader]);
        $back = [
            'kode' => 200,
            'message' => 'order diretur !'
        ];
        echo json_encode($back);
        die;
    }
    public function simpanorderdetail(Request $request)
    {
        $data = [
            'status_pembayaran' => 'OPN',
        ];
        ts_layanan_header::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);

        ts_layanan_header::whereRaw('id = ?', array($request->idetail))->update($data);
        $back = [
            'kode' => 200,
            'message' => 'order diretur !'
        ];
        echo json_encode($back);
        die;
    }
    public function createReturHeader($unit)
    {
        $q = DB::connection('mysql2')->select('SELECT id,kode_header,RIGHT(kode_header,6) AS kd_max  FROM mt_kode_order_header 
        WHERE DATE(tgl_header) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $unit . date('ymd') . $kd;
    }
    public function createOrderHeader($unit)
    {
        $q = DB::connection('mysql2')->select('SELECT id,kode_header,RIGHT(kode_header,6) AS kd_max  FROM mt_kode_order_header 
        WHERE DATE(tgl_header) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return $unit . date('ymd') . $kd;
    }
    public function createReturdetail()
    {
        $q = DB::connection('mysql2')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail 
        WHERE DATE(tgl_layanan_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'RETDET' . date('ymd') . $kd;
    }
    public function createLayanandetail()
    {
        $q = DB::connection('mysql2')->select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail 
        WHERE DATE(tgl_layanan_detail) = CURDATE()
        ORDER BY id DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%06s", $tmp);
            }
        } else {
            $kd = "000001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'DET' . date('ymd') . $kd;
    }
    public function cetakpdf($kode_header, $idhed)
    {
        $unit = auth()->user()->unit;

        date_default_timezone_set('Asia/Jakarta');
        try {
            $now = Carbon::now();
            $PDO = DB::connection('mysql2')->getPdo();
            $nota = $PDO->prepare("CALL SP_NOTA_TINDAKAN_NEW('$kode_header','$idhed')");
            $nota->execute();

            $data = $nota->fetchAll();
            $filename = __DIR__ . '/report1.jrxml';
            $config = ['driver' => 'array', 'data' => $data];
            $report =  new PHPJasperXML();
            $report->load_xml_file($filename)->setDataSource($config)->export('pdf');
        } catch (\Exception $e) {
            return $e->getMessage();
            $back = [
                'kode' => 200,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
    }
}
