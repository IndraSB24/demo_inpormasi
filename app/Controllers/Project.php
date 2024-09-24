<?php

namespace App\Controllers;
use App\Models\Model_project;
use App\Models\Model_doc_engineering;
use App\Models\Model_engineering_doc_comment;
use App\Models\Model_engineering_doc_file;
use App\Models\Model_data_helper;
use App\Models\Model_week;
use App\Models\Model_doc_procurement;
use App\Models\Model_construction;

class Project extends BaseController
{
    protected $main_model, $Model_doc_engineering, $Model_engineering_doc_comment, $Model_engineering_doc_file,
		$Model_data_helper, $Model_week, $Model_doc_procurement;
 
    function __construct(){
        $this->main_model = new Model_project();
		$this->Model_doc_engineering = new Model_doc_engineering();
		$this->Model_engineering_doc_comment = new Model_engineering_doc_comment();
		$this->Model_engineering_doc_file = new Model_engineering_doc_file();
		$this->Model_data_helper = new Model_data_helper();
        $this->Model_week = new Model_week();
		$this->Model_doc_procurement = new Model_doc_procurement();
		$this->Model_construction = new Model_construction();
		helper(['session_helper', 'upload_path_helper', 'NumberFormat_helper']);
    }
    
	public function index($project_detail="", $id_project=NULL){

		$data_project = $this->main_model->getById($id_project);

		$data_page = (object)[
			'overal_plan' => 0,
			'overal_actual' => 0,
			'overal_variance' => 0,
			'chart_pt_engineering_plan' => 50,
			'chart_pt_engineering_actual' => 30,
			'chart_pt_procurement_plan' => $this->Model_doc_procurement->getCumDataPlanPerToday(),
			'chart_pt_procurement_actual' => $this->Model_doc_procurement->getCumDataActualPerToday(),
			'engineering_wf' => $data_project->engineering_wf,
			'procurement_wf' => $data_project->procurement_wf,
			'construction_wf' => $data_project->construction_wf
		];

		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Project Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Project Dashboard '.$project_detail, 'subtitle' => '-']),
			'data_page' => $data_page,
			'progressChartDataEngineering' => [
                'percent_plan' => $this->Model_doc_engineering->getCumDataPlanPerToday(),
                'percent_actual' => $this->Model_doc_engineering->getCumDataActualPerToday()
            ],
			// 'progressChartDataEngineering' => [
			// 	'percent_plan' => [(object) ['cum_progress_plan' => 67.8910]],
			// 	'percent_actual' => [(object) ['cum_progress_actual' => 12.345]]
			// ]
		];
		// return view('project-dashboard', $data);
		return view('project-dashboard-v2', $data);
	}
	
	public function show_project_list(){
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Project List']),
			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Project List'])
		];
		return view('project-list', $data);
	}
	
	public function show_document_list($kode=null){
	    switch($kode){
	        case "engineering":
	            $data = [
        			'title_meta' => view('partials/title-meta', ['title' => 'Engineering Document']),
        			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Engineering Document'])
        		];
        		return view('engineering-document', $data);
	        break;
	        case "procurement":
	            $data = [
        			'title_meta' => view('partials/title-meta', ['title' => 'Procurement Document']),
        			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Procurement Document'])
        		];
        		return view('procurement-document', $data);
	        break;
	    }
		
	}
	
	public function show_over_prog_month_detail(){
		// start of scurve data count engineering ===============================================
        $getScurveDataPlan = $this->Model_doc_engineering->getScurveDataPlan();
        $getScurveDataActual = $this->Model_doc_engineering->getScurveDataActual();

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
        // end of scurve data engineering ===================================================================
		
		// start of scurve data count procurement ============================================================
        $getScurveDataPlanProcurement = $this->Model_doc_procurement->getScurveDataPlan(1);
        $getScurveDataActualProcurement = $this->Model_doc_procurement->getScurveDataActual(1);

        // count plan cum
        $getScurveDataPlanCumProcurement = [];
        $plan_cum_countedProcurement = 0;
        foreach ($getScurveDataPlanProcurement as $key => $value) {
            $plan_cum_countedProcurement += $value->cum_plan_wf;
            $getScurveDataPlanCumProcurement[$key] = $plan_cum_countedProcurement;
        }

        // count act cum
        $getScurveDataActualCumProcurement = [];
        $actual_cum_countedProcurement = 0;
        foreach ($getScurveDataActualProcurement as $key => $value) {
            $actual_cum_countedProcurement += $value->cum_actual_wf;
            $getScurveDataActualCumProcurement[$key] = $actual_cum_countedProcurement;
        }
		// end of scurve data procurement ===================================================================

		// start of scurve data construction =====================================================
        $getScurveDataPlanConstruction = $this->Model_construction->getScurveDataPlan(1);
        $getScurveDataActualConstruction = $this->Model_construction->getScurveDataActual(1);

        // count plan cum
        $getScurveDataPlanCumConstruction = [];
        $plan_cum_countedConstruction = 0;
        foreach ($getScurveDataPlanConstruction as $key => $value) {
            $plan_cum_countedConstruction += $value->cum_plan_wf;
            $getScurveDataPlanCumConstruction[$key] = $plan_cum_countedConstruction;
        }

        // count act cum
        $getScurveDataActualCumConstruction = [];
        $actual_cum_countedConstruction = 0;
        foreach ($getScurveDataActualConstruction as $key => $value) {
            $actual_cum_countedConstruction += $value->cum_actual_wf;
            $getScurveDataActualCumConstruction[$key] = $actual_cum_countedConstruction;
        }
		// end of scurve data construction =======================================================

		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Progress by Week']),
			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Progress by Week']),
			'subtitle' => 'Judul Project',
            'dataWeek' => $this->Model_week->findAll(),
            'scurveDataEngineering' => [
                'dataPlan' => $getScurveDataPlan,
                'dataActual' => $getScurveDataActual,
                'dataPlanCum' => $getScurveDataPlanCum,
                'dataActualCum' => $getScurveDataActualCum
			],
			'scurveDataProcurement' => [
                'dataPlan' => $getScurveDataPlanProcurement,
                'dataActual' => $getScurveDataActualProcurement,
                'dataPlanCum' => $getScurveDataPlanCumProcurement,
                'dataActualCum' => $getScurveDataActualCumProcurement
            ],
			'scurveDataConstruction' => [
                'dataPlan' => $getScurveDataPlanConstruction,
                'dataActual' => $getScurveDataActualConstruction,
                'dataPlanCum' => $getScurveDataPlanCumConstruction,
                'dataActualCum' => $getScurveDataActualCumConstruction
            ],
			'progressWeek' => [
				'engineering' => $this->Model_doc_engineering->getProgressByDicipline(),
				'procurement' => $this->Model_doc_procurement->getProgressByLevel1(),
				'construction' => $this->Model_construction->getConstructionList()
			]
		];
		// echo '<pre>'; print_r( $data['progressWeek']['construction'] );die; echo '</pre>';
		return view('project-dashboard-overal-prog-month', $data);
	}

	public function add(){

		$engineering_value = $this->request->getPost('engineering_value');
		$procurement_value = $this->request->getPost('procurement_value');
		$construction_value = $this->request->getPost('construction_value');

		$total_value = $engineering_value + $procurement_value + $construction_value;

		// Prevent division by zero
		if ($total_value > 0) {
			// Calculate the work factors (as percentages or ratios)
			$engineering_wf = $engineering_value / $total_value;
			$procurement_wf = $procurement_value / $total_value;
			$construction_wf = $construction_value / $total_value;
		} else {
			// Handle case where the total value is zero (no values provided)
			$engineering_wf = $procurement_wf = $construction_wf = 0;
		}

		// Optionally convert to percentages
		$engineering_percentage = $engineering_wf * 100;
		$procurement_percentage = $procurement_wf * 100;
		$construction_percentage = $construction_wf * 100;

    	$data = [
			'contract_no'   => $this->request->getPost('contract_no'),
			'manager'       => $this->request->getPost('project_manager'), 
			'nama_project'  => $this->request->getPost('nama_project'),
			'deskripsi'     => $this->request->getPost('description'),
			'engineering_value'     => $engineering_value,
			'procurement_value'     => $procurement_value,
			'construction_value'     => $construction_value,
			'start_date'    => date_db_format($this->request->getPost('start_date')),
			'end_date'      => date_db_format($this->request->getPost('end_date')),
			'engineering_wf' => $engineering_wf,
			'procurement_wf' => $procurement_wf,
			'construction_wf' => $construction_wf
		];

    	$this->main_model->save($data);
    }
    
    public function delete($id_project){
        $this->main_model->delete($id_project);
    }
    
    public function pagination(){
        
    }
}
