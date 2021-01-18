<?php

$first_position = true;
$query_str = "";

function EditSpecialty($db, $id)
{
    $data = json_decode(file_get_contents("php://input"));
    global $first_position;
    global $query_str;

    $first_position = true;
    $query_str = "UPDATE specialties SET";

    // формируем запрос к базе данных
    if (isset($data->specialty->currency_specialties))
        AddProperty("currency_specialties", "currency");
    if (isset($data->specialty->dateentry_specialties))
        AddProperty("dateentry_specialties", "dateentry");
    if (isset($data->specialty->position_specialties))
        AddProperty("position_specialties", "position");
    if (isset($data->specialty->salary_specialties))
        AddProperty("salary_specialties", "salary");
    if (isset($data->specialty->specializations_specialties))
        AddProperty("specializations_specialties", "specializations");

    if (!$first_position) {
        $query_str = $query_str . " WHERE id_specialties = :id";
        // Готовим запрос
        $query = $db->prepare($query_str);

        // устанавливаем переменные
        if (isset($data->specialty->currency_specialties))
            $query->bindParam(':currency', $data->specialty->currency_specialties);
        if (isset($data->dateentry_specialties))
            $query->bindParam(':dateentry', $data->specialty->dateentry_specialties);
        if (isset($data->specialty->position_specialties))
            $query->bindParam(':position', $data->specialty->position_specialties);
        if (isset($data->specialty->salary_specialties))
            $query->bindParam(':salary', $data->specialty->salary_specialties);
        if (isset($data->specialty->specializations_specialties))
            $query->bindParam(':specializations', $data->specialty->specializations_specialties);

        $query->bindParam(':id', $id);
        // выполняем запрос
        $result = $query->execute();

        //var_dump($query_str);
        if ($result) {
            // устанавливаем код ответа - 200 OK
            http_response_code(200);
            $res=[
                "status" => true,
                "message" => "Блок место работы изменен"
            ];

            echo json_encode($res);
        }
        else {
            // установим код ответа - 400
            http_response_code(400);

            $res=[
                "status" => false,
                "message" => "Блок место работы не изменен"
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}

