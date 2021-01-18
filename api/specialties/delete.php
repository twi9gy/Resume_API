<?php
function DeleteSpecialty_byId($db, $id)
{
    $query = $db->prepare("DELETE FROM specialties WHERE id_specialties = :id");
    $query->bindParam(':id', $id);
    $result = $query->execute();
    if ($result) {
        // устанавливаем код ответа - 200 OK
        http_response_code(200);
        $res=[
            "status" => true,
            "message" => "Место работы удалено"
        ];

        echo json_encode($res);
    }
    else {
        // установим код ответа - 400
        http_response_code(400);

        $res=[
            "status" => false,
            "message" => "Место работы не удалось удалить"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
