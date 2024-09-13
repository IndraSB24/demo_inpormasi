<?php
    
    function pesan($parameter=""){
        $session = session();
        if($parameter=="error"){
            return $session->getFlashdata('error');
        }else{
            return $session->getFlashdata('message');   
        }
    }
    
    function sess($parameter) {
        $session = session();
        switch ($parameter) {
            case 'active_user_id':
                return $session->get('activeId');
            case 'active_username':
                return $session->get('username');
            case 'active_user_name':
                return $session->get('nama');
            case 'active_karyawan_id':
                return $session->get('id_karyawan');
            default:
                return null;
        }
    }
    

    function sessActiveRole(){
        $session = session();
        return $session->get('role');
    }

    function sessUserSignature(){
        $session = session();
        return $session->get('signatureFile');
    }

    function allSession()
    {
        $session = session();
        return json_encode($session->get());
    }
    
?>
