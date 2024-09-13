<?php
    function ajaxReturnDie($status, $text, $reload = FALSE)
    {
    	echo json_encode(array('status' => $status, 'msg' => $text, 'reload' => $reload));
    	die;
    }
?>