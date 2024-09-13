<?php
    function rupiah($nominal){
        return 'Rp. '.number_format($nominal,2,",",".");
    }
    
    function angka($angka_koma, $nominal){
        return number_format($nominal,$angka_koma,",",".");
    }
?>