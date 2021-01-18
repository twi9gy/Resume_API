<?php
function getResumes($db)
{
    // запрашиваем резюме
    $query = $db->prepare("SELECT * FROM resume");
    $query->setFetchMode(PDO::FETCH_CLASS, 'Resume');
    $result = $query->execute();
    $data = $query->fetchAll();

    // проверка, найдено ли хотя бы одно резюме
    if (count($data) > 0) {
        // устанавливаем код ответа - 200 OK
        http_response_code(200);

        // выводим данные о товаре в формате JSON
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
    else {
        // установим код ответа - 404 Не найдено
        http_response_code(404);

        $res=[
            "status" => false,
            "message" => "Резюме не найдено"
        ];

        // сообщаем пользователю, что товары не найдены
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
