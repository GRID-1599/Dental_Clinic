<?php

if (isset($_POST["getAllPatients"])) {
    include_once '../classes/patient.class.php';
    $paient_obj = new Patient();
    echo json_encode($paient_obj->getPatientById($_POST['patientID']));
}
