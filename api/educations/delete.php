<?php
function DeleteEducation_byId($db, $id)
{
    $query = $db->prepare("DELETE FROM educations WHERE id_educations = :id");
    $query->bindParam(':id', $id);
    $result = $query->execute();
    if ($result) {
        // устанавливаем код ответа - 200 OK
        http_response_code(200);
        $res=[
            "status" => true,
            "message" => "Образование удалено"
        ];

        echo json_encode($res);
    }
    else {
        // установим код ответа - 400
        http_response_code(400);

        $res=[
            "status" => false,
            "message" => "Образование не удалось удалить"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
