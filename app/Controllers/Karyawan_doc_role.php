<?php

namespace App\Controllers;
use App\Models\Model_project;
use App\Models\Model_karyawan;
use App\Models\Model_karyawan_doc_role;
use App\Models\Model_role;
use App\Models\Model_doc_engineering;

class Karyawan_doc_role extends BaseController
{
    protected $Model_karyawan, $Model_karyawan_doc_role, $Model_role, $Model_doc_engineering;

    function __construct(){
        $this->Model_karyawan = new Model_karyawan();
        $this->Model_karyawan_doc_role = new Model_karyawan_doc_role();
        $this->Model_role = new Model_role();
        $this->Model_doc_engineering = new Model_doc_engineering();
		helper(['session_helper']);
    }
    
	public function index($id)
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Employee']),
			'page_title' => view('partials/page-title', ['title' => 'Overal', 'pagetitle' => 'List Document']),
            'data_role' => $this->Model_role->get_by_type('doc_role'),
            'data_engineering_doc' => $this->Model_doc_engineering->findAll(),
            'karyawan_id' => $id,
		];
        // echo '<pre>'; print_r( $data );die; echo '</pre>';
		return view('karyawan-doc-list', $data);
	}

	// add karyawan
    public function add(){
		$data_add = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'id_karyawan', 'id_doc', 'id_doc_role'
            ])
        );
        $data_add['doc_type'] = 'engineering';
        $data_add['created_by'] = sess('active_user_id');
		$add = $this->Model_karyawan_doc_role->save($data_add);

		if ($add) {
			$response = [
				'success' => true,
				'message' => 'Employee added successfully.'
			];
		} else {
			$response = [
				'success' => false,
				'message' => 'Failed to add employee.'
			];
		}

        return $this->response->setJSON($response);
    }

	// edit =================================================================================================
    public function edit(){
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'id_karyawan', 'id_doc', 'id_doc_role'
            ])
        );
        $data['id'] = $this->request->getPost('edit_id');
        $data['created_by'] = sess('active_user_id');

        $updateData = $this->Model_karyawan_doc_role->save($data);
        
        if ($updateData) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }
    
    // delete ===============================================================================================
    public function delete()
    {
        $deleteData = $this->Model_karyawan_doc_role->delete($this->request->getPost('id'));

        if ($deleteData) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    // list karyawan doc role
	public function ajax_get_list($id_karyawan){
        $returnedData = $this->Model_karyawan_doc_role->get_datatable_main($id_karyawan);
        // echo '<pre>'; print_r( $returnedData  );die; echo '</pre>';
        $data = [];
        foreach ($returnedData['return_data'] as $itung => $baris) {
            $aksi = "
                <a class='btn btn-sm btn-success' id='btn_edit'
                    data-id='$baris->id'
                >
                    <i class='far fa-edit'></i>
                </a>
                <a class='btn btn-sm btn-danger' id='btn_delete' 
                    data-id='$baris->id'
                > 
                    <i class='fas fa-trash-alt'></i>
                </a>
            ";

            $data[] = [
                '<span class="text-center">' . ($itung + 1) . '</span>',
                '<span class="text-center">' . $baris->doc_name . '</span>',
                '<span class="text-center">' . $baris->role_name . '</span>',
                '<span class="text-center">' . $aksi . '</span>'
            ];
        }

        $output = [
            "draw" => $_POST['draw'],
            "recordsTotal" => $returnedData['count_filtered'],
            "recordsFiltered" => $returnedData['count_all'],
            "data" => $data,
        ];

        // Output to JSON format
        return $this->response->setJSON($output);
    }

	// ajax get data edit
    public function ajax_get_karyawan_doc_role_data(){
        $id = $this->request->getPost('id');
        $fetch_edit_data = $this->Model_karyawan_doc_role->get_by_id($id);

        return $this->response->setJSON($fetch_edit_data[0]);
    }
    
}
