<?php

function UpdateStatus($db, $id)
{
    // получаем отправленные данные
    $data = json_decode(file_get_contents("php://input"));

    $status_resume = $data->status_resume;

    // создаем новое резюме
    $query = $db->prepare("UPDATE resume SET status_resume = :status WHERE id_resume = :id");
    $query->bindParam(':status', $status_resume);
    $query->bindParam(':id', $id);
    $result = $query->execute();

    // проверка, найдено ли резюме
    if ($result) {
        // устанавливаем код ответа - 200 OK
        http_response_code(200);
        $res=[
            "status" => true,
            "message" => "Статус изменен"
        ];
        // выводим данные о товаре в формате JSON
        echo json_encode($res,JSON_UNESCAPED_UNICODE);
    }
    else {
        // установим код ответа - 503
        http_response_code(503);

        $res=[
            "status" => false,
            "message" => "Статус не изменен"
        ];

        // сообщаем пользователю, что товары не найдены
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
