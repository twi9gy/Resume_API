<?php
require 'educations/get.php';
require 'specialties/get.php';

function getResume_byId($db, $id)
{
    // запрашиваем резюме
    $query = $db->prepare("SELECT * FROM resume WHERE id_resume = :id");
    $query->bindParam(':id', $id);
    $query->setFetchMode(PDO::FETCH_CLASS, 'Resume');
    $result = $query->execute();
    $data = $query->fetchAll();

    // проверка, найдено ли резюме
    if ($data[0]->id_resume > 0) {
        // устанавливаем код ответа - 200 OK
        http_response_code(200);

        $educations = getEducation_byResumeId($db, $data[0]->id_resume);
        $specialties = getSpecialties_byResumeId($db, $data[0]->id_resume);

        $res=[
          "resume" => $data[0],
          "specialties" => $specialties,
          "educations" => $educations
        ];

        // выводим данные о товаре в формате JSON
        echo json_encode($res, JSON_UNESCAPED_UNICODE);
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
