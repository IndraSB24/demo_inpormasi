<?php

namespace App\Controllers;
use CodeIgniter\CLI\Console;
use App\Models\Model_project;
use App\Models\Model_doc_engineering;
use App\Models\Model_timeline_doc;
use App\Models\Model_engineering_doc_comment;
use App\Models\Model_engineering_doc_file;
use App\Models\Model_data_helper;
use App\Models\Model_week;
use App\Models\Model_karyawan_doc_role;
use setasign\Fpdi\Fpdi;

class Project_detail_engineering extends BaseController
{
    protected $doc_engineering_model, $project_model, $timeline_doc_model, $Model_engineering_doc_comment,
        $Model_engineering_doc_file, $Model_data_helper, $Model_week, $Model_karyawan_doc_role;
 
    function __construct(){
        $this->doc_engineering_model = new Model_doc_engineering();
        $this->project_model = new Model_project();
        $this->timeline_doc_model = new Model_timeline_doc();
        $this->Model_engineering_doc_comment = new Model_engineering_doc_comment();
        $this->Model_engineering_doc_file = new Model_engineering_doc_file();
        $this->Model_data_helper = new Model_data_helper();
        $this->Model_week = new Model_week();
        $this->Model_karyawan_doc_role = new Model_karyawan_doc_role();
        helper(['session_helper', 'upload_path_helper', 'wa_helper']);
    }
    
	public function index($project_id=null, $week=null){
        // start of man hour chart data =========================================================
        $get_man_hour = $this->doc_engineering_model->getManHourByDiciplinePerMonth();
        $data_man_hour = [];

        // construct structure
        $all_disciplines = [];

        foreach ($get_man_hour as $row) {
            $discipline = $row->dicipline_name; // Access object property
            if (!in_array($discipline, $all_disciplines)) {
                $all_disciplines[] = $discipline;
            }
        }

        foreach ($get_man_hour as $row) {
            $yearMonth = $row->asbuild_plan_year . '-' . $row->asbuild_plan_month; // Access object properties
            $discipline = $row->dicipline_name; // Access object property

            // Initialize the structure if it doesn't exist for the current year-month combination
            if (!isset($data_man_hour['year_month'][$yearMonth])) {
                $data_man_hour['year_month'][$yearMonth] = [
                    'plan' => [
                        'man_hour_plan' => 0,
                        'man_hour_per_discipline' => []
                    ],
                    'actual' => [
                        'man_hour_actual' => 0,
                        'man_hour_per_discipline' => []
                    ]
                ];
                
                // Set zero value for all disciplines
                foreach ($all_disciplines as $discipline) {
                    $data_man_hour['year_month'][$yearMonth]['plan']['man_hour_per_discipline'][$discipline] = 0;
                    $data_man_hour['year_month'][$yearMonth]['actual']['man_hour_per_discipline'][$discipline] = 0;
                }
            }

            // Update the total man hour plan and actual for all disciplines
            $data_man_hour['year_month'][$yearMonth]['plan']['man_hour_plan'] += $row->man_hour_plan; // Access object property
            $data_man_hour['year_month'][$yearMonth]['actual']['man_hour_actual'] += $row->man_hour_actual; // Access object property

            // Update the man hour plan and actual for the specific discipline
            $data_man_hour['year_month'][$yearMonth]['plan']['man_hour_per_discipline'][$discipline] += $row->man_hour_plan; // Access object property
            $data_man_hour['year_month'][$yearMonth]['actual']['man_hour_per_discipline'][$discipline] += $row->man_hour_actual; // Access object property
        }

        unset($data_man_hour['year_month']['-']);
        // end of man hour chart data ============================================================
        
        // echo '<pre>'; print_r( $data_man_hour['year_month'] );die; echo '</pre>';

        // start of scurve data count ============================================================
        $getScurveDataPlan = $this->doc_engineering_model->getScurveDataPlan();
        $getScurveDataActual = $this->doc_engineering_model->getScurveDataActual();

        // count plan cum
        $getScurveDataPlanCum = [];
        $plan_cum_counted = 0;
        foreach ($getScurveDataPlan as $key => $value) {
            $plan_cum_counted += $value->cum_plan_wf;
            $getScurveDataPlanCum[$key] = $plan_cum_counted;
        }

        // count act cum
        $getScurveDataActualCum = [];
        $actual_cum_counted = 0;
        foreach ($getScurveDataActual as $key => $value) {
            $actual_cum_counted += $value->cum_actual_wf;
            $getScurveDataActualCum[$key] = $actual_cum_counted;
        }
        // end of scurve data ===================================================================

        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Engineering Document']),
			'page_title' => view('partials/page-title', ['title' => 'Project Document', 'pagetitle' => 'MDR', 'subtitle' => 'Project Name']),
			'list_doc_engineering' => $this->doc_engineering_model->get_all(sess('active_karyawan_id')),
            'data_weight_factor' => $this->doc_engineering_model->get_weight_factor(),
            'data_weight_factor_plan' => $this->doc_engineering_model->get_plan_weight_factor(),
            'data_date_range' => $this->doc_engineering_model->get_plan_range(),
            'total_doc' => $this->doc_engineering_model->count_all_doc(),
            'data_chart_man_hour' => (array) $data_man_hour['year_month'],
            'selected_week' => $week,
            'subtitle' => 'Judul Project',
            'dataWeek' => $this->Model_week->findAll(),
            'scurveData' => [
                'dataPlan' => $getScurveDataPlan,
                'dataActual' => $getScurveDataActual,
                'dataPlanCum' => $getScurveDataPlanCum,
                'dataActualCum' => $getScurveDataActualCum
            ],
            'progressChartData' => [
                'percent_plan' => $this->doc_engineering_model->getCumDataPlanPerToday(),
                'percent_actual' => $this->doc_engineering_model->getCumDataActualPerToday()
            ],
            // 'progressChartData' => [
			// 	'percent_plan' => [(object) ['cum_progress_plan' => 67.8910]],
			// 	'percent_actual' => [(object) ['cum_progress_actual' => 12.345]]
			// ],
            'docProgress' => [
                'ifa_plan' => $this->doc_engineering_model->getCumPlanDocumentPerTodayByStep( 1, 'ifa' ),
                'ifa_actual' => $this->doc_engineering_model->getCumActualDocumentPerTodayByStep( 1, 'ifa' ),
                'ifc_plan' => $this->doc_engineering_model->getCumPlanDocumentPerTodayByStep( 1, 'ifc' ),
                'ifc_actual' => $this->doc_engineering_model->getCumActualDocumentPerTodayByStep( 1, 'ifc' ),
                'asbuild_plan' => $this->doc_engineering_model->getCumPlanDocumentPerTodayByStep( 1, 'asbuild' ),
                'asbuild_actual' => $this->doc_engineering_model->getCumActualDocumentPerTodayByStep( 1, 'asbuild' )
            ],
            'manHourPerWeek' => $this->doc_engineering_model->getManHourByDiciplinePerWeek(1),
            'progressByDicipline' => $this->doc_engineering_model->getProgressByDicipline()
        ];

		return view('engineering-document', $data);
	}
	
	public function show_doc_list($project_id=null){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Engineering Document List']),
			'page_title' => view('partials/page-title', ['title' => 'Engineering', 'pagetitle' => 'Document List']),
			'list_doc_engineering' => $this->doc_engineering_model->get_all(sess('active_karyawan_id')),
            'data_weight' => $this->Model_data_helper->get_by_type('engineering_doc_weight'),
            'list_doc_dicipline' => $this->Model_data_helper->get_by_type('doc_dicipline_engineering'),
            'doc_role' => $this->Model_karyawan_doc_role->get_by_id_karyawan(sess('active_user_id'))
		];
        // echo '<pre>'; print_r( $data );die; echo '</pre>';
		return view('document_engineering_detail', $data);
		// return view('document_engineering_detail_external', $data);
		// return view('document_engineering_detail_internal', $data);
	}
	
	public function show_project_list(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Project List']),
			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Project List'])
		];
		return view('project-list', $data);
	}
	
	public function show_document_list(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Document List']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Document List'])
		];
		return view('document-list', $data);
	}
	
	public function show_over_prog_month_detail(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Progress by Month']),
			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Progress by Month'])
		];
		return view('project-dashboard-overal-prog-month', $data);
	}

    public function show_pdf($doc_id, $step, $isPreviw=false) {
		$data = [   
			'title_meta' => view('partials/title-meta', ['title' => 'Comment PDF']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Comment PDF']),
            'doc_id' => $doc_id,
            'file_name' => 'test.pdf',
            'doc_data' => $this->doc_engineering_model->get_by_id($doc_id),
            'step' => $step,
            'is_preview' => $isPreviw,
		];
        // print_r($data['doc_data']);die;
		return view('test_view', $data);
    }

    public function show_pdf_reupload($doc_id) {
		$data = [   
			'title_meta' => view('partials/title-meta', ['title' => 'Comment PDF']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Comment PDF']),
            'doc_id' => $doc_id,
            'file_name' => 'test.pdf',
            'doc_data' => $this->doc_engineering_model->get_by_id($doc_id),
		];
        // echo '<pre>'; print_r( $data );die; echo '</pre>';
		return view('reupload_doc_view', $data);
    }

    public function signDoc() {
        // read input
        $pdfFilename = $this->request->getPost('filename');
        $signatureImage = $this->request->getFile('signatureFile');

        // store signed page
        $storeSignedPage = $signatureImage->move('upload/signed_page');

        // get pdf and signed page
        $pdfPath = 'upload/engineering_doc/list/'. $pdfFilename;
        $imagePath = 'upload/signed_page/'. $signatureImage->getName();

        // Menggunakan realpath untuk memastikan path benar
        $realPdfPath = realpath($pdfPath);
        $realImagePath = realpath($imagePath);
 
         // Debugging: cetak path yang dihasilkan
         echo "PDF Path: " . ($realPdfPath ?: $pdfPath) . "\n";
         echo "Image Path: " . ($realImagePath ?: $imagePath) . "\n";
 
         // Periksa apakah file PDF ada
         if (!$realPdfPath || !file_exists($realPdfPath)) {
             return $this->response->setJSON([
                 'status' => 'error',
                 'message' => 'File PDF tidak ditemukan di path: ' . ($realPdfPath ?: $pdfPath)
             ]);
         }
 
         // Periksa apakah file gambar ada
         if (!$realImagePath || !file_exists($realImagePath)) {
             return $this->response->setJSON([
                 'status' => 'error',
                 'message' => 'File gambar tidak ditemukan di path: ' . ($realImagePath ?: $imagePath)
             ]);
         }
 
         try {
            $pdf = new Fpdi();
            $pageCount = $pdf->setSourceFile($realPdfPath);
            list($imageWidth, $imageHeight) = getimagesize($realImagePath);
            $tmp = $pdf->importPage(1);
            $size = $pdf->getTemplateSize($tmp);
            $pdfWidth = $size['width'];
            $pdfHeight = $size['height'];
            $orientation = $pdfWidth > $pdfHeight ? 'L' : 'P';
            $pdf->AddPage($orientation, [$pdfWidth, $pdfHeight]);
            $imageScale = min($pdfWidth / $imageWidth, $pdfHeight / $imageHeight);
            echo '<pre>'; print_r( "Image Scale: $imageScale\n" ); echo '</pre>';
            echo '<pre>'; print_r( "Image Width: $imageWidth, Image Height: $imageHeight\n" ); echo '</pre>';
            echo '<pre>'; print_r( "PDF Width: $pdfWidth, PDF Height: $pdfHeight\n" ); echo '</pre>';
            $x = ($pdfWidth - ($imageWidth * $imageScale)) / 2;
            $y = ($pdfHeight - ($imageHeight * $imageScale)) / 2;
            // echo '<pre>'; print_r( "X: $x, Y: $y\n" );die; echo '</pre>';
            $pdf->Image($realImagePath, $x, $y, $imageWidth * $imageScale, $imageHeight * $imageScale);
            // $pdf->Image($realImagePath, $x, $y, $imageWidth * $imageScale, $imageHeight * $imageScale, '', '', '', false);

            for ($i = 2; $i <= $pageCount; $i++) {
                $templateId = $pdf->importPage($i);
                $pdf->AddPage($orientation, [$pdfWidth, $pdfHeight]);
                $pdf->useTemplate($templateId);
            }
 
             $newPdfPath = 'upload/engineering_doc/list/'. $pdfFilename;
             $pdf->Output($newPdfPath, 'F');

            unlink($imagePath);
 
             return json_encode([
                'success' => true,
                'message' => 'successfully.'
            ]);
         } catch (\Exception $e) {
             return $this->response->setJSON([
                 'status' => 'error',
                 'message' => 'Terjadi kesalahan: ' . $e->getMessage()
             ]);
         }
    }
	
	public function show_doc_timeline($doc_id){
	    $all_timeline_data = $this->timeline_doc_model
	        ->where('doc_id', $doc_id)
            ->where('code', 'engineering')
	        ->findALl();
	   // $all_timeline_data = $this->timeline_doc_model->findAll();
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Document Timeline']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Timeline Document']),
			'timeline_data' => array_reverse($all_timeline_data)
		];
		return view('timeline-document', $data);
	}
	
    // Show ==============================================================================================================
	public function show(request $param){
        switch($param->kode){
            case 'document_timeline':
                $title = $param;
                $data = [
        			'title_meta' => view('partials/title-meta', ['title' => $param->title.' Timeline']),
        			'page_title' => view('partials/page-title', ['title' => 'Timeline', 'pagetitle' => $param->title]),
        			'passed_data' => $this->doc_engineering_model->find()
        		];
        		return view('timeline-document', $data);
            break;
            case 'actual_ifr_file':
                $data = [
                    'actual_ifr_file'   => $this->request->getPost('file'),
                    'actual_ifr'        => date_now(),
                ];
                // $this->doc_engineering_model->update($id_update, $data);
            break;
            case 'actual_ifa_file':
                $data = [
                    'actual_ifa_file'   => $this->request->getPost('file'),
                    'actual_ifa'        => date_now(),
                ];
                // $this->doc_engineering_model->update($id_update, $data);
            break;
            case 'actual_ifc_file':
                $data = [
                    'actual_ifc_file'   => $this->request->getPost('file'),
                    'actual_ifc'        => date_now(),
                ];
                // $this->doc_engineering_model->update($id_update, $data);
            break;
        }
    }

	public function add($kode=null){
	    switch($kode){
	        case 'doc_engineering':
	            $data = [
            		'level_code'    => $this->request->getPost('level_code'), 
            		'description'   => $this->request->getPost('description'),
            		'weight_factor' => $this->request->getPost('weight_factor'),
            		'plan_ifa'      => date_db_format($this->request->getPost('plan_ifa')),
            		'plan_ifc'      => date_db_format($this->request->getPost('plan_ifc')),
            		'external_asbuild_plan'      => date_db_format($this->request->getPost('external_asbuild_plan')),
                    'man_hour_plan' => $this->request->getPost('man_hour_plan'),
                    'id_doc_dicipline' => $this->request->getPost('discipline')
            	];
            	$this->doc_engineering_model->reset_increment();
            	$this->doc_engineering_model->save($data);
                $response = [
                    'success' => false,
                    'message' => 'No file specified.'
                ];
    
            return json_encode($response);
	        break;
	    }
    }
    
    public function delete($id_project){
        $this->doc_engineering_model->delete($id_project); 
    }

    // edit document =============================================================
    public function edit_document(){
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'level_code', 'description', 'weight_factor', 'man_hour_plan', 'id_doc_dicipline'
            ])
        );
        $data['id'] = $this->request->getPost('id_edit');
        $data['created_by'] = sess('active_user_id');

        $plan_ifa = $this->request->getPost('plan_ifa');
        $data['plan_ifa'] = $plan_ifa ? date('Y-m-d H:i:s', strtotime($plan_ifa)) : null;

        $plan_ifc = $this->request->getPost('plan_ifc');
        $data['plan_ifc'] = $plan_ifc ? date('Y-m-d H:i:s', strtotime($plan_ifc)) : null;

        $plan_asbuild = $this->request->getPost('external_asbuild_plan');
        $data['external_asbuild_plan'] = $plan_asbuild ? date('Y-m-d H:i:s', strtotime($plan_asbuild)) : null;
        // echo '<pre>'; print_r( $data );die; echo '</pre>';
        $updateData = $this->doc_engineering_model->save($data);
        
        if ($updateData) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return json_encode($response);
    }

    // upload originator
    public function up_originator(){
        // read the file
        $uploaded_file = $this->request->getFile('file');
                
        // store the file
        if($uploaded_file){
            $store_file = $uploaded_file->move('upload/engineering_doc/list');
            
            $id_doc = $this->request->getPost('id_doc');
            $version= $this->request->getPost('version');
            $doc_name= $this->request->getPost('doc_name');
            $doc_code= $this->request->getPost('doc_code');
            $man_hour_actual= $this->request->getPost('man_hour_actual');
            $ifa_version = $this->request->getPost('ifa_version');
            $ifc_version = $this->request->getPost('ifc_version');

            $input_date = $this->request->getPost('backdate');
            if (!empty($input_date) && strtotime($input_date) !== false) {
                $input_date = date('Y-m-d H:i:s', strtotime($input_date));
            } else {
                $input_date = date('Y-m-d H:i:s');
            }

            // safe file to engineering doc file
            $data = [
                'id_doc' => $id_doc,
                'filename' => $uploaded_file->getName(),
                'version' => $version,
                'created_by' => sess('active_user_id')
            ];
            $returned_id = $this->Model_engineering_doc_file->insertWithReturnId($data);
            
            // save file name to database
            $data = [
                'id' => $id_doc,
                'file' => $uploaded_file->getName(),
                'internal_originator_status' => 'uploaded',
                'internal_originator_date' => $input_date,
                'id_engineering_doc_file' => $returned_id,
                'file_status' => 'originator_upload',
                'internal_engineering_status' => 'progress',
                'internal_engineering_date' => '',
                'internal_ho_status' => '',
                'internal_ho_date' => null,
                'internal_pem_status' => '',
                'internal_pem_date' => null,
                'actual_ifr' => null,
                'actual_ifr_status' => '',
                'actual_ifa' => null,
                'actual_ifa_status' => '',
                'actual_ifc' => null,
                'actual_ifc_status' => '',
                'man_hour_actual' => $man_hour_actual,
                'ifa_version' => $ifa_version,
                'ifc_version' => $ifc_version
            ];
            $update_doc = $this->doc_engineering_model->save($data);
            
            $data_timeline = [
                'doc_id'                => $id_doc,
                'detail_type'           => 'internal_engineering',
                'time'                  => $input_date,
                'timeline_title'        => 'internal originator file upload',
                'timeline_description'  => 'new file upload',
                'timeline_status'       => 'on time',
                'new_file'              => $data['file'],
                'file_status'           => 'internal',
                'created_by'            => sess('active_user_id'),
                'id_file'               => $returned_id
            ];
            $this->timeline_doc_model->save($data_timeline);

            $nope_sandhi = "6287888276877";
            $nope_indra = "6285274897212";
            $data_wa = [
                'penerima' => $nope_sandhi,
                'doc_name' => $doc_name,
                'doc_code' => $doc_code,
                'tgl_upload' => $input_date,
                'link_to_open' => "https://sasinfinity.com/inpormasi/public/commentPdf/".$id_doc."/internal"
            ];
            originatorToInternalEngineering($data_wa);

            // return and notif wa
            if ($store_file && $returned_id && $update_doc){
                $response = [
                    'success' => true,
                    'message' => 'File Uploaded successfully.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to Upload File.'
                ];
            }
   
        }else {
            $response = [
                'success' => false,
                'message' => 'No file specified.'
            ];
        }

        return json_encode($response);
    }

    // approve internal engineerin
    public function approve_internal_engineering(){
        $id_doc = $this->request->getPost('id_doc');
        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'internal_engineering_approve',
            'internal_engineering_status' => 'approve',
            'internal_engineering_date' => $input_date,
            'internal_ho_status' => 'progress',
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'internal_engineering',
            'time'                  => $input_date,
            'timeline_title'        => 'internal engineering review file approve',
            'timeline_description'  => 'no desc',
            'timeline_status'       => 'on time',
            'new_file'              => '',
            'file_status'           => 'internal',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File approved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to approve File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // reject internal engineerin
    public function reject_internal_engineering(){
        $id_doc = $this->request->getPost('id_doc');
        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'reject',
            'internal_originator_status' => 'progress',
            'internal_engineering_status' => 'reject',
            'internal_engineering_date' => $input_date
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'internal_engineering',
            'time'                  => $input_date,
            'timeline_title'        => 'internal review file reject',
            'timeline_description'  => 'no desc',
            'timeline_status'       => 'on time',
            'new_file'              => '',
            'file_status'           => 'internal',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File approved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to approve File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // approve internal ho
    public function approve_internal_ho(){
        $id_doc = $this->request->getPost('id_doc');
        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'internal_ho_approve',
            'internal_ho_status' => 'approve',
            'internal_ho_date' => $input_date,
            'internal_pem_status' => 'progress',
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'internal_ho',
            'time'                  => $input_date,
            'timeline_title'        => 'internal HO endorse the document',
            'timeline_description'  => 'no desc',
            'timeline_status'       => 'on time',
            'new_file'              => '',
            'file_status'           => 'internal',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File approved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to approve File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // reject internal ho
    public function reject_internal_ho(){
        $id_doc = $this->request->getPost('id_doc');
        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // udpate status
        $data = [
            'id' => $id_doc,
            'file_status' => 'reject',
            'internal_originator_status' => 'progress',
            'internal_ho_status' => 'reject',
            'internal_ho_date' => $input_date
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'internal_ho',
            'time'                  => $input_date,
            'timeline_title'        => 'internal HO file reject',
            'timeline_description'  => 'no desc',
            'timeline_status'       => 'on time',
            'new_file'              => '',
            'file_status'           => 'internal',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File rejected successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to reject File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // approve internal pem with automation up IFR
    public function approve_internal_pem(){
        $id_doc = $this->request->getPost('id_doc');
        $version= $this->request->getPost('version');
        $plan_date = $this->request->getPost('plan_ifa');

        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }

        if($version != null || $version != ""){
            $version = autoVersioning($version, 'issued');
        }else{
            $version = "0A";
        }
        
        // udpate status
        $data = [
            'id' => $id_doc,
            'file_version' => $version,
            'file_status' => 'internal_pem_approve',
            'internal_pem_status' => 'approve',
            'internal_pem_date' => $input_date,
            'actual_ifr' => $input_date,
            'actual_ifr_status' => 'uploaded',
            'actual_ifa_status' => 'progress'
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // timeline for internal pem approve
        $data_timeline_pem = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'internal_pem',
            'time'                  => $input_date,
            'timeline_title'        => 'internal PEM approve the document',
            'timeline_description'  => 'no desc',
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'internal',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline_pem);

        // timeline for external IFR issued
        $data_timeline_ifr = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'external',
            'time'                  => $input_date,
            'timeline_title'        => 'document issued for review (IFR)',
            'timeline_description'  => 'document version '.$version,
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'external_ifr',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline_ifr);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File approved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to approve File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // reject internal pem
    public function reject_internal_pem(){
        $id_doc = $this->request->getPost('id_doc');
        
        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'reject',
            'internal_originator_status' => 'progress',
            'internal_pem_status' => 'reject',
            'internal_pem_date' => $input_date
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'internal_ho',
            'time'                  => $input_date,
            'timeline_title'        => 'internal PEM file reject',
            'timeline_description'  => 'no desc',
            'timeline_status'       => 'on time',
            'new_file'              => '',
            'file_status'           => 'internal',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File rejected successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to reject File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // approve external ifa
    public function approve_external_ifa(){
        $id_doc = $this->request->getPost('id_doc');
        $plan_date = $this->request->getPost('plan_ifa');
        
        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'external_ifa_approve',
            'actual_ifa' => $input_date,
            'actual_ifa_status' => 'approve',
            'actual_ifc_status' => 'progress'
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // timeline for internal pem approve
        $data_timeline_pem = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'external_ifa',
            'time'                  => $input_date,
            'timeline_title'        => 'document approved in IFA step',
            'timeline_description'  => 'no desc',
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'external',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline_pem);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File approved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to approve File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // reject external ifa
    public function reject_external_ifa(){
        $id_doc = $this->request->getPost('id_doc');
        $plan_date = $this->request->getPost('plan_ifa');

        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'ifa_reject',
            'internal_originator_status' => 'progress',
            'actual_ifr' => null,
            'actual_ifr_status' => null,
            'actual_ifa' => $input_date,
            'actual_ifa_status' => 'reject'
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'external',
            'time'                  => $input_date,
            'timeline_title'        => 'document rejected in IFA step',
            'timeline_description'  => 'no desc',
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'external_ifa_reject',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File rejected successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to reject File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // approve external ifc
    public function approve_external_ifc(){
        $id_doc = $this->request->getPost('id_doc');
        $plan_date = $this->request->getPost('plan_ifc');

        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'ifc_approve',
            'actual_ifc' => $input_date,
            'actual_ifc_status' => 'approve',
            'external_asbuild_status' => 'progress'
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // timeline for internal pem approve
        $data_timeline_pem = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'external',
            'time'                  => $input_date,
            'timeline_title'        => 'document approved in IFC step',
            'timeline_description'  => 'no desc',
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'external_ifc_approve',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline_pem);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File approved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to approve File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // reject external ifc
    public function reject_external_ifc(){
        $id_doc = $this->request->getPost('id_doc');
        $plan_date = $this->request->getPost('plan_ifc');

        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'ifc_reject',
            'internal_originator_status' => 'progress',
            'actual_ifr' => null,
            'actual_ifr_status' => null,
            'actual_ifc' => $input_date,
            'actual_ifc_status' => 'reject'
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'external',
            'time'                  => $input_date,
            'timeline_title'        => 'document rejected in IFC step',
            'timeline_description'  => 'no desc',
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'external_ifc_reject',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File rejected successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to reject File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // approve external asbuild
    public function approve_external_asbuild(){
        $id_doc = $this->request->getPost('id_doc');
        $plan_date = $this->request->getPost('external_asbuild_plan');
        $version = $this->request->getPost('version');

        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // udpate status
        $data = [
            'id' => $id_doc,
            'file_version' => autoVersioning($version, 'approve'),
            'file_status' => 'asbuild_approve',
            'external_asbuild_actual' => $input_date,
            'external_asbuild_status' => 'approve'
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // timeline for internal pem approve
        $data_timeline_pem = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'external',
            'time'                  => $input_date,
            'timeline_title'        => 'document approved in Asbuild step',
            'timeline_description'  => 'no desc',
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'external_asbuild_approve',
            'created_by'            => sess('active_user_id'),
            'id_file'               => $this->request->getPost('id_file')
        ];
        $this->timeline_doc_model->save($data_timeline_pem);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File approved successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to approve File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // reject external asbuild
    public function reject_external_asbuild(){
        $id_doc = $this->request->getPost('id_doc');
        $plan_date = $this->request->getPost('external_asbuild_plan');

        $input_date = $this->request->getPost('backdate');
        if (!empty($input_date) && strtotime($input_date) !== false) {
            $input_date = date('Y-m-d H:i:s', strtotime($input_date));
        } else {
            $input_date = date('Y-m-d H:i:s');
        }
        
        // update status
        $data = [
            'id' => $id_doc,
            'file_status' => 'external_asbuild_reject',
            'internal_originator_status' => 'progress',
            'actual_ifr' => null,
            'actual_ifr_status' => null,
            'external_asbuild_actual' => $input_date,
            'external_asbuild_status' => 'reject'
        ];
        $update_doc = $this->doc_engineering_model->save($data);

        // add timeline
        $data_timeline = [
            'doc_id'                => $id_doc,
            'detail_type'           => 'external',
            'time'                  => $input_date,
            'timeline_title'        => 'document rejected in Asbuild step',
            'timeline_description'  => 'no desc',
            'timeline_status'       => $this->timeStatusCheck($plan_date),
            'new_file'              => '',
            'file_status'           => 'external_asbuild_reject',
            'created_by'            => sess('active_user_id')
        ];
        $this->timeline_doc_model->save($data_timeline);

        if ($update_doc) {
            $response = [
                'success' => true,
                'message' => 'File rejected successfully.'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Failed to reject File.'
            ];
        }

        return $this->response->setJSON($response);
    }

    // add comment
    public function add_comment(){
        $uploaded_file = $this->request->getFile('image');
        // store the file
        if($uploaded_file){
            $uploaded_file->move('upload/engineering_doc/comment');
            
            // save file name to database
            $data_add = [
                'doc_id' => $this->request->getPost('id_doc'),
                'id_engineering_doc_file' => $this->request->getPost('id_file'),
                'comment_title' => $this->request->getPost('comment_title'),
                'comment_file' => $uploaded_file->getName(),
                'page_detail' => $this->request->getPost('page_detail'),
                'created_by' => sess('active_user_id'),
                'doc_step' => $this->request->getPost('doc_step')
            ];
            $save_file = $this->Model_engineering_doc_comment->save($data_add);

            if ($save_file) {
                $response = [
                    'success' => true,
                    'message' => 'Comment added successfully.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to add comment.'
                ];
            }
        }
        else {
            $response = [
                'success' => false,
                'message' => 'No file specified.'
            ];
        }

        return json_encode($response);
    }

    // delete comment
    public function delete_comment(){  
        $id_comment = $this->request->getPost('id_comment');

        $deleteResult = $this->Model_engineering_doc_comment->delete($id_comment);

        // Check the result of the delete operation
        $response = [
            'success' => $deleteResult, // Indicates whether the deletion was successful or not
            'message' => $deleteResult ? 'Record deleted successfully.' : 'Failed to delete record.'
        ];
        
        // Set the appropriate content type header
        header('Content-Type: application/json');
        
        // Return JSON response
        return json_encode($response);
    }

    // list comment
    public function ajax_get_comment($id_doc, $id_approver=null){
        // $id_doc = $this->request->getPost('id_doc');
        // $id_approver = $this->request->getPost('id_approver') ?: null;
    
        $payload = [
            'id_doc' => $id_doc,
            'id_approver' => $id_approver
        ];
        $fetched_data = $this->Model_engineering_doc_comment->get_by_idDoc_idApprover($payload);
        // Check if comments are fetched successfully
        if ($fetched_data) {
            // Return the fetched comments in JSON format
            return json_encode($fetched_data);
        } else {
            $response = [
                'success' => false,
                'message' => 'No Data.'
            ];
            
            return $this->response->setJSON($response);
        }
    }
    
    // time status checker
    function timeStatusCheck($plan_date) {
        $current_datetime = date('Y-m-d H:i:s');
    
        $status = $plan_date > $current_datetime ? "late" : "on time";
    
        return $status;
    }

    // get chart data for scurve
    public function get_scurve_data($id_project){
        // get week data
        $data_week = $this->Model_week->getWeeksByProject($id_project);
        $data_wf = $this->Model_data_helper->get_by_type('engineering_doc_weight');
        $data_doc_engineering = $this->doc_engineering_model->findAll();


    }

}
