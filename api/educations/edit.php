<?php

$first_position = true;
$query_str = "";

function EditEducation($db, $id)
{
    $data = json_decode(file_get_contents("php://input"));
    global $first_position;
    global $query_str;

    $first_position = true;
    $query_str = "UPDATE educations SET";

    // формируем запрос к базе данных
    if (isset($data->education->faculty_educations))
        AddProperty("faculty_educations", "faculty");
    if (isset($data->education->institution_educations))
        AddProperty("institution_educations", "institution");
    if (isset($data->education->level_educations))
        AddProperty("level_educations", "level");
    if (isset($data->education->specialization_educations))
        AddProperty("specialization_educations", "specialization");
    if (isset($data->education->yearend_educations))
        AddProperty("yearend_educations", "yearEnd");

    if (!$first_position) {
        $query_str = $query_str . " WHERE id_educations = :id";
        // Готовим запрос
        $query = $db->prepare($query_str);

        // устанавливаем переменные
        if (isset($data->education->faculty_educations))
            $query->bindParam(':faculty', $data->education->faculty_educations);
        if (isset($data->education->institution_educations))
            $query->bindParam(':institution', $data->education->institution_educations);
        if (isset($data->education->level_educations))
            $query->bindParam(':level', $data->education->level_educations);
        if (isset($data->education->specialization_educations))
            $query->bindParam(':specialization', $data->education->specialization_educations);
        if (isset($data->education->yearend_educations))
            $query->bindParam(':yearEnd', $data->education->yearend_educations);

        $query->bindParam(':id', $id);
        // выполняем запрос
        $result = $query->execute();

        //var_dump($query_str);
        if ($result) {
            // устанавливаем код ответа - 200 OK
            http_response_code(200);
            $res=[
                "status" => true,
                "message" => "Блок образования изменен"
            ];

            echo json_encode($res);
        }
        else {
            // установим код ответа - 400
            http_response_code(400);

            $res=[
                "status" => false,
                "message" => "Блок образования не изменен"
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}

