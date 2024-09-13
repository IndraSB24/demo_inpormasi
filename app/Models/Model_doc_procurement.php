<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_doc_procurement extends Model
{
    protected $table      = 'project_detail_procurement';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;
    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'id_project', 'activity_code', 'description',
        'activity_code', 
        
        'activity_name_lvl_1', 'activity_name_lvl_2', 'activity_name_lvl_3', 'activity_name_lvl_4', 'detail_or_spesifikasi', 
        'quantity', 'unit', 'harga_satuan_material', 'total_harga_material', 'total_amount_material', 'harga_satuan_jasa', 
        'total_harga_jasa', 'total_amount_jasa', 'wf', 'po_plan', 'po_act', 'fat_plan', 'fat_act', 'rfs_plan', 'rfs_act', 
        'onsite_plan', 'onsite_act', 'install_plan', 'install_act', 'comm_plan', 'comm_act', 'id_group',
        'po_filename', 'po_status', 'po_id_file', 'activity_name_lvl_5',
        'fat_filename', 'fat_status', 'fat_id_file', 'rfs_filename', 'rfs_status', 'rfs_id_file',
        'onsite_filename', 'onsite_status', 'onsite_id_file', 'install_filename', 'install_status', 'install_id_file',
        'comm_filename', 'comm_status', 'comm_id_file'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'name'      => 'required|min_length[3]',
        'price'     => 'required|numeric',
    ];

    protected $validationMessages = [
        'name'        => [
            'required' => 'Bagian Name Harus diisi',
            'min_length' => 'Minimal 3 Karakter'
        ],
        'price'        => [
            'required' => 'Bagian Price Harus diisi',
            'numeric' => 'Hanya bisa diisi dengan angka'
        ]
    ];
    protected $skipValidation  = true;

    public function reset_increment()
    {
        $sql = "ALTER TABLE project_detail_procurement AUTO_INCREMENT=1";
        $this->db->query($sql);
    }

    // get all man hour by dicipline per month
    public function getAll(){
        $this->select('
            project_detail_procurement.*,
            dh.name as group_name
        ')
        ->join('data_helper dh', 'dh.id=project_detail_procurement.id_group', 'LEFT')
        ->where('project_detail_procurement.deleted_at', NULL);

        
        return $this->get()->getResult();
    }

    public function getAll_1($id_karyawan=null) {
        if($id_karyawan != null){
            $this->select('
                project_detail_procurement.*,
                dh.name as group_name,
                kdr.id_doc_role as procurement_role
            ')
            ->join('data_helper dh', 'dh.id=project_detail_procurement.id_group', 'LEFT')
            ->join('karyawan_doc_role kdr', 
                'kdr.id_karyawan = ' . $this->db->escape($id_karyawan) . ' AND kdr.doc_type = "procurement"', 
                'LEFT'
            )
            ->where('project_detail_procurement.deleted_at', NULL)
            ->orderBy('project_detail_procurement.id');

        }else{
            $this->select('
                project_detail_procurement.*,
                dh.name as group_name,
                null as procurement_role
            ')
            ->join('data_helper dh', 'dh.id=project_detail_procurement.id_group', 'LEFT')
            ->where('project_detail_procurement.deleted_at', NULL)
            ->orderBy('project_detail_procurement.id');
        }
        
        return $this->get()->getResult();
    }

    // get by id
    public function get_by_id($id_doc){
        $this->select('
            project_detail_procurement.*,
            dh.name as group_name
        ')
        ->join('data_helper dh', 'dh.id=project_detail_procurement.id_group')
        ->where('project_detail_procurement.id', $id_doc);
        
        return $this->get()->getResult();
    }

    // get cum plan percent progress till today
    public function getCumDataPlanPerToday($idProject = 1)
    {
        // Get the current date
        $currentDate = date('Y-m-d');

        $sql = "
            SELECT 
                SUM(
                    COALESCE(PO.counted_plan, 0) + 
                    COALESCE(FAT.counted_plan, 0) + 
                    COALESCE(RFS.counted_plan, 0) +
                    COALESCE(ONSITE.counted_plan, 0) + 
                    COALESCE(INSTALL.counted_plan, 0) + 
                    COALESCE(COMM.counted_plan, 0)
                ) AS cum_progress_plan
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.po_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS PO ON dw.week_number = PO.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.fat_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS FAT ON dw.week_number = FAT.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.rfs_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS RFS ON dw.week_number = RFS.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.onsite_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS ONSITE ON dw.week_number = ONSITE.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.install_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS INSTALL ON dw.week_number = INSTALL.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.comm_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS COMM ON dw.week_number = COMM.week_number
            WHERE
                dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        $result = $query->getResult();

        return $result[0]->cum_progress_plan ?: 0;
    }

    // get cum actual percent progress till today
    public function getCumDataActualPerToday($idProject = 1)
    {
        // Get the current date
        $currentDate = date('Y-m-d');

        $sql = "
            SELECT 
                SUM(
                    COALESCE(PO.counted_act, 0) + 
                    COALESCE(FAT.counted_act, 0) + 
                    COALESCE(RFS.counted_act, 0) +
                    COALESCE(ONSITE.counted_act, 0) + 
                    COALESCE(INSTALL.counted_act, 0) + 
                    COALESCE(COMM.counted_act, 0)
                ) AS cum_progress_actual
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.po_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS PO ON dw.week_number = PO.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.fat_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS FAT ON dw.week_number = FAT.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.rfs_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS RFS ON dw.week_number = RFS.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.onsite_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS ONSITE ON dw.week_number = ONSITE.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.install_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS INSTALL ON dw.week_number = INSTALL.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.comm_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS COMM ON dw.week_number = COMM.week_number
            WHERE
                dw.id_project = '$idProject'
        ";

        $query = $this->db->query($sql);
        $result = $query->getResult();

        return $result[0]->cum_progress_actual ?: 0;
    }

    // get scurve data actual
    public function getScurveDataActual($idProject = 1)
    {
        $sql = "
            SELECT 
                dw.week_number AS week_number,
                SUM(
                    COALESCE(PO.counted_act, 0) + 
                    COALESCE(FAT.counted_act, 0) + 
                    COALESCE(RFS.counted_act, 0) +
                    COALESCE(ONSITE.counted_act, 0) + 
                    COALESCE(INSTALL.counted_act, 0) + 
                    COALESCE(COMM.counted_act, 0)
                ) AS cum_actual_wf
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.po_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS PO ON dw.week_number = PO.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.fat_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS FAT ON dw.week_number = FAT.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.rfs_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS RFS ON dw.week_number = RFS.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.onsite_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS ONSITE ON dw.week_number = ONSITE.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.install_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS INSTALL ON dw.week_number = INSTALL.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_act
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.comm_act BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS COMM ON dw.week_number = COMM.week_number
            WHERE
                dw.id_project = '$idProject'
            GROUP BY 
                dw.week_number
            ORDER BY 
                dw.week_number
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get scurve data plan
    public function getScurveDataPlan($idProject = 1)
    {
        $sql = "
            SELECT 
                dw.week_number AS week_number,
                SUM(
                    COALESCE(PO.counted_plan, 0) + 
                    COALESCE(FAT.counted_plan, 0) + 
                    COALESCE(RFS.counted_plan, 0) +
                    COALESCE(ONSITE.counted_plan, 0) + 
                    COALESCE(INSTALL.counted_plan, 0) + 
                    COALESCE(COMM.counted_plan, 0)
                ) AS cum_plan_wf
            FROM 
                data_week dw
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.po_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS PO ON dw.week_number = PO.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.fat_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS FAT ON dw.week_number = FAT.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.rfs_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS RFS ON dw.week_number = RFS.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.onsite_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS ONSITE ON dw.week_number = ONSITE.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.install_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS INSTALL ON dw.week_number = INSTALL.week_number
            LEFT JOIN (
                SELECT 
                    dw.week_number AS week_number,
                    SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_plan
                FROM 
                    data_week dw
                LEFT JOIN 
                    project_detail_procurement pdp ON (pdp.comm_plan BETWEEN dw.start_date AND dw.end_date)
                WHERE
                    dw.id_project = '$idProject'
                GROUP BY
                    dw.week_number
            ) AS COMM ON dw.week_number = COMM.week_number
            WHERE
                dw.id_project = '$idProject'
            GROUP BY 
                dw.week_number
            ORDER BY 
                dw.week_number
        ";

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum plan percent progress by param
    public function getCumDataPlan($idProject = 1, $level_1, $isCum=true, $weekNumber=null)
    {
        // Get the current date
        $currentDate = date('Y-m-d');

        if($isCum){
            $sql = "
                SELECT 
                    SUM(
                        COALESCE(PO.counted_plan, 0) + 
                        COALESCE(FAT.counted_plan, 0) + 
                        COALESCE(RFS.counted_plan, 0) +
                        COALESCE(ONSITE.counted_plan, 0) + 
                        COALESCE(INSTALL.counted_plan, 0) + 
                        COALESCE(COMM.counted_plan, 0)
                    ) AS cum_progress_plan
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.po_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS PO ON dw.week_number = PO.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.fat_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS FAT ON dw.week_number = FAT.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.rfs_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS RFS ON dw.week_number = RFS.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.onsite_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS ONSITE ON dw.week_number = ONSITE.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.install_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS INSTALL ON dw.week_number = INSTALL.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.comm_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS COMM ON dw.week_number = COMM.week_number
                WHERE
                    dw.id_project = '$idProject'
            ";
        }else{
            $sql = "
                SELECT 
                    SUM(
                        COALESCE(PO.counted_plan, 0) + 
                        COALESCE(FAT.counted_plan, 0) + 
                        COALESCE(RFS.counted_plan, 0) +
                        COALESCE(ONSITE.counted_plan, 0) + 
                        COALESCE(INSTALL.counted_plan, 0) + 
                        COALESCE(COMM.counted_plan, 0)
                    ) AS cum_progress_plan
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.po_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS PO ON dw.week_number = PO.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.fat_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS FAT ON dw.week_number = FAT.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.rfs_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS RFS ON dw.week_number = RFS.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.onsite_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS ONSITE ON dw.week_number = ONSITE.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.install_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS INSTALL ON dw.week_number = INSTALL.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_plan
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.comm_plan BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS COMM ON dw.week_number = COMM.week_number
                WHERE
                    dw.id_project = '$idProject' AND dw.week_number=$weekNumber
            ";
        }
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get cum actual percent progress till today
    public function getCumDataActual($idProject = 1, $level_1, $isCum=true, $weekNumber=null){
        // Get the current date
        $currentDate = date('Y-m-d');

        if($isCum){
            $sql = "
                SELECT 
                    SUM(
                        COALESCE(PO.counted_act, 0) + 
                        COALESCE(FAT.counted_act, 0) + 
                        COALESCE(RFS.counted_act, 0) +
                        COALESCE(ONSITE.counted_act, 0) + 
                        COALESCE(INSTALL.counted_act, 0) + 
                        COALESCE(COMM.counted_act, 0)
                    ) AS cum_progress_actual
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.po_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS PO ON dw.week_number = PO.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.fat_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS FAT ON dw.week_number = FAT.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.rfs_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS RFS ON dw.week_number = RFS.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.onsite_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS ONSITE ON dw.week_number = ONSITE.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.install_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS INSTALL ON dw.week_number = INSTALL.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.comm_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS COMM ON dw.week_number = COMM.week_number
                WHERE
                    dw.id_project = '$idProject'
            ";
        }else{
            $sql = "
                SELECT 
                    SUM(
                        COALESCE(PO.counted_act, 0) + 
                        COALESCE(FAT.counted_act, 0) + 
                        COALESCE(RFS.counted_act, 0) +
                        COALESCE(ONSITE.counted_act, 0) + 
                        COALESCE(INSTALL.counted_act, 0) + 
                        COALESCE(COMM.counted_act, 0)
                    ) AS cum_progress_actual
                FROM 
                    data_week dw
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.po_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS PO ON dw.week_number = PO.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.10 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.fat_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS FAT ON dw.week_number = FAT.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.rfs_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS RFS ON dw.week_number = RFS.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.35 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.onsite_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS ONSITE ON dw.week_number = ONSITE.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.20 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.install_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS INSTALL ON dw.week_number = INSTALL.week_number
                LEFT JOIN (
                    SELECT 
                        dw.week_number AS week_number,
                        SUM(COALESCE(pdp.wf, 0)) * 0.05 AS counted_act
                    FROM 
                        data_week dw
                    LEFT JOIN 
                        project_detail_procurement pdp ON (
                            pdp.activity_name_lvl_1 = '$level_1' AND
                            pdp.comm_act BETWEEN dw.start_date AND dw.end_date
                        )
                    WHERE
                        dw.start_date <= '$currentDate' AND dw.id_project = '$idProject'
                    GROUP BY
                        dw.week_number
                ) AS COMM ON dw.week_number = COMM.week_number
                WHERE
                    dw.id_project = '$idProject' AND dw.week_number=$weekNumber
            ";
        }
        

        $query = $this->db->query($sql);
        return $query->getResult();
    }

    // get week number
    public function getWeekNumberByDate($date) {
        $sql = "
            SELECT
                week_number
            FROM
                data_week
            WHERE
                start_date <= ? AND end_date >= ?
        ";
    
        $query = $this->db->query($sql, [$date, $date]);
        $result = $query->getRow();
    
        return $result ? $result->week_number : null;
    }

    // get dic list
    public function getLevel1List($id_project = 1)
    {
        $sql = "
            SELECT 
                DISTINCT activity_name_lvl_1
            FROM 
                project_detail_procurement
            WHERE 
                id_project = $id_project
        ";
        
        $query = $this->db->query($sql);
        return $query->getResult();
    }
    

    // get percent progress by level 1
    public function getProgressByLevel1($idProject = 1) {
        $currentDate = date('Y-m-d');
    
        // Get the current week number and last week number
        $currentWeek = $this->getWeekNumberByDate($currentDate);
        $lastWeek = $currentWeek - 1;
    
        // Initialize the return data array
        $returnData = [];
    
        // Get the list of level 1
        $level1List = $this->getLevel1List();
    
        // Iterate through each level 1
        foreach ($level1List as $value) {
            $cumPlan = $this->getCumDataPlan($idProject, $value->activity_name_lvl_1, true, null);
            $cumActual = $this->getCumDataActual($idProject, $value->activity_name_lvl_1, true, null);
            $cumPlanCurrentWeek = $this->getCumDataPlan($idProject, $value->activity_name_lvl_1, false, $currentWeek);
            $cumActualCurrentWeek = $this->getCumDataActual($idProject, $value->activity_name_lvl_1, false, $currentWeek);
            $cumPlanLastWeek = $this->getCumDataPlan($idProject, $value->activity_name_lvl_1, false, $lastWeek);
            $cumActualLastWeek = $this->getCumDataActual($idProject, $value->activity_name_lvl_1, false, $lastWeek);
            
            $returnData[$value->activity_name_lvl_1] = [
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

    // get percent progress by level 1
    public function getProgressByLevel1ForChart($idProject = 1) {
        $currentDate = date('Y-m-d');
    
        // Get the current week number and last week number
        $currentWeek = $this->getWeekNumberByDate($currentDate);
        $lastWeek = $currentWeek - 1;
    
        // Initialize the return data array
        $returnData = [];
    
        // Get the list of level 1
        $level1List = $this->getLevel1List();
    
        // Iterate through each level 1
        foreach ($level1List as $value) {
            $cumPlan = $this->getCumDataPlan($idProject, $value->activity_name_lvl_1, true, null);
            $cumActual = $this->getCumDataActual($idProject, $value->activity_name_lvl_1, true, null);
            
            $returnData[$value->activity_name_lvl_1] = [
                'cumPlan' => $cumPlan[0]->cum_progress_plan,
                'cumActual' => $cumActual[0]->cum_progress_actual
            ];
        }
    
        // Return the aggregated data
        return [
            'currentWeek' => $currentWeek,
            'lastWeek' => $lastWeek,
            'data' => $returnData
        ];
        
    }


}
