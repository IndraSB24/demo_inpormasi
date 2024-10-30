<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_doc_engineering extends Model
{
    protected $table      = 'project_detail_engineering';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_project', 'level_code', 'description', 'unit', 'weight_factor',
        'plan_ifr', 'plan_ifa', 'plan_ifc',
        'actual_ifr', 'actual_ifa', 'actual_ifc',
        'file', 'file_version', 'file_status', 'file_comment',
        'internal_engineering_status', 'internal_ho_status', 'internal_pem_status', 'internal_originator_status',
        'internal_engineering_date', 'internal_ho_date', 'internal_pem_date', 'internal_originator_date', 
        'id_engineering_doc_file', 'wbs_code', 'actual_ifr_status', 'actual_ifa_status', 'actual_ifc_status',
        'external_asbuild_plan', 'external_asbuild_actual', 'external_asbuild_status', 'id_doc_dicipline', 
        'man_hour_plan', 'man_hour_actual', 'ifa_version', 'ifc_version'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function reset_increment()
    {
        $sql = "ALTER TABLE project_detail_engineering AUTO_INCREMENT=1";
        $this->db->query($sql);
    }
    
    // select all
    public function get_by_id($id_doc){
        $this->select('
            *
        ')
        ->where('id', $id_doc);
        
        return $this->get()->getResult();
    }

    // count all doc
    public function count_all_doc(){
        $this->select('
            *
        ')
        ->where('deleted_at', null);
        
        $result = $this->get()->getResult();
        $count = count($result);
        
        return $count;
    }

    // get sum actual weight factor
    public function get_weight_factor(){
        $this->select('
            weight_factor
        ')
        ->where('deleted_at', NULL)
        ->where('file_status', 'asbuild_approve');
        
        return $this->get()->getResult();
    }

    // get sum plan weight factor
    public function get_plan_weight_factor(){
        $result = $this->select('
            YEAR(external_asbuild_plan) as year,
            MONTH(external_asbuild_plan) as month,
            SUM(weight_factor) as weight_factor_sum
        ')
        ->where('deleted_at', null)
        ->groupBy('YEAR(external_asbuild_plan), MONTH(external_asbuild_plan)')
        ->get()
        ->getResult();
    
        return $result;
    }
    

    // get plan range
    public function get_plan_range(){
        $result = $this->select('
            min(external_asbuild_plan) as min_date_range,
            max(external_asbuild_plan) as max_date_range
        ')
        ->where('deleted_at', null)
        ->get()
        ->getResult();
    
        // Format dates as ISO 8601 (YYYY-MM-DD)
        $formattedResult = array_map(function($item) {
            $item->min_date_range = date('Y-m-d', strtotime($item->min_date_range));
            $item->max_date_range = date('Y-m-d', strtotime($item->max_date_range));
            return $item;
        }, $result);
    
        return $formattedResult;
    }
    

    // get with comment
    public function get_with_comment($id){
        $this->select('
            project_detail_engineering.*,
            c.comment_file as comment_file,
            c.page_detail as page_detail
        ')
        ->join('engineering_doc_comment c', 'c.id_doc=project_detail_engineering.id', 'LEFT')
        ->where('project_detail_engineering.id', $id);
        
        return $this->get()->getResult();
    }

    // Update all fields based on the provided data
    public function updateAllFields($id, $data)
    {
        return $this->update($id, $data);
    }

    // regex search
    public function get_filename_by_doc_id($id_doc)
    {
        $this->select('
            file
        ')
        ->where('id', $id_doc);
        
        return $this->get()->getResult();
    }

    // get all
    public function get_all($idProject, $id_karyawan=null) {
        if($id_karyawan != null){
            $this->select('
                project_detail_engineering.*,
                dh.name as doc_dicipline,
                "super_admin" as has_access
            ')
            ->join('data_helper dh', 'dh.id = project_detail_engineering.id_doc_dicipline', 'LEFT')
            // ->join('karyawan_doc_role kdr', 
            //     'kdr.id_karyawan = ' . $this->db->escape($id_karyawan) . ' AND kdr.doc_type = "engineering" AND kdr.id_doc=project_detail_engineering.id', 
            //     'LEFT'
            // )
            ->where('project_detail_engineering.id_project', $idProject)
            ->where('project_detail_engineering.deleted_at', NULL)
            ->orderBy('project_detail_engineering.id');

        }else{
            $this->select('
                project_detail_engineering.*,
                dh.name as doc_dicipline,
                "super_admin" as has_access
            ')
            ->join('data_helper dh', 'dh.id = project_detail_engineering.id_doc_dicipline', 'LEFT')
            ->where('project_detail_engineering.id_project', $idProject)
            ->where('project_detail_engineering.deleted_at', NULL)
            ->orderBy('project_detail_engineering.id');
        }
        
        return $this->get()->getResult();
    }
    

    // get all man hour by dicipline
    public function getManHourPerDicipline(){
        $this->select('
            IFNULL(SUM(project_detail_engineering.man_hour_plan), 0) AS man_hour_plan,
            IFNULL(SUM(project_detail_engineering.man_hour_actual), 0) AS man_hour_actual,
            dh.name as dicipline_name
        ')
        ->join('data_helper dh', 'dh.id=project_detail_engineering.id_doc_dicipline')
        ->where('project_detail_engineering.deleted_at', NULL)
        ->groupBy('dh.id');
        
        return $this->get()->getResult();
    }

    // get all man hour by dicipline per month
    public function getManHourByDiciplinePerMonth(){
        $this->select('
            YEAR(project_detail_engineering.external_asbuild_plan) as asbuild_plan_year,
            MONTH(project_detail_engineering.external_asbuild_plan) as asbuild_plan_month,
            dh.name as dicipline_name,
            SUM(project_detail_engineering.man_hour_plan) AS man_hour_plan,
            SUM(project_detail_engineering.man_hour_actual) AS man_hour_actual
        ')
        ->join('data_helper dh', 'dh.id=project_detail_engineering.id_doc_dicipline')
        ->where('project_detail_engineering.deleted_at', NULL)
        ->groupBy('asbuild_plan_year, asbuild_plan_month, dicipline_name');
 
        return $this->get()->getResult();
    }

    // get scurve dashboard mdr
    public function getScurveDashboardMDR(){
        $this->select('
            WEEK(project_detail_engineering.external_asbuild_plan) as weeks,
            MONTH(project_detail_engineering.external_asbuild_plan) as asbuild_plan_month,
            dh.name as dicipline_name,
            SUM(project_detail_engineering.man_hour_plan) AS man_hour_plan,
            SUM(project_detail_engineering.man_hour_actual) AS man_hour_actual
        ')
        ->join('data_helper dh', 'dh.id=project_detail_engineering.id_doc_dicipline')
        ->where('project_detail_engineering.deleted_at', NULL)
        ->groupBy('asbuild_plan_year, asbuild_plan_month, dicipline_name');
 
        return $this->get()->getResult();
    }

    // get scurve chart data plan
    public function getScurveDataPlan($idProject, $cuttOffDate = null)
    {
        // Get the current date
        $currentDate = $cuttOffDate ?: date('Y-m-d');

        $sql = "
            SELECT 
                dw.week_number AS week_number,
                (COALESCE(IFA.counted_plan, 0) + COALESCE(IFC.counted_plan, 0) + COALESCE(Asbuild.counted_plan, 0)) AS cum_plan_wf
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                    END AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.plan_ifa BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
                GROUP BY 
                    dw.week_number
            ) AS IFA ON dw.week_number = IFA.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                    END AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.plan_ifc BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
                GROUP BY 
                    dw.week_number
            ) AS IFC ON dw.week_number = IFC.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                    END AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.external_asbuild_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
                GROUP BY 
                    dw.week_number
            ) AS Asbuild ON dw.week_number = Asbuild.week_number
            WHERE
                dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
            ORDER BY 
                dw.week_number
        ";
        $query = $this->db->query($sql);
        return $query->getResult();        
    }

    // get scurve chart data actual
    public function getScurveDataActual($idProject, $cuttOffDate = null)
    {
        // Get the current date
        $currentDate = $cuttOffDate ?: date('Y-m-d');

        $sql = "
            SELECT 
                dw.week_number AS week_number,
                COALESCE(IFA.counted_actual, 0) AS counted_actual_ifa,
                COALESCE(IFC.counted_actual, 0) AS counted_actual_ifc,
                COALESCE(Asbuild.counted_actual, 0) AS counted_actual_asbuild,
                (COALESCE(IFA.counted_actual, 0) + COALESCE(IFC.counted_actual, 0) + COALESCE(Asbuild.counted_actual, 0)) AS cum_actual_wf
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                    END AS counted_actual
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.actual_ifa BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
                GROUP BY 
                    dw.week_number
            ) AS IFA ON dw.week_number = IFA.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                    END AS counted_actual
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.actual_ifc BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
                GROUP BY 
                    dw.week_number
            ) AS IFC ON dw.week_number = IFC.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                    END AS counted_actual
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.external_asbuild_actual BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
                GROUP BY 
                    dw.week_number
            ) AS Asbuild ON dw.week_number = Asbuild.week_number
            WHERE
                dw.id_project = '$idProject' AND dw.start_date <= '$currentDate'
            ORDER BY 
                dw.week_number
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum plan percent progress till today
    public function getCumDataPlanPerToday($idProject, $cuttOffDate = null)
    {
        // Get the current date
        $currentDate = $cuttOffDate ?: date('Y-m-d');

        $sql = "
            SELECT 
                SUM(COALESCE(IFA.counted_plan, 0) + COALESCE(IFC.counted_plan, 0) + COALESCE(Asbuild.counted_plan, 0)) AS cum_progress_plan
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                    END AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.plan_ifa BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS IFA ON dw.week_number = IFA.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                    END AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.plan_ifc BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS IFC ON dw.week_number = IFC.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                    END AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.external_asbuild_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS Asbuild ON dw.week_number = Asbuild.week_number
            WHERE
                dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum actual percent progress till today
    public function getCumDataActualPerToday($idProject, $cuttOffDate = null)
    {
        // Get the current date
        $currentDate = $cuttOffDate ?: date('Y-m-d');

        $sql = "
            SELECT 
                SUM(COALESCE(IFA.counted_actual, 0) + COALESCE(IFC.counted_actual, 0) + COALESCE(Asbuild.counted_actual, 0)) AS cum_progress_actual
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                    END AS counted_actual
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.actual_ifa BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS IFA ON dw.week_number = IFA.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                    END AS counted_actual
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.actual_ifc BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS IFC ON dw.week_number = IFC.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    CASE 
                        WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                        ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                    END AS counted_actual
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_engineering pde ON (pde.external_asbuild_actual BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS Asbuild ON dw.week_number = Asbuild.week_number
            WHERE
                dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum actual document progress till today
    public function getCumActualDocumentPerToday($idProject)
    {
        // Get the current date
        $currentDate = date('Y-m-d');

        $sql = "
            SELECT 
                COALESCE(
                    COUNT(pde.id), 
                    0
                ) AS total_actual_doc
            FROM 
                data_week dw
            LEFT JOIN 
                project_detail_engineering pde ON (pde.external_asbuild_actual BETWEEN dw.start_date AND dw.end_date)
            WHERE 
                dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum plan document progress till today
    public function getCumPlanDocumentPerToday($idProject)
    {
        // Get the current date
        $currentDate = date('Y-m-d');

        $sql = "
            SELECT 
                COALESCE(
                    COUNT(pde.id), 
                    0
                ) AS total_plan_doc
            FROM 
                data_week dw
            LEFT JOIN 
                project_detail_engineering pde ON (pde.external_asbuild_plan BETWEEN dw.start_date AND dw.end_date)
            WHERE 
                dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum actual document progress till today
    public function getCumActualDocumentPerTodayByStep($idProject, $step, $cuttOffDate = null)
    {
        switch($step){
            case 'ifa':
                $columnStep = 'actual_ifa';
                break;
            case 'ifc':
                $columnStep = 'actual_ifc';
                break;
            case 'asbuild':
                $columnStep = 'external_asbuild_actual';
                break;
        }

        // Get the current date
        $currentDate = $cuttOffDate ?: date('Y-m-d');

        $sql = "
            SELECT 
                COALESCE(
                    COUNT(pde.id), 
                    0
                ) AS total
            FROM 
                data_week dw
            LEFT JOIN 
                project_detail_engineering pde ON (pde.$columnStep BETWEEN dw.start_date AND dw.end_date)
            WHERE 
                dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        $result = $query->getRow();

        // Return the total_actual_doc value directly
        return $result ? $result->total : 0;
    }

    // get cum plan document progress till today
    public function getCumPlanDocumentPerTodayByStep($idProject, $step, $cuttOffDate = null)
    {
        switch($step){
            case 'ifa':
                $columnStep = 'plan_ifa';
                break;
            case 'ifc':
                $columnStep = 'plan_ifc';
                break;
            case 'asbuild':
                $columnStep = 'external_asbuild_plan';
                break;
        }

        // Get the current date
        $currentDate = $cuttOffDate ?: date('Y-m-d');

        $sql = "
            SELECT 
                COALESCE(
                    COUNT(pde.id), 
                    0
                ) AS total
            FROM 
                data_week dw
            LEFT JOIN 
                project_detail_engineering pde ON (pde.$columnStep BETWEEN dw.start_date AND dw.end_date)
            WHERE 
                dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        $result = $query->getRow();

        // Return the total_actual_doc value directly
        return $result ? $result->total : 0;
    }

    // get manhour per week
    public function getManHourByDiciplinePerWeek($idProject = 1)
    {
        // Get the current date
        $currentDate = date('Y-m-d');

        $sql = "
            SELECT 
                dw.week_number AS week_number,
                dh.name as dicipline_name,
                COALESCE ( SUM(pde.man_hour_plan) , 0 )  AS man_hour_plan,
                COALESCE ( SUM(pde.man_hour_actual) , 0 )  AS man_hour_actual
            FROM 
                data_week dw
            LEFT JOIN
                project_detail_engineering pde ON (pde.external_asbuild_plan BETWEEN dw.start_date AND dw.end_date)
            LEFT JOIN 
                data_helper dh ON (dh.id = pde.id_doc_dicipline AND dh.type = 'doc_dicipline_engineering')
            WHERE 
                dw.id_project = '$idProject'
            GROUP BY 
                dw.id
            ORDER BY 
                dw.id
        ";

        $query = $this->db->query($sql);
        return $results = $query->getResult();

        // $data = [];

        // foreach ($results as $row) {
        //     $weekNumber = $row->week_number;
        //     $disciplineName = $row->dicipline_name;

        //     if (!isset($data[$weekNumber])) {
        //         $data[$weekNumber] = [
        //             'weekNumber' => $weekNumber,
        //             'disciplines' => []
        //         ];
        //     }

        //     $data[$weekNumber]['disciplines'][] = [
        //         'disciplineName' => $disciplineName,
        //         'man_hour_plan' => $row->man_hour_plan,
        //         'man_hour_actual' => $row->man_hour_actual
        //     ];
        // }

        // // Optionally, convert the data to JSON for easier use in JavaScript front-end
        // $jsonData = json_encode(array_values($data));
        // return $jsonData;
    }

    // get dic list
    public function getDisciplineList()
    {
        $sql = "
            SELECT
                *
            FROM
                data_helper
            WHERE
                type = 'doc_dicipline_engineering' AND name != 'survey & project management'
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get discipline by project
    public function getDisciplineListByProject($idProject)
    {
        $sql = "
            SELECT DISTINCT
                pde.id_doc_dicipline AS id,
                dh.name AS name
            FROM
                project_detail_engineering pde
            LEFT JOIN
                data_helper dh ON dh.id = pde.id_doc_dicipline
            WHERE
                pde.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    public function getManHourByDiciplinePerWeek_1($idProject = 1)
    {
        $sql = "
            SELECT 
                dw.week_number AS week_number,
                dh.name AS discipline_name,
                COALESCE(SUM(pde.man_hour_plan), 0) AS man_hour_plan,
                COALESCE(SUM(pde.man_hour_actual), 0) AS man_hour_actual
            FROM 
                data_week dw
            CROSS JOIN 
                (SELECT DISTINCT dh.id, dh.name FROM data_helper dh WHERE dh.type = 'doc_discipline_engineering') dh
            LEFT JOIN 
                project_detail_engineering pde ON (pde.external_asbuild_plan BETWEEN dw.start_date AND dw.end_date AND pde.id_doc_dicipline = dh.id)
            WHERE 
                dw.id_project = '$idProject'
            GROUP BY 
                dw.week_number, dh.id
            ORDER BY 
                dw.week_number, dh.id
        ";

        $query = $this->db->query($sql);
        $results = $query->getResult();

        $data = [];

        // Ensure all weeks have all disciplines
        $disciplineList = $this->getDisciplineList(); // Assuming this method returns a list of all disciplines

        foreach ($results as $row) {
            $weekNumber = $row->week_number;
            $disciplineName = $row->discipline_name;

            if (!isset($data[$weekNumber])) {
                $data[$weekNumber] = [
                    'weekNumber' => $weekNumber,
                    'disciplines' => []
                ];
                
                // Initialize all disciplines with 0 values
                foreach ($disciplineList as $discipline) {
                    $data[$weekNumber]['disciplines'][$discipline] = [
                        'disciplineName' => $discipline,
                        'man_hour_plan' => 0,
                        'man_hour_actual' => 0
                    ];
                }
            }

            // Populate actual data
            $data[$weekNumber]['disciplines'][$disciplineName] = [
                'disciplineName' => $disciplineName,
                'man_hour_plan' => $row->man_hour_plan,
                'man_hour_actual' => $row->man_hour_actual
            ];
        }

        // Optionally, convert the data to JSON for easier use in JavaScript front-end
        $jsonData = json_encode(array_values($data));
        return $jsonData;
    }

    // get cum plan percent progress by param
    public function getCumDataPlan($idProject = 1, $id_doc_dicipline, $isCum=true, $weekNumber=null)
    {
        // Get the current date
        $currentDate = date('Y-m-d');

        if($isCum){
            $sql = "
                SELECT 
                    SUM(COALESCE(IFA.counted_plan, 0) + COALESCE(IFC.counted_plan, 0) + COALESCE(Asbuild.counted_plan, 0)) AS cum_progress_plan
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                        END AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.plan_ifa BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFA ON dw.week_number = IFA.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                        END AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.plan_ifc BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFC ON dw.week_number = IFC.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                        END AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.external_asbuild_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS Asbuild ON dw.week_number = Asbuild.week_number
                WHERE
                    dw.id_project = '$idProject'
            ";
        }else{
            $sql = "
                SELECT 
                    SUM(COALESCE(IFA.counted_plan, 0) + COALESCE(IFC.counted_plan, 0) + COALESCE(Asbuild.counted_plan, 0)) AS cum_progress_plan
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                        END AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.plan_ifa BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.week_number=$weekNumber AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFA ON dw.week_number = IFA.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                        END AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.plan_ifc BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.week_number=$weekNumber AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFC ON dw.week_number = IFC.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                        END AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.external_asbuild_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.week_number=$weekNumber AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS Asbuild ON dw.week_number = Asbuild.week_number
                WHERE
                    dw.id_project = '$idProject' AND dw.week_number=$weekNumber
            ";
        }
        

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum actual percent progress till today
    public function getCumDataActual($idProject, $id_doc_dicipline, $isCum=true, $weekNumber=null){
        // Get the current date
        $currentDate = date('Y-m-d');

        if($isCum){
            $sql = "
                SELECT 
                    SUM(COALESCE(IFA.counted_actual, 0) + COALESCE(IFC.counted_actual, 0) + COALESCE(Asbuild.counted_actual, 0)) AS cum_progress_actual
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                        END AS counted_actual
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.actual_ifa BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFA ON dw.week_number = IFA.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                        END AS counted_actual
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.actual_ifc BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFC ON dw.week_number = IFC.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                        END AS counted_actual
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.external_asbuild_actual BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS Asbuild ON dw.week_number = Asbuild.week_number
                WHERE
                    dw.id_project = '$idProject'
            ";
        }else{
            $sql = "
                SELECT 
                    SUM(COALESCE(IFA.counted_actual, 0) + COALESCE(IFC.counted_actual, 0) + COALESCE(Asbuild.counted_actual, 0)) AS cum_progress_actual
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.25
                        END AS counted_actual
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.actual_ifa BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.week_number=$weekNumber AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFA ON dw.week_number = IFA.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.40
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.65
                        END AS counted_actual
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.actual_ifc BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.week_number=$weekNumber AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS IFC ON dw.week_number = IFC.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        CASE 
                            WHEN pde.id_doc_dicipline IS NULL THEN SUM(COALESCE(pde.weight_factor, 0)) * 0.30
                            ELSE SUM(COALESCE(pde.weight_factor, 0)) * 0.10
                        END AS counted_actual
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_engineering pde ON (
                            pde.id_doc_dicipline=$id_doc_dicipline AND
                            pde.external_asbuild_actual BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.week_number=$weekNumber AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS Asbuild ON dw.week_number = Asbuild.week_number
                WHERE
                    dw.id_project = '$idProject' AND dw.week_number=$weekNumber
            ";
        }
        

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get week number
    public function getWeekNumberByDate($idProject, $date) {
        $sql = "
            SELECT
                week_number
            FROM
                data_week
            WHERE
                start_date <= ? AND end_date >= ? AND id_project = ?
        ";
    
        $query = $this->db->query($sql, [$date, $date, $idProject]);
        $result = $query->getRow();
    
        return $result ? $result->week_number : null;
    }
    
    // get percent progress by dicipline
    public function getProgressByDicipline($idProject, $cuttOffDate) {
        $currentDate = $cuttOffDate ?: date('Y-m-d');
    
        // Get the current week number and last week number
        $currentWeek = $this->getWeekNumberByDate($idProject, $currentDate);
        $lastWeek = $currentWeek - 1;
    
        // Initialize the return data array
        $returnData = [];
    
        // Get the list of disciplines
        // $diciplineList = $this->getDisciplineList();
        $diciplineList = $this->getDisciplineListByProject($idProject);
    
        // Iterate through each discipline
        foreach ($diciplineList as $value) {
            $cumPlan = $this->getCumDataPlan($idProject, $value->id, true, null);
            $cumActual = $this->getCumDataActual($idProject, $value->id, true, null);
            $cumPlanCurrentWeek = $this->getCumDataPlan($idProject, $value->id, false, $currentWeek);
            $cumActualCurrentWeek = $this->getCumDataActual($idProject, $value->id, false, $currentWeek);
            $cumPlanLastWeek = $this->getCumDataPlan($idProject, $value->id, false, $lastWeek);
            $cumActualLastWeek = $this->getCumDataActual($idProject, $value->id, false, $lastWeek);
            
            $returnData[$value->name] = [
                'cumPlan' => $cumPlan[0]->cum_progress_plan,
                'cumActual' => $cumActual[0]->cum_progress_actual,
                'cumPlanCurrentWeek' => $cumPlanCurrentWeek[0]->cum_progress_plan,
                'cumActualCurrentWeek' => $cumActualCurrentWeek[0]->cum_progress_actual,
                'cumPlanLastWeek' => $cumPlanLastWeek[0]->cum_progress_plan,
                'cumActualLastWeek' => $cumActualLastWeek[0]->cum_progress_actual
            ];
        }
    
        // Return the aggregated data
        return [
            'currentWeek' => $currentWeek,
            'lastWeek' => $lastWeek,
            'data' => $returnData
        ];
        
    }
    

    // Get all records by id_project
    public function getByProjectId($id_project)
    {
        return $this->where('id_project', $id_project)->findAll();
    }

    // Helper function to calculate the weight factor based on man_hour_plan
    private function calculateWeightFactor($manHourPlan, $totalManHourPlan)
    {
        // Prevent division by zero
        if ($totalManHourPlan == 0) {
            return 0;
        }

        // Calculate the weight factor as a percentage
        return ($manHourPlan / $totalManHourPlan) * 100;
    }

    public function processProject($id_project)
    {
        // 1. Get all records by id_project
        $records = $this->getByProjectId($id_project);

        if (empty($records)) {
            log_message('error', "No records found for project ID {$id_project}.");
            return [
                'success' => false,
                'message' => 'No records found for the specified project.'
            ];
        }

        // 2. Calculate total man-hour for man_hour_plan
        $totalManHourPlan = 0;
        foreach ($records as $record) {
            if (isset($record->man_hour_plan)) { // Accessing the property as an object
                $totalManHourPlan += $record->man_hour_plan; // Using -> instead of []
            } else {
                log_message('error', "Missing man_hour_plan for record ID {$record->id}."); // Accessing the property as an object
                return [
                    'success' => false,
                    'message' => 'One or more records have missing man_hour_plan values.'
                ];
            }
        }

        // 3. Prepare data for batch update
        $updateData = [];
        foreach ($records as $record) {
            $newWeightFactor = $this->calculateWeightFactor($record->man_hour_plan, $totalManHourPlan); // Using -> instead of []

            // 4. Prepare each record update
            $updateData[] = [
                'id' => $record->id, // Accessing the property as an object
                'weight_factor' => $newWeightFactor
            ];
        }

        // 5. Batch update records
        foreach ($updateData as $data) {
            $this->update($data['id'], [
                'weight_factor' => $data['weight_factor']
            ]);
        }

        return [
            'success' => true,
            'message' => 'Project man-hours and weight factors processed successfully.'
        ]; // Process completed
    }






    

}
