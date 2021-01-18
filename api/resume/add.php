<?php
require 'educations/add.php';
require 'specialties/add.php';

function AddResume($db)
{
    // получаем отправленные данные
    $data = json_decode(file_get_contents("php://input"));

    // создаем новое резюме
    $query = $db->prepare("INSERT INTO resume (firstname_resume, secondname_resume, status_resume, imgurl_resume,
                            phone_resume, email_resume, city_resume, birthday_resume, gender_resume, work_experience_resume,
                            profession_resume, education_level_resume, salary_resume, currency_resume, ability_resume, about_resume)
                            VALUES (:firstName, :secondName,:status, :imgUrl, :phone, :email, :city, :birthday, :gender,
                            :workExperience, :profession, :educationLevel, :salary, :currency, :ability, :about)");

    $query->bindParam(':firstName', $data->resume->firstname_resume);
    $query->bindParam(':secondName', $data->resume->secondname_resume);
    $query->bindParam(':status', $data->resume->status_resume);
    $query->bindParam(':imgUrl', $data->resume->imgurl_resume);
    $query->bindParam(':phone', $data->resume->phone_resume);
    $query->bindParam(':email', $data->resume->email_resume);
    $query->bindParam(':city', $data->resume->city_resume);
    $query->bindParam(':birthday', $data->resume->birthday_resume);
    $query->bindParam(':gender', $data->resume->gender_resume);
    $query->bindParam(':workExperience', $data->resume->work_experience_resume);
    $query->bindParam(':profession', $data->resume->profession_resume);
    $query->bindParam(':educationLevel', $data->resume->education_level_resume);
    $query->bindParam(':salary', $data->resume->salary_resume);
    $query->bindParam(':currency', $data->resume->currency_resume);
    $query->bindParam(':ability', $data->resume->ability_resume);
    $query->bindParam(':about', $data->resume->about_resume);

    $result = $query->execute();

    $id_resume = $db->lastInsertId();

    if ($result) {
        // устанавливаем код ответа - 200 OK
        http_response_code(201);
        $res=[
          "status" => true,
          "id" => $id_resume,
          "message" => "Резюме добавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);

        // добавляем к резюме блок опыт работы
        foreach ($data->specialties as $specialty) {
            AddSpecialties($db, $id_resume, $specialty);
        }
        // добавляем к резюме блок образования
        foreach ($data->educations as $education) {
            AddEducation($db, $id_resume, $education);
        }
    }
    else {
        // установим код ответа - 503
        http_response_code(503);

        $res=[
            "status" => false,
            "message" => "Резюме не добавлено"
        ];

        echo json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
