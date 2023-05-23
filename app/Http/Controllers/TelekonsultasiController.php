<?php

namespace App\Http\Controllers;

use App\Models\data_kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use App\Models\ts_layanan_detail_order;
use App\Models\ts_layanan_header_order;
use Carbon\Carbon;
use App\Models\mt_kode_header;
use App\Models\mt_pasien;

class TelekonsultasiController extends Controller
{
    public $baseUrl = "http://192.168.2.30/simrs/api/penunjang/";
    public $baseRis = "http://192.168.2.30/simrs/api/ris/";
    public function registrasi()
    {
        $unit = DB::select('SELECT * FROM mt_unit WHERE kelas_unit = 1');
        $desa = DB::select('SELECT * FROM mt_lokasi_villages');
        $kecamatan = DB::select('SELECT * FROM mt_lokasi_districts');
        $kk = DB::select('SELECT * FROM mt_lokasi_regencies');
        $provinsi  = DB::select('SELECT * FROM mt_lokasi_provinces');

        return view('telekonsultasi.registrasi', [
            'title' => 'Telekonsultasi | RSUDWALED',
            'unit' => $unit,
            'desa' => $desa,
            'kecamatan' => $kecamatan,
            'kk' => $kk,
            'provinsi' => $provinsi
        ]);
    }
    public function index()
    {

        $pasien = DB::connection('mysql3')->select('SELECT  *
        FROM master_pasien, data_kunjungan
        WHERE master_pasien.id = data_kunjungan.idx ;');
        return view('telekonsultasi.index', [
            'title' => 'Telekonsultasi | RSUDWALED',
            'pasien' => $pasien
        ]);
    }
    public function caripasienlama(Request $request)
    {
        $nik = $request->nik;
        $pasien = DB::select('SELECT * FROM mt_pasien WHERE  nik_bpjs = ?', [$nik]);
        $dokter = Http::get($this->baseRis . 'dokter_get');

        if ($dokter->status() == 200) {
            // foreach ($layanan->json() as  $value) {
            //     dd($value['Tindakan']);# code...
            // }
            $dokter = json_decode($dokter)->data;
            return view('telekonsultasi.datapasien', [
                'title' => 'Telekonsultasi | RSUDWALED',
                'pasien' => $pasien,
                'dokter' => $dokter,
            ]);
        }
    }
    public function cariobat(Request $request)
    {
        $namaobat = $request->obatnama;
        $layanan = DB::select("CALL sp_cari_obat_stok_all_erm ('$namaobat','4002')");
        return view('telekonsultasi.detailobat', [
            'title' => 'Telekonsultasi | RSUDWALED',
            'layanan' => $layanan
        ]);
    }
    public function pasienteledetail(Request $request)
    {
        $id = $request->id;
        $idx = $request->idx;
        $pasiendetail = DB::connection('mysql3')->select('SELECT  *
        FROM master_pasien, data_kunjungan
        WHERE master_pasien.id = ? AND data_kunjungan.idx =? ;', [$id, $idx]);
        $dokter = Http::get($this->baseRis . 'dokter_get');

        if ($dokter->status() == 200) {

            $dokter = json_decode($dokter)->data;
            return view('telekonsultasi.tele', [
                'title' => 'SIRAMAH | TELEKONSULTASI',
                'pasiendetail' => $pasiendetail,
                'dokter' => $dokter
            ]);
        }
    }
    public function simpantelemedicine(Request $request)
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
            if ($index == 'keterangan') {
                $arrayindex[] = $dataSet;
            }
        }

        $kode_header = $this->createOrderHeader('OTM');
        $header = mt_kode_header::create([
            'kode_header' => $kode_header,
            'tgl_header' => date('Y-m-d')
        ]);
        $data_layanan_header = [
            'kode_layanan_header' => $kode_header,
            'tgl_entry' => $now,
            'tgl_periksa' => $now,
            'kode_kunjungan' => 0,
            'nama_px_luar' => $request->nama,
            'alamat_px_luar' => $request->alamat,
            'diagnosa' => $request->diagnosa,
            'status_layanan' => 1,
            'kode_unit' => 4008,
            'kode_tipe_transaksi' => 2,
            'unit_pengirim' => 8001,
            'keterangan' => 'telemedicine',
            'status_order' => 1,
            'kode_penjaminx' => 'P01',
            'pic' => auth()->user()->id,
        ];
        $head = ts_layanan_header_order::create($data_layanan_header);
        foreach ($arrayindex as $arr) {
            $id_detail = $this->createLayanandetail();
            $savedetail = [
                'id_layanan_detail' => $id_detail,
                'kode_layanan_header' => $kode_header,
                'kode_barang' => $arr['kode'],
                'aturan_pakai' => $arr['aturan'] | $arr['signa'],
                'jumlah_layanan' => $arr['jumlah'],
                'status_layanan_detail' => 'OPN',
                'tgl_layanan_detail' => $now,
                'tgl_layanan_detail_2' => $now,
                'row_id_header' => $head['id']
            ];
            $ts_layanan_detail = ts_layanan_detail_order::create($savedetail);
        }
        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;
    }
    public function simpanpasienbaru(Request $request)
    {

        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'bukti') {
                $arrayindex[] = $dataSet;
            }
        }
        $kode_header = $this->createidregister();
        $header = data_kunjungan::create([
            'id_registrasi' => $kode_header,
            'tgl_registrasi' => date('Y-m-d'),
            'keluhan' => $dataSet['keluhan']
        ]);
        $data =  [
            'nama' => $dataSet['nama'],
            'nik' => $dataSet['nik'],
            'tgl_lahir' => $dataSet['tgl_lahir'],
            'desa' => $dataSet['desa'],
            'kecamatan' => $dataSet['kecamatan'],
            'kab_kota' => $dataSet['kab_kota'],
            'propinsi' => $dataSet['propinsi'],
            'alergi' => $dataSet['alergi'],
            'jk' => $dataSet['jk'],
            'agama' => $dataSet['agama'],
            'no_hp' => $dataSet['nohp'],
            'alamat' => $dataSet['alamat'],
            'poli_tuju' => $dataSet['poli_tuju'],
            'status' => 2,
            'create_date' => $now,
            'update_date' => $now

        ];
        $mt_pasien = mt_pasien::create($data);
        $back = [
            'kode' => 200,
            'message' => ''
        ];
        echo json_encode($back);
        die;

        $idregis = $kode_header;
        dd($idregis);
        $nik = $data['nik'];

        $noregis = DB::connection('mysql3')->select('SELECT  id_registrasi, nama,keluhan, poli_tuju
        FROM master_pasien
        INNER JOIN data_kunjungan
        WHERE  data_kunjungan.id_registrasi = ? AND master_pasien.nik = ? ;', [$idregis, $nik]);

        return view('telekonsultasi.hasilregis', [
            'noregis' => $noregis
        ]);
    }
    public function createOrderHeader($unit)
    {
        $q = DB::select('SELECT id,kode_header,RIGHT(kode_header,6) AS kd_max  FROM mt_kode_order_header 
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
    public function createLayanandetail()
    {
        $q = DB::select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail 
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
    public function createidregister()
    {
        $q = DB::connection('mysql3')->select('SELECT idx,id_registrasi,RIGHT(id_registrasi,3) AS kd_max  FROM data_kunjungan 
        WHERE DATE(tgl_registrasi) = CURDATE()
        ORDER BY idx DESC
        LIMIT 1');
        $kd = "";
        if (count($q) > 0) {
            foreach ($q as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return 'RTM' . date('y') . $kd;
    }
}
