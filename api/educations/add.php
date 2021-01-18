<?php
function AddEducation($db, $id_resume, $data)
{
    if ($data->level_educations !== "") {
        $query = $db->prepare("INSERT INTO educations (level_educations, institution_educations, faculty_educations,
                            specialization_educations, \"yearend_educations\", id_resume)
                            VALUES (:level_e, :institution, :faculty, :specialization, :yearend, :resume_id)");
        $query->bindParam(':level_e', $data->level_educations);
        $query->bindParam(':institution', $data->institution_educations);
        $query->bindParam(':faculty', $data->faculty_educations);
        $query->bindParam(':specialization', $data->specialization_educations);
        $query->bindParam(':yearend', $data->yearend_educations);
        $query->bindParam(':resume_id', $id_resume);
        $result = $query->execute();

        if ($result) {
            // устанавливаем код ответа - 200 OK
            http_response_code(201);
            $res=[
                "status" => true,
                "message" => "Образование добавлено"
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
        else {
            // установим код ответа - 503
            http_response_code(503);

            $res=[
                "status" => false,
                "message" => "Образование не добавлено"
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}
