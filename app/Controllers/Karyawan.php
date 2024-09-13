<?php

namespace App\Controllers;
use App\Models\Model_project;
use App\Models\Model_karyawan;
use App\Models\Model_user;


class Karyawan extends BaseController
{
    protected $Model_karyawan, $Model_user;

    function __construct(){
        $this->Model_karyawan = new Model_karyawan();
        $this->Model_user = new Model_user();
		helper(['session_helper']);
    }
    
	public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Employee']),
			'page_title' => view('partials/page-title', ['title' => 'Overal', 'pagetitle' => 'Employee Master Data'])
		];
		return view('master-data-karyawan', $data);
	}

	// add karyawan
    public function add_karyawan(){
        // create user
        $dataAddUser = [
            'username' => $this->request->getPost('email'),
            'nama' => $this->request->getPost('name'),
            'password' => password_hash('pp123', PASSWORD_DEFAULT),
            'status' => 1,
            'id_role' => 7
        ];
        $insertedId = $this->Model_user->insertWithReturnId($dataAddUser);

		$data_add = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'name', 'email', 'phone'
            ])
        );
        // echo '<pre>'; print_r( $data_add );die; echo '</pre>';
        $data_add['created_by'] = sess('active_user_id');
        $data_add['id_user'] = $insertedId;

        $uploaded_file = $this->request->getFile('file');
        // store the file
        if($uploaded_file){
            $store_file = $uploaded_file->move('upload/user_signature');
            $data_add['signature_filename'] = $uploaded_file->getName();
        }

		$save_file = $this->Model_karyawan->save($data_add);

		if ($save_file) {
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
    public function edit_karyawan(){
        $data = array_intersect_key(
            $this->request->getPost(),
            array_flip([
                'name', 'email', 'phone'
            ])
        );
        $data['id'] = $this->request->getPost('edit_id');
        $data['created_by'] = sess('active_user_id');

        $uploaded_file = $this->request->getFile('file');
        // store the file
        if($uploaded_file){
            $store_file = $uploaded_file->move('upload/user_signature');
            $data_add['signature_filename'] = $uploaded_file->getName();
        }

        $insertData = $this->Model_karyawan->save($data);
        
        if ($insertData) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }
    
    // delete ===============================================================================================
    public function delete_karyawan()
    {
        $deleteData = $this->Model_karyawan->delete($this->request->getPost('id'));

        if ($deleteData) {
            $response = ['success' => true];
        } else {
            $response = ['success' => false];
        }
        return $this->response->setJSON($response);
    }

    public function karyawan_doc_list($id) {
        $data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Employee']),
			'page_title' => view('partials/page-title', ['title' => 'Overal', 'pagetitle' => 'List Document'])
		];
		return view('karyawan-doc-list', $data);
    }

    // list karyawan
	public function ajax_get_list(){
        $returnedData = $this->Model_karyawan->get_datatable_main();
        // echo '<pre>'; print_r( $returnedData );die; echo '</pre>';
        $data = [];
        foreach ($returnedData['return_data'] as $itung => $baris) {
            $aksi = "
                <button class='btn btn-sm btn-info waves-effect waves-light' data-id='$baris->id' id='showPdf'>
					<i class='fas fa-file-pdf'></i> Assignment
				</button>
                <a class='btn btn-sm btn-success' id='btn_edit'
                    data-id='$baris->id'
                >
                    <i class='far fa-edit'></i>
                </a>
                <a class='btn btn-sm btn-danger' id='btn_delete' 
                    data-id='$baris->id'
                    data-name='$baris->name'
                > 
                    <i class='fas fa-trash-alt'></i>
                </a>
            ";

            $data[] = [
                '<span class="text-center">' . ($itung + 1) . '</span>',
                '<span class="text-center">' . $baris->name . '</span>',
                '<span class="text-center">' . $baris->email . '</span>',
                '<span class="text-center">' . $baris->phone . '</span>',
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
    public function ajax_get_item_data(){
        $id = $this->request->getPost('id_item');
        $fetch_edit_data = $this->Model_karyawan->get_by_id($id);

        return $this->response->setJSON($fetch_edit_data[0]);
    }

    // set signature ======================================================
    public function setSignature(){
        // read the file
        $uploaded_file = $this->request->getFile('file');
        $id_karyawan = $this->request->getPost('id_karyawan');
        // echo '<pre>'; print_r( $uploaded_file);die; echo '</pre>';
        // store the file
        if($uploaded_file){
            $store_file = $uploaded_file->move('upload/user_signature');

            // save file name to database
            $data = [
                'id' => $id_karyawan,
                'signature_filename' => $uploaded_file->getName()
            ];
            $update = $this->Model_karyawan->save($data);

            // return
            if ($update){
                $response = [
                    'success' => true,
                    'message' => 'suceess.'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed'
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
    
}
