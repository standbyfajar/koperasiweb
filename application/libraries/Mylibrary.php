<?php
class Mylibrary {
function format_tanggal($tgl){
   return substr($tgl, 8, 2).'-'. substr($tgl, 5, 2).'-'.substr($tgl, 0, 4);
}
}
?>