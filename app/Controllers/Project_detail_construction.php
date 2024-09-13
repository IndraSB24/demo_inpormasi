<?php

namespace App\Controllers;
use App\Models\Model_project;
use App\Models\Model_doc_procurement;
use App\Models\Model_doc_engineering;
use App\Models\Model_data_helper;
use App\Models\Model_procurement_doc_file;
use App\Models\Model_timeline_doc;
use App\Models\Model_procurement_doc_comment;
use App\Models\Model_construction;
use App\Models\Model_construction_measurement_basis;
use App\Models\Model_construction_progress;
use App\Models\Model_week;

class Project_detail_construction extends BaseController
{
    protected $Model_doc_procurement, $Model_project, $Model_doc_engineering, $Model_data_helper,
		$Model_procurement_doc_file, $Model_timeline_doc, $Model_procurement_doc_comment, $Model_construction,
        $Model_construction_measurement_basis, $Model_construction_progress;
 
    function __construct(){
        $this->Model_doc_procurement = new Model_doc_procurement();
        $this->Model_project = new Model_project();
		$this->Model_doc_engineering = new Model_doc_engineering();
		$this->Model_data_helper = new Model_data_helper();
		$this->Model_procurement_doc_file = new Model_procurement_doc_file();
		$this->Model_timeline_doc = new Model_timeline_doc();
		$this->Model_procurement_doc_comment = new Model_procurement_doc_comment();
        $this->Model_construction = new Model_construction();
        $this->Model_construction_measurement_basis = new Model_construction_measurement_basis();
        $this->Model_construction_progress = new Model_construction_progress();
        $this->Model_week = new Model_week();
		helper(['session_helper', 'upload_path_helper', 'wa_helper']);
    }
    
	public function index($project_id=null){
        // currentDate
        $currentDate = date('Y-m-d');
    
        // Get the current week number and last week number
        $currentWeek = $this->Model_week->getWeekNumberByDate($currentDate);

        // start of scurve data count ============================================================
        $getScurveDataPlan = $this->Model_construction->getScurveDataPlan(1);
        $getScurveDataActual = $this->Model_construction->getScurveDataActual(1);

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

        $percent_plan_counted = 0;
        foreach ($getScurveDataPlan as $key => $value) {
            $key < $currentWeek ? $percent_plan_counted += $value->cum_plan_wf : "";   
        }

        $percent_actual_counted = 0;
        foreach ($getScurveDataActual as $key => $value) {
            $key < $currentWeek ? $percent_actual_counted += $value->cum_actual_wf : "";   
        }

		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Construction Document']),
			'page_title' => view('partials/page-title', ['title' => 'Project Document', 'pagetitle' => 'Construction']),
			'list_doc_procurement' => $this->Model_doc_engineering->findAll(),
            'progressChartData' => [
                'percent_plan' => $percent_plan_counted,
                'percent_actual' => $percent_actual_counted
            ],
            'scurveData' => [
                'dataPlan' => $getScurveDataPlan,
                'dataActual' => $getScurveDataActual,
                'dataPlanCum' => $getScurveDataPlanCum,
                'dataActualCum' => $getScurveDataActualCum
            ],
            'progressByLevel1' => $this->Model_doc_procurement->getProgressByLevel1(),
            'getProgressByLevel1ForChart' => $this->Model_doc_procurement->getProgressByLevel1ForChart()
		];
		return view('construction-document', $data);
	}
	
	public function show_doc_list($project_id=null){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Construction Document List']),
			'page_title' => view('partials/page-title', ['title' => 'Construction', 'pagetitle' => 'Document List']),
			'list_doc' => $this->Model_construction->getConstructionList(),
			'data_weight' => $this->Model_data_helper->get_by_type('procurement_doc_weight'),
            'data_list_level1' => $this->Model_construction->getListLevel1()
		];
		// echo '<pre>'; print_r( $data['data_list_level1'] );die; echo '</pre>';
		return view('document_construction_detail', $data);
	}

    // show measurement basis
    public function measurement_basis_list($project_id=null) {
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Construction Measurement Basis']),
			'page_title' => view('partials/page-title', ['title' => 'Construction', 'pagetitle' => 'Measurement Basis']),
            'list_data' => $this->Model_construction->getMeasurementBasis()
		];
       
        return view('document_construction_detail_2', $data);
    }

    // add measurement basis step
    public function addMeasurementBasis() {
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'id_construction', 'progress_step', 'progress_name', 'progress_wf'
            ])
        );
        $data['created_by'] = sess('active_user_id');
        $insertData = $this->Model_construction_measurement_basis->save($data);
                
        if ($insertData) {
            $response = [
                'success' => true,
                'message' => 'done'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'failed'
            ];
        }
        return $this->response->setJSON($response);
    }

    // add progress
    public function addProgress() {
        $isDone = false;
        $progressData = [];

        $list_step = $this->request->getPost('step');
        $list_actual_volume = $this->request->getPost('actual_volume');
        $list_actual_percent_per_construction = $this->request->getPost('actual_percent_per_construction');
        $list_evidence_filename = $this->request->getFiles('evidence_filename');

        foreach ($list_step as $index => $value) {
            $eachData = [
                'step' => $value,
                'actual_volume' => $list_actual_volume[$index],
                'actual_percent_per_construction' => $list_actual_percent_per_construction[$index],
                'evidence_filename' => $list_evidence_filename['evidence_filename'][$index]
            ];
            $progressData[] = $eachData;
        };

        if (!empty($progressData) && is_array($progressData)) {
            foreach ($progressData as $list) {
                $uploaded_file = $list['evidence_filename'];
                $evidence_filename = "";

                if($uploaded_file->getSize() != 0){
                    $store_file = $uploaded_file->move('upload/construction_doc/evidence');
                    $evidence_filename = $uploaded_file->getName();
                }

                $payload = [
                    'id_construction' => $this->request->getPost('id_construction'),
                    'step' =>  $list['step'],
                    'actual_volume' => $list['actual_volume'],
                    'actual_percent_per_construction' => $list['actual_percent_per_construction'],
                    'evidence_filename' => $evidence_filename
                ];
                $insert = $this->Model_construction_progress->save($payload);

                $isDone = $insert ? true : false;
            }
        }

        if ($isDone) {
            $response = [
                'success' => true,
                'message' => 'done'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'failed'
            ];
        }
        return json_encode($response);
    }

    // add progress
    public function addProgressSingle() {
        $isDone = false;
        $progressData = [];

        $list_step = $this->request->getPost('step');
        $list_actual_volume = $this->request->getPost('actual_volume');
        $list_actual_percent_per_construction = $this->request->getPost('actual_percent_per_construction');
        $list_evidence_filename = $this->request->getPost('evidence_filename');

        foreach ($list_step as $index => $value) {
            $eachData = [
                'step' => $value,
                'actual_volume' => $list_actual_volume[$index],
                'actual_percent_per_construction' => $list_actual_percent_per_construction[$index],
                'evidence_filename' => $list_evidence_filename[$index]
            ];
            $progressData[] = $eachData;
        };

        // $progressData = [
        //     'step' => $this->request->getPost('step'),
        //     'actual_volume' => $this->request->getPost('actual_volume'),
        //     'actual_percent_per_construction' => $this->request->getPost('actual_percent_per_construction'),
        //     'evidence_filename' => $this->request->getFile('evidence_filename')
        // ];

        if (!empty($progressData) && is_array($progressData)) {
            foreach ($progressData as $list) {
                $uploaded_file = $list['evidence_filename'];
                $evidence_filename = "";

                if($uploaded_file){
                    $store_file = $uploaded_file->move('upload/construction_doc/evidence');
                    $evidence_filename = $uploaded_file->getName();
                }

                $payload = [
                    'id_construction' => $this->request->getPost('id_construction'),
                    'step' =>  $list['step'],
                    'actual_volume' => $list['actual_volume'],
                    'actual_percent_per_construction' => $list['actual_percent_per_construction'],
                    'evidence_filename' => $evidence_filename
                ];
                $insert = $this->Model_construction_progress->save($payload);

                $isDone = $insert ? true : false;
            }
        }

        if ($isDone) {
            $response = [
                'success' => true,
                'message' => 'done'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'failed'
            ];
        }
        return json_encode($response);
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

	public function add($kode=null){
	    switch($kode){
	        case 'doc_procurement':
	            $data = [
            		'level_code'    => $this->request->getPost('level_code'), 
            		'description'   => $this->request->getPost('description'),
            		'weight_factor' => $this->request->getPost('weight_factor'),
            		'plan_ifr'      => date_db_format($this->request->getPost('plan_ifr')),
            		'plan_ifa'      => date_db_format($this->request->getPost('plan_ifa')),
            		'plan_ifc'      => date_db_format($this->request->getPost('plan_ifc'))
            	];
            	$this->doc_procurement_model->reset_increment();
            	$this->doc_procurement_model->save($data);
	        break;
	    }
    }
    
    public function delete($id_project){
        $this->doc_procurement_model->delete($id_project);
        
    }
    
    public function update($kode=null, $id_update=null){
        switch($kode){
            case 'document_detail':
                $data = [
                    'level_code'    => $this->request->getPost('level_code_edit'),
                    'description'   => $this->request->getPost('description_edit'),
                    'weight_factor' => $this->request->getPost('weight_factor_edit'),
                    'plan_ifr'      => date_db_format($this->request->getPost('plan_ifr_edit')),
                    'plan_ifa'      => date_db_format($this->request->getPost('plan_ifa_edit')),
                    'plan_ifc'      => date_db_format($this->request->getPost('plan_ifc_edit'))
                ];
                $this->doc_procurement_model->update($id_update, $data);
            break;
            case 'actual_ifr_file':
                $data = [
                    'actual_ifr_file'   => $this->request->getPost('file'),
                    'actual_ifr'        => date_now(),
                ];
                $this->doc_procurement_model->update($id_update, $data);
            break;
            case 'actual_ifa_file':
                $data = [
                    'actual_ifa_file'   => $this->request->getPost('file'),
                    'actual_ifa'        => date_now(),
                ];
                $this->doc_procurement_model->update($id_update, $data);
            break;
            case 'actual_ifc_file':
                $data = [
                    'actual_ifc_file'   => $this->request->getPost('file'),
                    'actual_ifc'        => date_now(),
                ];
                $this->doc_procurement_model->update($id_update, $data);
            break;
        }
    }
    
    public function pagination(){
        
    }

	// upload po
    public function up_po(){
        // read the file
        $uploaded_file = $this->request->getFile('file');
                
        // store the file
        if($uploaded_file){
            $store_file = $uploaded_file->move('upload/procurement_doc/list');
            
            $id_doc = $this->request->getPost('id_doc');
            $doc_name= $this->request->getPost('doc_name');
            $doc_code= $this->request->getPost('doc_code');
            $man_hour_actual= $this->request->getPost('man_hour_actual');

            $input_date = $this->request->getPost('backdate') ?: date('Y-m-d H:i:s');

            // safe file to procurement doc file
            $data = [
                'id_doc' => $id_doc,
                'filename' => $uploaded_file->getName(),
                'version' => "",
                'created_by' => sess('active_user_id')
            ];
            $returned_id = $this->Model_procurement_doc_file->insertWithReturnId($data);
            
            // save file name to database
            $data = [
                'id' => $id_doc,
                'po_filename' => $uploaded_file->getName(),
                'po_act' => $input_date,
				'po_id_file' => $returned_id,
				'po_status' => 'uploaded'
            ];
            $update_doc = $this->Model_doc_procurement->save($data);
            
            // $data_timeline = [
            //     'doc_id'                => $id_doc,
            //     'detail_type'           => 'internal_engineering',
            //     'time'                  => $input_date,
            //     'timeline_title'        => 'internal originator file upload',
            //     'timeline_description'  => 'new file upload',
            //     'timeline_status'       => 'on time',
            //     'new_file'              => $data['file'],
            //     'file_status'           => 'internal',
            //     'created_by'            => sess('active_user_id'),
            //     'id_file'               => $returned_id
            // ];
            // $this->timeline_doc_model->save($data_timeline);

			$proc_data = $this->Model_doc_procurement->get_by_id($id_doc);
			$doc_desc = $proc_data[0]->activity_name_lvl_1;
			if($proc_data[0]->activity_name_lvl_2){
				$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_2;

				if($proc_data[0]->activity_name_lvl_3){
					$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_3;

					if($proc_data[0]->activity_name_lvl_4){
						$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_4;
					}
				}
			}

            $nope_sandhi = "6287888276877";
            $nope_indra = "6285274897212";
            $data_wa = [
                'penerima' => $nope_sandhi,
                'doc_name' => $doc_desc,
                'doc_group' => $proc_data[0]->group_name,
                'tgl_upload' => $input_date,
                'link_to_open' => "https://sasinfinity.com/inpormasi/public/commentPdf/".$id_doc."/procurement/preview"
            ];
            procurementPoUp($data_wa);

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

	// upload po
    public function up_file(){
        // read the file
        $uploaded_file = $this->request->getFile('file');
		$doc_step = $this->request->getPost('doc_step');

		$filename_key = $doc_step . '_filename';
		$act_key = $doc_step . '_act';
		$id_file_key = $doc_step . '_id_file';
		$status_key = $doc_step . '_status';
                
        // store the file
        if($uploaded_file){
            $store_file = $uploaded_file->move('upload/procurement_doc/list');
            
            $id_doc = $this->request->getPost('id_doc');
            $doc_name= $this->request->getPost('doc_name');
            $doc_code= $this->request->getPost('doc_code');
            $man_hour_actual= $this->request->getPost('man_hour_actual');
            $input_date = $this->request->getPost('backdate') ?: date('Y-m-d H:i:s');

            // safe file to procurement doc file
            $data = [
                'id_doc' => $id_doc,
                'filename' => $uploaded_file->getName(),
                'version' => "",
                'created_by' => sess('active_user_id')
            ];
            $returned_id = $this->Model_procurement_doc_file->insertWithReturnId($data);

			// update doc data
			$data_update_doc = [
				'id' => $id_doc,
				$filename_key => $uploaded_file->getName(),
				$act_key => $input_date,
				$id_file_key => $returned_id,
				$status_key => 'uploaded'
			];
			$update_doc = $this->Model_doc_procurement->save($data_update_doc);
            
			// add timeliline
            $data_timeline = [
				'code'					=> 'procurement',
                'doc_id'                => $id_doc,
                'detail_type'           => 'procurement_'.$doc_step,
                'time'                  => $input_date,
                'timeline_title'        => $doc_step.'file uplopad',
                'timeline_description'  => 'new file upload',
                'timeline_status'       => 'on time',
                'new_file'              => $data['filename'],
                'file_status'           => '',
                'created_by'            => sess('active_user_id'),
                'id_file'               => $returned_id
            ];
            $this->Model_timeline_doc->save($data_timeline);

			$proc_data = $this->Model_doc_procurement->get_by_id($id_doc);
			$doc_desc = $proc_data[0]->activity_name_lvl_1;
			if($proc_data[0]->activity_name_lvl_2){
				$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_2;

				if($proc_data[0]->activity_name_lvl_3){
					$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_3;

					if($proc_data[0]->activity_name_lvl_4){
						$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_4;
					}
				}
			}

            $nope_sandhi = "6287888276877";
            $nope_indra = "6285274897212";
            $data_wa = [
                'penerima' => $nope_indra,
                'doc_name' => $doc_desc,
                'doc_group' => $proc_data[0]->group_name,
				'doc_step' => $doc_step,
                'tgl_upload' => $input_date,
                'link_to_open' => "https://sasinfinity.com/inpormasi/public/commentPdf/".$id_doc."/procurement/preview"
            ];
            procurementUpFile($data_wa);

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

	public function approve(){
		$id_doc = $this->request->getPost('id_doc');
        $man_hour_actual= $this->request->getPost('man_hour_actual');
		$doc_step = $this->request->getPost('doc_step');
		$filename = $this->request->getPost('doc_filename');
		$id_file = $this->request->getPost('id_file');


		$act_key = $doc_step . '_act';
		$status_key = $doc_step . '_status';

        $input_date = $this->request->getPost('backdate') ?: date('Y-m-d H:i:s');

		// update doc data
		$data_update_doc = [
			'id' => $id_doc,
			$act_key => $input_date,
			$status_key => 'approve'
		];
		switch ($doc_step) {
			case 'po':
				$data_update_doc['fat_status'] = 'progress';
				break;
			case 'fat':
				$data_update_doc['rfs_status'] = 'progress';
				break;
			case 'rfs':
				$data_update_doc['onsite_status'] = 'progress';
				break;
			case 'onsite':
				$data_update_doc['install_status'] = 'progress';
				break;
			case 'install':
				$data_update_doc['comm_status'] = 'progress';
				break;
		}
		$update_doc = $this->Model_doc_procurement->save($data_update_doc);
		
		// add timeliline
		$data_timeline = [
			'code'					=> 'procurement',
			'doc_id'                => $id_doc,
			'detail_type'           => 'procurement_'.$doc_step,
			'time'                  => $input_date,
			'timeline_title'        => $doc_step.'file approved',
			'timeline_description'  => $doc_step.' file has been approved',
			'timeline_status'       => 'on time',
			'new_file'              => $filename,
			'file_status'           => '',
			'created_by'            => sess('active_user_id'),
			'id_file'               => $id_file
		];
		$this->Model_timeline_doc->save($data_timeline);

		$proc_data = $this->Model_doc_procurement->get_by_id($id_doc);
		$doc_desc = $proc_data[0]->activity_name_lvl_1;
		if($proc_data[0]->activity_name_lvl_2){
			$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_2;

			if($proc_data[0]->activity_name_lvl_3){
				$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_3;

				if($proc_data[0]->activity_name_lvl_4){
					$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_4;
				}
			}
		}

		$nope_sandhi = "6287888276877";
		$nope_indra = "6285274897212";
		$data_wa = [
			'penerima' => $nope_indra,
			'doc_name' => $doc_desc,
			'doc_group' => $proc_data[0]->group_name,
			'doc_step' => $doc_step,
			'tgl_upload' => $input_date,
			'link_to_open' => "https://sasinfinity.com/inpormasi/public/commentPdf/".$id_doc."/procurement/preview"
		];
		procurementApproveFile($data_wa);
	}

	public function reject(){
		$id_doc = $this->request->getPost('id_doc');
        $man_hour_actual= $this->request->getPost('man_hour_actual');
		$doc_step = $this->request->getPost('doc_step');
		$filename = $this->request->getPost('doc_filename');
		$id_file = $this->request->getPost('id_file');

		$act_key = $doc_step . '_act';
		$status_key = $doc_step . '_status';

        $input_date = $this->request->getPost('backdate') ?: date('Y-m-d H:i:s');

		// update doc data
		$data_update_doc = [
			'id' => $id_doc,
			$act_key => $input_date,
			$status_key => 'reject'
		];
		$update_doc = $this->Model_doc_procurement->save($data_update_doc);
		
		// add timeliline
		$data_timeline = [
			'code'					=> 'procurement',
			'doc_id'                => $id_doc,
			'detail_type'           => 'procurement_'.$doc_step,
			'time'                  => $input_date,
			'timeline_title'        => $doc_step.'file reject',
			'timeline_description'  => $doc_step.' file has been rejected with some comments',
			'timeline_status'       => 'on time',
			'new_file'              => $filename,
			'file_status'           => '',
			'created_by'            => sess('active_user_id'),
			'id_file'               => $id_file
		];
		$this->Model_timeline_doc->save($data_timeline);

		$proc_data = $this->Model_doc_procurement->get_by_id($id_doc);
		$doc_desc = $proc_data[0]->activity_name_lvl_1;
		if($proc_data[0]->activity_name_lvl_2){
			$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_2;

			if($proc_data[0]->activity_name_lvl_3){
				$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_3;

				if($proc_data[0]->activity_name_lvl_4){
					$doc_desc = $doc_desc . ' -> ' . $proc_data[0]->activity_name_lvl_4;
				}
			}
		}

		$nope_sandhi = "6287888276877";
		$nope_indra = "6285274897212";
		$data_wa = [
			'penerima' => $nope_indra,
			'doc_name' => $doc_desc,
			'doc_group' => $proc_data[0]->group_name,
			'doc_step' => $doc_step,
			'tgl_upload' => $input_date,
			'link_to_open' => "https://sasinfinity.com/inpormasi/public/commentPdf/".$id_doc."/procurement/preview"
		];
		procurementRejectFile($data_wa);
	}

	// 
	public function show_pdf($doc_id, $step, $isPreviw=false) {
		$data = [   
			'title_meta' => view('partials/title-meta', ['title' => 'Comment PDF']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Comment PDF']),
            'doc_id' => $doc_id,
            'file_name' => 'test.pdf',
            'doc_data' => $this->Model_doc_procurement->get_by_id($doc_id),
            'step' => $step,
            'is_preview' => $isPreviw,
		];
        // echo '<pre>'; print_r( $data );die; echo '</pre>';
		return view('show_pdf_procurement', $data);
    }

    public function show_pdf_reupload($doc_id, $doc_step) {
		$data = [   
			'title_meta' => view('partials/title-meta', ['title' => 'Comment PDF']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Comment PDF']),
            'doc_id' => $doc_id,
            'file_name' => 'test.pdf',
            'doc_data' => $this->Model_doc_procurement->get_by_id($doc_id),
            'doc_step' => $doc_step,
		];
        // echo '<pre>'; print_r( $data );die; echo '</pre>';
		return view('reupload_doc_view_procurement', $data);
    }

	// add comment
    public function add_comment(){
        $uploaded_file = $this->request->getFile('image');
        // store the file
        if($uploaded_file){
            $uploaded_file->move('upload/procurement_doc/comment');
            
            // save file name to database
            $data_add = [
                'id_doc' => $this->request->getPost('id_doc'),
                'id_doc_file' => $this->request->getPost('id_file'),
                'comment_title' => $this->request->getPost('comment_title'),
                'comment_file' => $uploaded_file->getName(),
                'page_detail' => $this->request->getPost('page_detail'),
                'created_by' => sess('active_user_id'),
                'doc_step' => $this->request->getPost('doc_step')
            ];
            $save_file = $this->Model_procurement_doc_comment->save($data_add);

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

        $deleteResult = $this->Model_procurement_doc_comment->delete($id_comment);

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
        $fetched_data = $this->Model_procurement_doc_comment->get_by_idDoc_idApprover($payload);
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
    function timeStatusCheck($plan_date, $actual_date=null) {
        $current_datetime = $actual_date ?: date('Y-m-d H:i:s');
    
        $status = $plan_date > $current_datetime ? "late" : "on time";
    
        return $status;
    }

    // timeline
    public function show_doc_timeline($doc_id){
        // echo '<pre>'; print_r( $doc_id );die; echo '</pre>';
	    $all_timeline_data = $this->Model_timeline_doc
	        ->where('doc_id', $doc_id)
            ->where('code', 'procurement')
	        ->findALl();
	   
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Document Timeline']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Timeline Document']),
			'timeline_data' => array_reverse($all_timeline_data)
		];
        // echo '<pre>'; print_r( $data );die; echo '</pre>';
		return view('timeline-document-procurement', $data);
	}

    // fetch level
    public function fetchLevel()
    {
        // Retrieve parent level values from request query parameters
        $levelToGet = $this->request->getPost('levelToGet');
        $level1 = $this->request->getPost('level1');
        $level2 = $this->request->getPost('level2');
        $level3 = $this->request->getPost('level3');
        $level4 = $this->request->getPost('level4');

        if (!is_null($level1)) {
            $parentLevelsArray[1] = $level1;
        }
        if (!is_null($level2)) {
            $parentLevelsArray[2] = $level2;
        }
        if (!is_null($level3)) {
            $parentLevelsArray[3] = $level3;
        }
        if (!is_null($level4)) {
            $parentLevelsArray[4] = $level4;
        }

        $levelItems = $this->Model_construction->getLevel($levelToGet, $parentLevelsArray);

        // Populate response data
        $response['data'] = $levelItems;

        // Return JSON response
        return json_encode($response);
    }

    // fetch level
    public function fetchConstructinData()
    {
        // Retrieve parent level values from request query parameters
        $id_construction = $this->request->getPost('id_construction');

        // Populate response data
        $response = $this->Model_construction->getConstructionData(1, $id_construction);

        // Return JSON response
        return json_encode($response);
    }

}
