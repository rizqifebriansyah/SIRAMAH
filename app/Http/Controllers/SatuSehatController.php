<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SatuSehatModel;
use App\Models\ihs_encounter;
use App\Models\ihs_pasien;
use Illuminate\Support\Facades\DB;

class SatuSehatController extends Controller
{
    public function index()
    {
        return view('templates.main', [            
        ]);
    }
    public function cari_nik_pasien(Request $request)
    {        
        $v = new SatuSehatModel();
        $result = $v->patient_search_nik($request['term']);
        if (count($result->entry) > 0) {
            foreach ($result->entry as $row)
                $arr_result[] = array(
                    'label' => $row->resource->name[0]->text.' | '.$request['term'],
                    'kode' => $row->resource->name[0]->text,
                    'id' => $row->resource->id,
                );
            echo json_encode($arr_result);
        }
    }
    public function cari_unit(Request $request)
    {        
        $v = new SatuSehatModel();
        $result = $v->Location_by_name($request['term']);
        if (count($result->entry) > 0) {
            foreach ($result->entry as $row)
                $arr_result[] = array(
                    'label' => $row->resource->name,
                    'kode' => $row->resource->id
                );
            echo json_encode($arr_result);
        }
    }
    public function cari_dokter(Request $request)
    {        
        $result = DB::table('ihs_practioner')->where('pra_nama', 'LIKE', '%' . $request['term'] . '%')->get();
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = array(
                    'label' => $row->pra_nama,
                    'kode' => $row->pra_id,
                );
            echo json_encode($arr_result);
        }
    }
    public function simpancounter(Request $request)
    {
        $SS = new SatuSehatModel();
        $json = [
            "resourceType" => "Encounter",
            "status" => "arrived",
            "class" => [
                "system" => "http://terminology.hl7.org/CodeSystem/v3-ActCode",
                "code" => "AMB",
                "display" => "ambulatory"
            ],
            "subject" => [
                "reference" => "Patient/".$request->nikid,
                "display" => "Budi Santoso"
            ],
            "participant" => [
                [
                    "type" => [
                        [
                            "coding" => [
                                [
                                    "system" => "http://terminology.hl7.org/CodeSystem/v3-ParticipationType",
                                    "code" => "ATND",
                                    "display" => "attender"
                                ]
                            ]
                        ]
                    ],
                    "individual" => [
                        "reference" => "Practitioner/".$request->iddokter,
                        "display" => "Dokter Bronsig"
                    ]
                ]
            ],
            "period" => [
                "start" => "2022-06-14T07:00:00+07:00"
            ],
            "location" => [
                [
                    "location" => [
                        "reference" => "Location/".$request->idunit,
                        "display" => "Ruang 1A, Poliklinik Bedah Rawat Jalan Terpadu, Lantai 2, Gedung G"
                    ]
                ]
            ],
            "statusHistory" => [
                [
                    "status" => "arrived",
                    "period" => [
                        "start" => "2022-06-14T07:00:00+07:00"
                    ]
                ]
            ],
            "serviceProvider" => [
                "reference" => "Organization/10000004"
            ],
            "identifier" => [
                [
                    "system" => "http://sys-ids.kemkes.go.id/encounter/10000004",
                    "value" => "P20240001"
                ]
            ]
        ];
        try{
            $dataq = $SS->Encounter_rajal($json);
            if($dataq->resourceType == 'Encounter'){
                $now = date('Y-m-d h:i:s');
                $data_tabel = [
                    'enc_id' =>$dataq->id,
                    'enc_ihs_id' =>$request->nikid,
                    'enc_pra_id' =>$request->iddokter,
                    'enc_pra_nama' =>$request->namadokter,
                    'enc_loc_id' =>$request->idunit,
                    'enc_loc_nama' =>$request->unit,
                    'enc_arrived_time' =>$now,
                    'enc_inprogres_time' => (NULL),
                    'enc_finish_time' => (NULL),
                ];
                $datapasien = [
                    'ihs_id' =>$request->nikid,
                    'nama' => $request->nama,
                    'nik' => $request->nikid
                ];
                // ihs_pasien::create($datapasien);
                ihs_encounter::create($data_tabel);
                $data = [
                    'kode' => 200,
                    'message' => 'ok'
                ];
                echo json_encode($data);
            }else{
                $data = [
                    'kode' => 500,
                    'message' => 'error'
                ];
                echo json_encode($data);
            }
        }catch(\Exception $e){
            $data = [
                'kode' => 201,
                'message' => $e->getMessage()
            ];
            echo json_encode($data);
        }
    }
}
