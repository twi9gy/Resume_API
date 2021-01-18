<?php
function AddSpecialty($db, $id_resume, $data)
{
    // добавляем к резюме блок образования

    if ($data->positionJob !== "") {
        $query = $db->prepare("INSERT INTO specialties (position_specialties, salary_specialties, specializations_specialties,
                                dateentry_specialties, currency_specialties, id_resume)
                            VALUES (:position_e, :salary, :specializations, :dateentry, :cerrency, :resume_id)"
        );
        $query->bindParam(':position_e', $data->position_specialties);
        $query->bindParam(':salary', $data->salary_specialties);
        $query->bindParam(':specializations', $data->specializations_specialties);
        $query->bindParam(':dateentry', $data->dateentry_specialties);
        $query->bindParam(':cerrency', $data->currency_specialties);
        $query->bindParam(':resume_id', $id_resume);
        $result = $query->execute();

        if ($result) {
            // устанавливаем код ответа - 200 OK
            http_response_code(201);
            $res=[
                "status" => true,
                "message" => "Опыт работы добавлен"
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else {
            // установим код ответа - 503
            http_response_code(503);

            $res=[
                "status" => false,
                "message" => "Опыт работы не добавлен"
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}
