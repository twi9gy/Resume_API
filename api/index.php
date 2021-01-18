<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");

require 'config/database.php';

require 'objects/resume.php';

require 'resume/add.php';
require 'resume/edit.php';
require 'resume/getAll.php';
require 'resume/get_byID.php';
require 'resume/status/update.php';
require 'resume/uploadFile.php';
require 'specialties/delete.php';
require 'specialties/edit.php';
require 'educations/delete.php';
require 'educations/edit.php';

$database = new Database();
$db = $database->Connection();

$method = $_SERVER['REQUEST_METHOD'];

$request = $_GET['request'];
$params = explode('/', $request);

$type = $params[0];
if ($params[1] === 'add')
    $action = $params[1];
else
    $id = $params[1];

if($method === 'GET') {

    if ($type === 'cv') {
        if (isset($id) && $id != "") {
            getResume_byId($db, $id);
        } else {
            getResumes($db);
        }
    }
} else if ($method === 'POST') {
    if(!isset($action))
        $action = $params[2];

    if ($type === 'upload') {
        UploadFile($db);
    }
    if ($type === 'cv' && $action === 'add') {
        AddResume($db);
    } else if($type === 'cv' && $action === 'edit'){
        EditResume($db, $id);
    } else if($type === 'cv' && $action === 'status'){
        UpdateStatus($db, $id);
    } else if ($type === 'specialty' && $action === 'add') {
        $data = json_decode(file_get_contents("php://input"));
        foreach ($data->specialties as $specialty) {
            AddSpecialty($db, $data->id_resume, $specialty);
        }
    } else if ($type === 'specialty' && $action === 'edit') {
        EditSpecialty($db, $id);
    } else if ($type === 'education' && $action === 'add') {
        $data = json_decode(file_get_contents("php://input"));
        foreach ($data->educations as $education) {
            AddEducation($db, $data->id_resume, $education);
        }
    } else if ($type === 'education' && $action === 'edit') {
        EditEducation($db, $id);
    }
} else if ($method === 'DELETE') {
    if ($type === 'specialties') {
        DeleteSpecialty_byId($db, $id);
    } else if ($type === 'educations') {
        DeleteEducation_byId($db, $id);
    }
}

