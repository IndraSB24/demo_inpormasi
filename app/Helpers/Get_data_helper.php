<?php  

    use App\Models\Model_project;

    function get_data_list_project() {
        $model = new Model_project();
        return $model->findAll();
    }
