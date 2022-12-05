<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\assesmenawal;
use App\Models\assesmenawal_dokter;
use App\Models\ts_layanan_header;
use App\Models\ts_layanan_detail;
use App\Models\mt_kode_header;
use App\Models\erm_order_header;
use App\Models\erm_order_detail;
use App\Models\gambartht;
use App\Models\assemenawalmedis;

class ErmController extends Controller
{
    public function indexPerawat()
    {
        return view('perawat.index', [
            'title' => 'Semerusmart | E-RM',
        ]);
    }
    public function indexDokter()
    {
        return view('dokter.index', [
            'title' => 'Semerusmart | E-RM',
        ]);
    }
    public function ambildatapasien()
    {
        $tipe = auth()->user()->hak_akses;
        $date = date('Y-m-d');
        // $date = '2022-11-25';
        if ($tipe == 2) {
            //perawat
            $unit = auth()->user()->unit;
            $pasien_poli = DB::select('select a.kode_kunjungan,fc_nama_px(a.no_rm) as nama,a.no_rm,fc_umur(a.no_rm) as umur, fc_alamat4(a.no_rm) as alamat , fc_nama_unit1(a.kode_unit) as unit,a.tgl_masuk, a.kelas, a.counter, b.kode_kunjungan as kj
            ,fc_nama_unit1(a.ref_unit) as asalunit,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = a.no_rm ) AS data_erm from ts_kunjungan a left outer join erm_hasil_assesmen_keperawatan_rajal b on b.kode_kunjungan = a.kode_kunjungan where a.kode_unit = ? and a.status_kunjungan = ? and date(a.tgl_masuk) = ?', [$unit, 1, $date]);
            return view('perawat.datapasien', [
                'pasien' => $pasien_poli
            ]);
        } else {
            //dokter
            $unit = auth()->user()->unit;
            $pasien_poli = DB::select('select a.kode_kunjungan,fc_nama_px(a.no_rm) as nama,a.no_rm,fc_umur(a.no_rm) as umur, fc_alamat4(a.no_rm) as alamat , fc_nama_unit1(a.kode_unit) as unit,a.tgl_masuk, a.kelas, a.counter, b.kode_kunjungan as kj
            ,fc_nama_unit1(a.ref_unit) as asalunit,(SELECT COUNT(id) FROM erm_hasil_assesmen_keperawatan_rajal WHERE no_rm = a.no_rm ) AS data_erm from ts_kunjungan a left outer join erm_hasil_assesmen_keperawatan_rajal b on b.kode_kunjungan = a.kode_kunjungan where a.kode_unit = ? and a.status_kunjungan = ? and date(a.tgl_masuk) = ?', [$unit, 1, $date]);
            return view('dokter.datapasien', [
                'pasien' => $pasien_poli
            ]);
        }
    }
    public function indexErmPerawat($kodekunjungan)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        return view('perawat.index_erm', [
            'title' => $datapasien[0]->nama_px . ' | ' . $datapasien[0]->no_rm,
            'pasien' => $datapasien,
            'datakunjungan' => $datakunjungan,
        ]);
    }
    public function indexErmDokter($kodekunjungan)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        return view('perawat.index_erm', [
            'title' => $datapasien[0]->nama_px . ' | ' . $datapasien[0]->no_rm,
            'pasien' => $datapasien,
            'datakunjungan' => $datakunjungan,
        ]);
    }
    public function detailpasien(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        $counter = $datakunjungan[0]->counter - 1;
        $lastrajal = DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit FROM ts_kunjungan WHERE no_rm = ? AND SUBSTR(kode_unit,1,1) = ? AND counter = ? ORDER BY counter DESC LIMIT 1
        ', [$rm, 1, $counter]);
        if (count($lastrajal) > 0) {
            $detail = DB::select('SELECT DISTINCT a.id,fc_nama_unit1(a.kode_unit) as nama_unit,d.`NAMA_TARIF` as nama_tarif FROM ts_layanan_header a  
        LEFT OUTER JOIN ts_layanan_detail b ON a.id = b.row_id_header
        LEFT OUTER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL`
        LEFT OUTER JOIN mt_tarif_header d ON  c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?', [$lastrajal[0]->kode_kunjungan]);
            $hasilperiksa_perawat = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$lastrajal[0]->kode_kunjungan]);
        } else {
            $detail = 0;
            $hasilperiksa_perawat = 0;
        }
        return view('perawat.detailpasien', [
            'title' => $datapasien[0]->nama_px . ' | ' . $datapasien[0]->no_rm,
            'pasien' => $datapasien,
            'datakunjungan' => $datakunjungan,
            'last_rajal' => $lastrajal,
            'last_rajal_detail' => $detail,
            'last_rajal_asskep' => $hasilperiksa_perawat,
            'last_ranap' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit FROM ts_kunjungan WHERE no_rm = ? AND SUBSTR(kode_unit,1,1) = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, 2])
        ]);
    }
    public function formperawat(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ?', [$rm]);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] - 1;
        }
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $hasil = count($cek_hasil_periksa);
        if ($hasil > 0) {
            return view('perawat.formperawat_edit', [
                'pasien' => $datapasien,
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'hasil' => $cek_hasil_periksa,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, $counter])
            ]);
        } else {
            return view('perawat.formperawat', [
                'pasien' => $datapasien,
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, $counter])
            ]);
        }
    }
    public function formdokter(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        $cek_rm = DB::select('select * from ts_kunjungan where no_rm = ?', [$rm]);
        if (count($cek_rm) == 0) {
            $counter = 1;
        } else {
            foreach ($cek_rm as $c)
                $arr_counter[] = array(
                    'counter' => $c->counter
                );
            $last_count = max($arr_counter);
            $counter = $last_count['counter'] - 1;
        }
        $asskep = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $hasil = count($cek_hasil_periksa);
        if ($hasil > 0) {
            return view('dokter.formdokter_edit', [
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'hasil' => $cek_hasil_periksa,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1
            ', [$rm, $counter])
            ]);
        } else {
            return view('dokter.formdokter', [
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'last_counter' => DB::select('SELECT *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin,fc_nama_unit1(kode_unit) AS nama_unit,fc_NAMA_PARAMEDIS1(kode_paramedis) AS dokter FROM ts_kunjungan WHERE no_rm = ? AND counter = ? ORDER BY counter DESC LIMIT 1', [$rm, $counter])
            ]);
        }
    }
    public function simpanformperawat(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        $data = [
            'counter' => $dataSet['counter'],
            'no_rm' => $dataSet['nomorrm'],
            'kode_unit' => $dataSet['unit'],
            'kode_kunjungan' => $dataSet['kodekunjungan'],
            'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
            'tanggalperiksa' => $dataSet['tanggalperiksa'], //sementara
            'sumberdataperiksa' => $dataSet['sumberdataperiksa'],
            'keluhanutama' => $dataSet['keluhanutama'],
            'tekanandarah' => $dataSet['tekanandarah'],
            'frekuensinadi' => $dataSet['frekuensinadi'],
            'frekuensinapas' => $dataSet['frekuensinapas'],
            'suhutubuh' => $dataSet['suhutubuh'],
            'Riwayatpsikologi' => $dataSet['Riwayatpsikologi'],
            'penggunaanalatbantu' => $dataSet['penggunaanalatbantu'],
            'cacattubuh' => $dataSet['cacattubuh'],
            'keterangancacattubuh' => $dataSet['keterangancacattubuh'],
            'Keluhannyeri' => $dataSet['Keluhannyeri'],
            'skalenyeripasien' => $dataSet['skalenyeripasien'],
            'resikojatuh' => $dataSet['resikojatuh'],
            'Skrininggizi' => $dataSet['Skrininggizi'],
            'skorskrininggizi' => $dataSet['skorskrininggizi'],
            'beratskrininggizi' => $dataSet['beratskrininggizi'],
            'status_asupanmkanan' => $dataSet['status_asupanmkanan'],
            'skorasupanmkanan' => $dataSet['skorasupanmkanan'],
            'totalskorgizi' => $dataSet['totalskorgizi'],
            'penyakitlainpasien' => $dataSet['penyakitlainpasien'],
            'diagnosakhusus' => $dataSet['diagnosakhusus'],
            'resikomalnutrisi' => $dataSet['resikomalnutrisi'],
            'tglpengkajianlanjutgizi' => $dataSet['tanggalkunjungan'], //sementara
            'diagnosakeperawatan' => $dataSet['diagnosakeperawatan'],
            'rencanakeperawatan' => $dataSet['rencanakeperawatan'],
            'tindakankeperawatan' => $dataSet['tindakankeperawatan'],
            'evaluasikeperawatan' => $dataSet['evaluasikeperawatan'],
            'namapemeriksa' => auth()->user()->name,
            'idpemeriksa' => auth()->user()->id,
            'status' => 2,
            'signature' => ''
        ];
        try {
            $cek = DB::select('SELECT * from erm_hasil_assesmen_keperawatan_rajal WHERE tanggalkunjungan = ? AND no_rm = ? AND kode_unit = ?', [$dataSet['tanggalkunjungan'], $dataSet['nomorrm'], $dataSet['unit']]);
            if (count($cek) > 0) {
                $data = [
                    'counter' => $dataSet['counter'],
                    'no_rm' => $dataSet['nomorrm'],
                    'kode_unit' => $dataSet['unit'],
                    'kode_kunjungan' => $dataSet['kodekunjungan'],
                    'tanggalkunjungan' => $dataSet['tanggalkunjungan'],
                    'tanggalperiksa' => $dataSet['tanggalperiksa'], //sementara
                    'sumberdataperiksa' => $dataSet['sumberdataperiksa'],
                    'keluhanutama' => $dataSet['keluhanutama'],
                    'tekanandarah' => $dataSet['tekanandarah'],
                    'frekuensinadi' => $dataSet['frekuensinadi'],
                    'frekuensinapas' => $dataSet['frekuensinapas'],
                    'suhutubuh' => $dataSet['suhutubuh'],
                    'Riwayatpsikologi' => $dataSet['Riwayatpsikologi'],
                    'penggunaanalatbantu' => $dataSet['penggunaanalatbantu'],
                    'cacattubuh' => $dataSet['cacattubuh'],
                    'keterangancacattubuh' => $dataSet['keterangancacattubuh'],
                    'Keluhannyeri' => $dataSet['Keluhannyeri'],
                    'skalenyeripasien' => $dataSet['skalenyeripasien'],
                    'resikojatuh' => $dataSet['resikojatuh'],
                    'Skrininggizi' => $dataSet['Skrininggizi'],
                    'skorskrininggizi' => $dataSet['skorskrininggizi'],
                    'beratskrininggizi' => $dataSet['beratskrininggizi'],
                    'status_asupanmkanan' => $dataSet['status_asupanmkanan'],
                    'skorasupanmkanan' => $dataSet['skorasupanmkanan'],
                    'totalskorgizi' => $dataSet['totalskorgizi'],
                    'penyakitlainpasien' => $dataSet['penyakitlainpasien'],
                    'diagnosakhusus' => $dataSet['diagnosakhusus'],
                    'resikomalnutrisi' => $dataSet['resikomalnutrisi'],
                    'tglpengkajianlanjutgizi' => $dataSet['tanggalkunjungan'], //sementara
                    'diagnosakeperawatan' => $dataSet['diagnosakeperawatan'],
                    'rencanakeperawatan' => $dataSet['rencanakeperawatan'],
                    'tindakankeperawatan' => $dataSet['tindakankeperawatan'],
                    'evaluasikeperawatan' => $dataSet['evaluasikeperawatan'],
                    'namapemeriksa' => auth()->user()->name,
                    'idpemeriksa' => auth()->user()->id,
                    'status' => 2,
                    'signature' => ''
                ];
                assesmenawal::whereRaw('no_rm = ? and kode_unit = ? and tanggalkunjungan = ?', array($dataSet['nomorrm'],  $dataSet['unit'], $dataSet['tanggalkunjungan']))->update($data);
            } else {
                $erm_assesmen = assesmenawal::create($data);
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function simpanpemeriksaandokter(Request $request)
    {
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index =  $nama['name'];
            $value =  $nama['value'];
            $dataSet[$index] = $value;
        }
        // tgljamkunjungan
        if (empty($dataSet['hipertensi'])) {
            $hipertensi = (NULL);
        } else {
            $hipertensi = $dataSet['hipertensi'];
        };

        if (empty($dataSet['kencingmanis'])) {
            $kencingmanis = (NULL);
        } else {
            $kencingmanis = $dataSet['kencingmanis'];
        };

        if (empty($dataSet['jantung'])) {
            $jantung = (NULL);
        } else {
            $jantung = $dataSet['jantung'];
        };

        if (empty($dataSet['stroke'])) {
            $stroke = (NULL);
        } else {
            $stroke = $dataSet['stroke'];
        };

        if (empty($dataSet['hepatitis'])) {
            $hepatitis = (NULL);
        } else {
            $hepatitis = $dataSet['hepatitis'];
        };

        if (empty($dataSet['asthma'])) {
            $asthma = (NULL);
        } else {
            $asthma = $dataSet['asthma'];
        };

        if (empty($dataSet['ginjal'])) {
            $ginjal = (NULL);
        } else {
            $ginjal = $dataSet['ginjal'];
        };

        if (empty($dataSet['tb'])) {
            $tb = (NULL);
        } else {
            $tb = $dataSet['tb'];
        };

        if (empty($dataSet['riwayatlain'])) {
            $riwayatlain = (NULL);
        } else {
            $riwayatlain = $dataSet['riwayatlain'];
        };

        $data = [
            'id_asskep' => $request->idasskep,
            'kode_unit' => auth()->user()->unit,
            'kode_kunjungan' => $request->kodekunjungan,
            'no_rm' => $request->rm,
            'tanggal_periksa' => $dataSet['tgljampemeriksaan'],
            'keluhan_utama' => $dataSet['keluhanutama'],
            'riwayat_penyakit' => $dataSet['riwayatpenyakitsekarang'],
            'hipertensi' => $hipertensi,
            'kencingmanis' => $kencingmanis,
            'jantung' => $jantung,
            'stroke' => $stroke,
            'hepatitis' => $hepatitis,
            'asthma' => $asthma,
            'ginjal' => $ginjal,
            'tbparu' => $tb,
            'riwayatlain' => $riwayatlain,
            'keadaanumum' => $dataSet['keadaanumum'],
            'kesadaran' => $dataSet['kesadaran'],
            'diagnosakerja' => $dataSet['diagnosakerja'],
            'rencanakerja' => $dataSet['rencanakerja'],
            'signature' => '',
            'status' => 2
        ];
        try {
            $cek = DB::select('SELECT * from erm_hasil_assesmen_dokter_rajal WHERE kode_kunjungan = ? AND no_rm = ? AND kode_unit = ?', [$request->kodekunjungan, $request->rm, auth()->user()->unit]);
            if (count($cek) > 0) {
                $data = [
                    'id_asskep' => $request->idasskep,
                    'kode_unit' => auth()->user()->unit,
                    'kode_kunjungan' => $request->kodekunjungan,
                    'no_rm' => $request->rm,
                    'tanggal_periksa' => $dataSet['tgljampemeriksaan'],
                    'keluhan_utama' => $dataSet['keluhanutama'],
                    'riwayat_penyakit' => $dataSet['riwayatpenyakitsekarang'],
                    'hipertensi' => $hipertensi,
                    'kencingmanis' => $kencingmanis,
                    'jantung' => $jantung,
                    'stroke' => $stroke,
                    'hepatitis' => $hepatitis,
                    'asthma' => $asthma,
                    'ginjal' => $ginjal,
                    'tbparu' => $tb,
                    'riwayatlain' => $riwayatlain,
                    'keadaanumum' => $dataSet['keadaanumum'],
                    'kesadaran' => $dataSet['kesadaran'],
                    'diagnosakerja' => $dataSet['diagnosakerja'],
                    'rencanakerja' => $dataSet['rencanakerja'],
                    'signature' => '',
                    'status' => 2
                ];
                assesmenawal_dokter::whereRaw('no_rm = ? and kode_unit = ? and kode_kunjungan = ?', array($request->rm,  auth()->user()->unit, $request->kodekunjungan))->update($data);
            } else {
                $erm_assesmen = assesmenawal_dokter::create($data);
            }
            $data = [
                'kode' => 200,
                'message' => 'Data berhasil disimpan !'
            ];
            echo json_encode($data);
            die;
        } catch (\Exception $e) {
            $data = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
            die;
        }
    }
    public function detaillast_kj(Request $request)
    {
        $id = $request->id;
        $detail = DB::select('SELECT DISTINCT a.id,fc_nama_unit1(a.kode_unit) as nama_unit,d.`NAMA_TARIF` as nama_tarif FROM ts_layanan_header a LEFT OUTER JOIN ts_layanan_detail b ON a.id = b.row_id_header LEFT OUTER JOIN mt_tarif_detail c ON b.kode_tarif_detail = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON  c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?', [$id]);
        $hasilperiksa_perawat = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$id]);
        return view('perawat.detailkunjungan_akhir', [
            'last_rajal_detail' => $detail,
            'last_rajal_asskep' => $hasilperiksa_perawat
        ]);
    }
    public function formcppt(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where no_rm = ?', [$request->nomorrm]);
        $rm = $request->nomorrm;
        $datapasien = DB::select('select *,nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat from mt_pasien where no_rm = ?', [$rm]);
        return view('erm.cppt', [
            'datakunjungan' => $datakunjungan,
            'pasien' => $datapasien,
            'cppt' => DB::select('SELECT *,a.signature as signature_perawat,b.signature as signature_dokter,fc_nama_unit1(a.kode_unit) as namaunit FROM `erm_hasil_assesmen_keperawatan_rajal` a
            LEFT OUTER JOIN `erm_hasil_assesmen_dokter_rajal` b ON a.`no_rm` = b.`no_rm`
            WHERE  a.no_rm = ?', [$rm])
            // 'orderpenunjang' =>  DB::select("SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
            // 'tindakan' => DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
            // RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            // RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            // RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            // RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            // WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan])
        ]);
    }
    public function Hasilpemeriksaanpenunjang(Request $request)
    {
        $rm = $request->nomorrm;
        echo 'Penunjang ' . $rm;
    }
    public function riwayatpengobatan(Request $request)
    {
        echo 'ok';
    }
    public function penandaangambar(Request $request)

    {
        return view('erm.gambar', [
            'kodekunjungan' => $request->kodekunjungan,
        ]);
    }
    public function terapitindakan(Request $request)
    {
        $unit = auth()->user()->unit;
        $layanan = $request->layanan;
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $kelas = $datakunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);

        $riwayat_tindakan_tdy = DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
        LEFT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        LEFT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        LEFT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        LEFT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('erm.order', [
            'tindakan' => $layanan,
            'riwayat' => $riwayat_tindakan_tdy,
            'cek_asmed' => count($cek_hasil_periksa)
        ]);
    }
    public function tindakanhariini(Request $request)
    {
        $riwayat_tindakan_tdy = DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
        RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
        RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
        RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
        RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
        WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('erm.riwayattindakan_tdy', [
            'riwayat' => $riwayat_tindakan_tdy
        ]);
    }
    public function orderhariini(Request $request)
    {
        $riwayat_tindakan_tdy = DB::select("
        SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]);
        return view('erm.order_tdy', [
            'riwayat' => $riwayat_tindakan_tdy
        ]);
    }
    public function ambillayanan(Request $request)
    {
        $unit = $request->kode;
        $layanan = $request->layanan;
        $datakunjungan = DB::select('select *,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $kelas = $datakunjungan[0]->kelas;
        $layanan = $this->carilayanan($kelas, $layanan, $unit);
        return view('erm.layananpenunjang', [
            'tindakan' => $layanan,
        ]);
    }
    public function orderpenunjang(Request $request)
    {
        $unit = DB::select('select * from mt_unit where SUBSTR(kode_unit,1,1) = ? AND kelas_unit = ?', ['3', '3']);
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);

        // $layanan = $this->carilayanan($kelas,$layanan,$unit);
        return view('erm.orderpenunjang', [
            'unit' => $unit,
            'cek_asmed' => count($cek_hasil_periksa)
        ]);
    }
    public function tindaklanjut(Request $request)
    {
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        return view('erm.tindaklanjut', [
            'cek_assmed' => $cek_hasil_periksa
        ]);
    }
    public function detail_asskep(Request $request)
    {
        $cek_hasil_periksa = DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]);
        $hasil = count($cek_hasil_periksa);
        if ($hasil > 0) {
            return view('perawat.detail_asskep', [
                'hasil' => $cek_hasil_periksa
            ]);
        } else {
            echo "<h4 class='text-danger'> Perawat Belum mengisi ...</h4>";
        }
    }
    public function carilayanan($kelas, $nama, $unit)
    {
        $layanan = DB::select("CALL SP_PANGGIL_TARIF_TINDAKAN_RS('$kelas','$nama','$unit')");
        return $layanan;
    }
    public function simpanlayanan(Request $request)
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;

        $cek_layanan_header = count(DB::connection('mysql2')->SELECT('select id from ts_layanan_header where kode_kunjungan = ?', [$request->kodekunjungan]));
        if ($cek_layanan_header > 0) {
            $back = [
                'kode' => 500,
                'message' => 'Layanan sudah diinput, silahkan cek riwayat tindakan !'
            ];
            echo json_encode($back);
            die;
        }
        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('SELECT * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $penjamin = $kunjungan[0]->kode_penjamin;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$kunjungan[0]->kode_unit]);
        $prefix_kunjungan = $unit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }
        try {
            $kode_unit = $kunjungan[0]->kode_unit;
            $r = DB::select("CALL GET_NOMOR_LAYANAN_HEADER('$kode_unit')");
            $kode_layanan_header = $r[0]->no_trx_layanan;
            if ($kode_layanan_header == "") {
                $year = date('y');
                $kode_layanan_header = $unit[0]['prefix_unit'] . $year . date('m') . date('d') . '000001';
                DB::select('insert into mt_nomor_trx (tgl,no_trx_layanan,unit) values (?,?,?)', [date('Y-m-d h:i:s'), $kode_layanan_header, $kunjungan[0]->kode_unit]);
            }
            $data_layanan_header = [
                'kode_layanan_header' => $kode_layanan_header,
                'tgl_entry' =>   $now,
                'kode_kunjungan' => $kunjungan[0]->kode_kunjungan,
                'kode_unit' => $kunjungan['0']->kode_unit,
                'kode_tipe_transaksi' => 2,
                'pic' => auth()->user()->id,
                'status_layanan' => '3',
                'status_retur' => 'OPN',
                'status_pembayaran' => 'OPN'
            ];
            //data yg diinsert ke ts_layanan_header
            //simpan ke layanan header
            $ts_layanan_header = ts_layanan_header::create($data_layanan_header);
            $grand_total_tarif = 0;
            foreach ($arrayindex as $d) {
                if ($penjamin == 'P01') {
                    $tagihanpenjamin = 0;
                    $tagihanpribadi = $d['tarif'] * $d['qty'];
                } else {
                    $tagihanpenjamin = $d['tarif'] * $d['qty'];
                    $tagihanpribadi = 0;
                }
                $id_detail = $this->createLayanandetail();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $kode_layanan_header,
                    'kode_tarif_detail' => $d['kodelayanan'],
                    'total_tarif' => $d['tarif'],
                    'jumlah_layanan' => $d['qty'],
                    'diskon_layanan' => $d['disc'],
                    'total_layanan' => $d['tarif'] * $d['qty'],
                    'grantotal_layanan' => $d['tarif'] * $d['qty'],
                    'status_layanan_detail' => 'OPN',
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $tagihanpenjamin,
                    'tagihan_pribadi' => $tagihanpribadi,
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $ts_layanan_header->id
                ];
                $ts_layanan_detail = ts_layanan_detail::create($save_detail);
                $grand_total_tarif = $grand_total_tarif + $d['tarif'];
            }
            if ($penjamin == 'P01') {
                ts_layanan_header::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_pribadi' => $grand_total_tarif]);
            } else {
                ts_layanan_header::where('id', $ts_layanan_header->id)
                    ->update(['status_layanan' => 1, 'total_layanan' => $grand_total_tarif, 'tagihan_penjamin' => $grand_total_tarif]);
            }
            $data = [
                'status' => 2,
                'signature' => ''

            ];
            assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
    }
    public function simpanorder(Request $request)
    {
        $dt = Carbon::now()->timezone('Asia/Jakarta');
        $date = $dt->toDateString();
        $time = $dt->toTimeString();
        $now = $date . ' ' . $time;

        $kodekunjungan = $request->kodekunjungan;
        $kunjungan = DB::select('SELECT * from ts_kunjungan where kode_kunjungan = ?', [$kodekunjungan]);
        $penjamin = $kunjungan[0]->kode_penjamin;
        $unit = DB::select('select * from mt_unit where kode_unit = ?', [$request->kodepenunjang]);
        $prefix_kunjungan = $unit[0]->prefix_unit;
        $data = json_decode($_POST['data'], true);
        foreach ($data as $nama) {
            $index = $nama['name'];
            $value = $nama['value'];
            $dataSet[$index] = $value;
            if ($index == 'cyto') {
                $arrayindex[] = $dataSet;
            }
        }
        try {
            $id_header = $this->createOrderHeader($prefix_kunjungan);
            $save_header = [
                'kode_header' => $id_header,
                'tgl_header' => date('Y-m-d')
            ];
            $header = mt_kode_header::create($save_header);
            $data_layanan_header = [
                'kode_layanan_header' => $id_header,
                'tgl_entry' => $now,
                'kode_kunjungan' => $kodekunjungan,
                'status_layanan' => 3,
                'kode_unit' => $request->kodepenunjang,
                'kode_tipe_transaksi' => 2,
                'kode_penjaminx' => $penjamin,
                'dok_kirim' => auth()->user()->kode_dpjp,
                'unit_pengirim' => auth()->user()->unit,
                'pic' => auth()->user()->kode_dpjp,
            ];
            $hed = erm_order_header::create($data_layanan_header);
            foreach ($arrayindex as $arr) {
                $id_detail = $this->createLayanandetail();
                $save_detail = [
                    'id_layanan_detail' => $id_detail,
                    'kode_layanan_header' => $id_header,
                    'kode_tarif_detail' => $arr['kodelayanan'],
                    'total_tarif' => $arr['tarif'],
                    'jumlah_layanan' => $arr['qty'],
                    'diskon_dokter' => $arr['disc'],
                    'cyto' => $arr['cyto'],
                    'total_layanan' => $arr['tarif'] * $arr['qty'],
                    'grantotal_layanan' => $arr['tarif'] * $arr['qty'],
                    'status_layanan_detail' => 'OPN',
                    'kode_dokter1' => $request->dokterpemeriksa,
                    'tgl_layanan_detail' => $now,
                    'tagihan_penjamin' => $arr['tarif'] * $arr['qty'],
                    'tgl_layanan_detail_2' => $now,
                    'row_id_header' => $hed['id']
                ];
                erm_order_detail::create($save_detail);
            }
            $data = [
                'status' => 2,
                'signature' => ''
            ];
            assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
            $back = [
                'kode' => 200,
                'message' => ''
            ];
            echo json_encode($back);
            die;
        } catch (\Exception $e) {
            $back = [
                'kode' => 500,
                'message' => $e->getMessage()
            ];
            echo json_encode($back);
            die;
        }
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
        $q = DB::select('SELECT id,id_layanan_detail,RIGHT(id_layanan_detail,6) AS kd_max  FROM ts_layanan_detail_order 
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
    public function batalorder(Request $request)
    {
        $id = $request->idheader;
        DB::select('DELETE FROM ts_layanan_detail_order WHERE row_id_header = ?', [$request->idheader]);
        DB::select('DELETE FROM ts_layanan_header_order WHERE id = ?', [$request->idheader]);
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
    public function returorder(Request $request)
    {
        $id = $request->idheader;
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        DB::select('DELETE FROM ts_layanan_detail_order WHERE id = ?', [$request->iddetail]);
        $back = [
            'kode' => 200,
            'message' => 'order diretur !'
        ];
        echo json_encode($back);
        die;
    }
    public function bataltindakan(Request $request)
    {
        //untuk batal semua tindakan
        $id = $request->idheader;
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_detail WHERE row_id_header = ?', [$request->idheader]);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_header WHERE id = ?', [$request->idheader]);
        $back = [
            'kode' => 200,
            'message' => 'order dibatalkan !'
        ];
        echo json_encode($back);
        die;
    }
    public function returtindakan(Request $request)
    {
        //untuk retur 1 tindakan
        $id = $request->idheader;
        $data = [
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        DB::connection('mysql2')->select('DELETE FROM ts_layanan_detail WHERE id = ?', [$request->iddetail]);
        $back = [
            'kode' => 200,
            'message' => 'order diretur !'
        ];
        echo json_encode($back);
        die;
    }
    public function formtindaklanjut(Request $request)
    {
        $id = $request->id;
        if ($id == 1) {
            return view('erm.tindaklanjut.dirujuk', []);
        } else if ($id == 2) {
            return view('erm.tindaklanjut.konsul', []);
        } else if ($id == 3) {
            return view('erm.tindaklanjut.rawatinap', []);
        } else if ($id == 4) {
            return view('erm.tindaklanjut.pulang', []);
        }
    }
    public function resumemedis(Request $request)
    {
        $datakunjungan = DB::select('select *,fc_nama_unit1(kode_unit) as nama_unit,fc_nama_penjamin2(kode_penjamin) AS nama_penjamin from ts_kunjungan where kode_kunjungan = ?', [$request->kodekunjungan]);
        $rm = $datakunjungan[0]->no_rm;
        $datapasien = DB::select('select nama_px,no_rm,tempat_lahir,date(tgl_lahir) as tgl_lahir,jenis_kelamin,fc_umur(no_rm) as umur, fc_alamat4(no_rm) as alamat  from mt_pasien where no_rm = ?', [$rm]);
        if (auth()->user()->hak_akses == 2) {
            return view('erm.resume_perawat', [
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'assmed' => DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'orderpenunjang' =>  DB::select("SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
                'tindakan' => DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
            RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan])
            ]);
        } else {
            return view('erm.resume', [
                'now' => carbon::now()->timezone('Asia/jakarta'),
                'datakunjungan' => $datakunjungan,
                'pasien' => $datapasien,
                'asskep' => DB::select('select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'assmed' => DB::select('select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?', [$request->kodekunjungan]),
                'orderpenunjang' =>  DB::select("SELECT a.id as id_header,b.id as id_detail,fc_nama_unit1(a.kode_unit) AS nama_unit_tujuan,d.`NAMA_TARIF`, b.jumlah_layanan FROM ts_layanan_header_order a LEFT OUTER JOIN ts_layanan_detail_order b ON a.`id` = b.`row_id_header` LEFT OUTER JOIN mt_tarif_detail c ON b.`kode_tarif_detail` = c.`KODE_TARIF_DETAIL` LEFT OUTER JOIN mt_tarif_header d ON c.`KODE_TARIF_HEADER` = d.`KODE_TARIF_HEADER` WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan]),
                'tindakan' => DB::connection('mysql2')->select("SELECT a.kode_kunjungan,b.id AS id_header,C.id AS id_detail,c.jumlah_layanan,b.kode_layanan_header,c.`kode_tarif_detail`,e.`NAMA_TARIF` FROM simrs_waled.ts_kunjungan a 
            RIGHT OUTER JOIN ts_layanan_header b ON a.kode_kunjungan = b.kode_kunjungan
            RIGHT OUTER JOIN ts_layanan_detail c ON b.id = c.row_id_header
            RIGHT OUTER JOIN mt_tarif_detail d ON c.kode_tarif_detail = d.`KODE_TARIF_DETAIL`
            RIGHT OUTER JOIN mt_tarif_header e ON d.`KODE_TARIF_HEADER` = e.`KODE_TARIF_HEADER`
            WHERE a.`kode_kunjungan` = ?", [$request->kodekunjungan])
            ]);
        }
    }
    public function pasienpulang(Request $request)
    {
        $data = [
            'tindaklanjut' => 'Pasien dipulangkan',
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Tindak Lanjut pasien dipulangkan ...'
        ];
        echo json_encode($data);
        die;
    }
    public function pasienranap(Request $request)
    {
        $data = [
            'tindaklanjut' => 'Pasien dirawat inap',
            'status' => 2,
            'signature' => ''
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($request->kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Tindak Lanjut pasien rawat inap ...'
        ];
        echo json_encode($data);
        die;
    }
    public function simpansignature(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $tglassesmen = $request->tglassesmen;
        $namapemeriksa = $request->namapemeriksa;
        $idpemeriksa = $request->idpemeriksa;
        $signature = $request->signature;
        $data = [
            'tanggalassesmen' => $tglassesmen,
            'namadokter' => $namapemeriksa,
            'iddokter' => $idpemeriksa,
            'signature' => $signature,
            'status' => 1
        ];
        assesmenawal_dokter::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Assemen awal medis sudah disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpangambar(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $img = $request->img;
        $id = $request->id;

        //jika poli tht
        $cek_gbr = DB::select('select id from erm_tanda_gambar_tht where kodekunjungan = ?', [$kodekunjungan]);
        if (count($cek_gbr) == 0) {
            if ($id == 'telingakanan') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakanan' => $img,
                ];
            }
            if ($id == 'telingakiri') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakiri' => $img,
                ];
            }
            if ($id == 'laring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'laring' => $img,
                ];
            }
            if ($id == 'faring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'faring' => $img,
                ];
            }
            if ($id == 'leher') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'leherkepala' => $img,
                ];
            }
            if ($id == 'maksilofasial') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'maksilofasial' => $img,
                ];
            }
            $gambartht = gambartht::create($data);
        } else {
            if ($id == 'telingakanan') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakanan' => $img,
                ];
            }
            if ($id == 'telingakiri') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'telingakiri' => $img,
                ];
            }
            if ($id == 'laring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'laring' => $img,
                ];
            }
            if ($id == 'faring') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'faring' => $img,
                ];
            }
            if ($id == 'leher') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'leherkepala' => $img,
                ];
            }
            if ($id == 'maksilofasial') {
                $data = [
                    'kodekunjungan' => $kodekunjungan,
                    'maksilofasial' => $img,
                ];
            }

            gambartht::whereRaw('kodekunjungan = ?', array($kodekunjungan))->update($data);
        }
        $data = [
            'kode' => 200,
            'message' => 'Assemen awal medis sudah disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function simpansignature_perawat(Request $request)
    {
        $kodekunjungan = $request->kodekunjungan;
        $tglassesmen = $request->tglassesmen;
        $namapemeriksa = $request->namapemeriksa;
        $idpemeriksa = $request->idpemeriksa;
        $signature = $request->signature;
        $data = [
            'tanggalassemen' => $tglassesmen,
            'namapemeriksa' => $namapemeriksa,
            'idpemeriksa' => $idpemeriksa,
            'signature' => $signature,
            'status' => 1
        ];
        assesmenawal::whereRaw('kode_kunjungan = ?', array($kodekunjungan))->update($data);
        $data = [
            'kode' => 200,
            'message' => 'Assemen awal keperawatan sudah disimpan !'
        ];
        echo json_encode($data);
        die;
    }
    public function cekresume(Request $request)
    {
        if (auth()->user()->hak_akses == 3) {
            $cek_resume = DB::select("select * from erm_hasil_assesmen_dokter_rajal where kode_kunjungan = ?", [$request->kodekunjungan]);
        } else {
            $cek_resume = DB::select("select * from erm_hasil_assesmen_keperawatan_rajal where kode_kunjungan = ?", [$request->kodekunjungan]);
        }
        if (count($cek_resume) > 0) {
            $data = [
                'kode' => 200,
                'data' => $cek_resume[0]->signature
            ];
        } else {
            $data = [
                'kode' => 500,
                'data' => 0
            ];
        }
        echo json_encode($data);
        die;
    }
    public function ambilgambar(Request $request)
    {
        $id = $request->id;
        $kodekunjungan = $request->kodekunjungan;
        if ($id == 'lar') {
            return view('erm.gambar_laring', []);
        } else if ($id == 'tkan') {
            $gbr = DB::select('select telingakanan from erm_tanda_gambar_tht where kodekunjungan = ? ',[$kodekunjungan]);
            return view('erm.gambar_telingakanan', [
                'gbr' => $gbr[0]->telingakanan,
                'count' => count($gbr)
            ]);
        } else if ($id == 'tkir') {
            $gbr = DB::select('select telingakiri from erm_tanda_gambar_tht where kodekunjungan = ? ',[$kodekunjungan]);
            return view('erm.gambar_telingakiri', [
                'gbr' => $gbr[0]->telingakiri,
                'count' => count($gbr)
            ]);
        } else if ($id == 'far') {
            return view('erm.gambar_faring', []);
        } else if ($id == 'maks') {
            return view('erm.gambar_maks', []);
        } else if ($id == 'leh') {
            return view('erm.gambar_leh', []);
        }
    }
}
