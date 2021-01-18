<?php

$first_position = true;
$query_str = "";

function EditResume($db, $id)
{
    // получаем отправленные данные
    $data = json_decode(file_get_contents("php://input"));

    global $first_position;
    global $query_str;

    $first_position = true;
    $query_str = "UPDATE resume SET";

    // формируем запрос к базе данных
    if (isset($data->resume->imgurl_resume))
        AddProperty("imgurl_resume", "url");
    if (isset($data->resume->status_resume))
        AddProperty("status_resume", "status");
    if (isset($data->resume->firstname_resume))
        AddProperty("firstname_resume", "firstName");
    if (isset($data->resume->secondname_resume))
        AddProperty("secondname_resume", "secondName");
    if (isset($data->resume->phone_resume))
        AddProperty("phone_resume", "phone");
    if (isset($data->resume->email_resume))
        AddProperty("email_resume", "email");
    if (isset($data->resume->city_resume))
        AddProperty("city_resume", "city");
    if (isset($data->resume->birthday_resume))
        AddProperty("birthday_resume", "birthday");
    if (isset($data->resume->gender_resume))
        AddProperty("gender_resume", "gender");
    if (isset($data->resume->work_experience_resume))
        AddProperty("work_experience_resume", "workExperience");
    if (isset($data->resume->profession_resume))
        AddProperty("profession_resume", "profession");
    if (isset($data->resume->education_level_resume))
        AddProperty("education_level_resume", "educationLevel");
    if (isset($data->resume->salary_resume))
        AddProperty("salary_resume", "salary");
    if (isset($data->resume->currency_resume))
        AddProperty("currency_resume", "currency");
    if (isset($data->resume->ability_resume))
        AddProperty("ability_resume", "ability");
    if (isset($data->resume->about_resume))
        AddProperty("about_resume", "about");

    if (!$first_position) {
        $query_str = $query_str . " WHERE id_resume = :id";

        // Готовим запрос
        $query = $db->prepare($query_str);

        // устанавливаем переменные
        if (isset($data->resume->status_resume))
            $query->bindParam(':status', $data->resume->status_resume);
        if (isset($data->resume->imgurl_resume))
            $query->bindParam(':url', $data->resume->imgurl_resume);
        if (isset($data->resume->firstname_resume))
            $query->bindParam(':firstName', $data->resume->firstname_resume);
        if (isset($data->resume->secondname_resume))
            $query->bindParam(':secondName', $data->resume->secondname_resume);
        if (isset($data->resume->phone_resume))
            $query->bindParam(':phone', $data->resume->phone_resume);
        if (isset($data->resume->email_resume))
            $query->bindParam(':email', $data->resume->email_resume);
        if (isset($data->resume->city_resume))
            $query->bindParam(':city', $data->resume->city_resume);
        if (isset($data->resume->birthday_resume))
            $query->bindParam(':birthday', $data->resume->birthday_resume);
        if (isset($data->resume->gender_resume))
            $query->bindParam(':gender', $data->resume->gender_resume);
        if (isset($data->resume->work_experience_resume))
            $query->bindParam(':workExperience', $data->resume->work_experience_resume);
        if (isset($data->resume->profession_resume))
            $query->bindParam(':profession', $data->resume->profession_resume);
        if (isset($data->resume->education_level_resume))
            $query->bindParam(':educationLevel', $data->resume->education_level_resume);
        if (isset($data->resume->salary_resume))
            $query->bindParam(':salary', $data->resume->salary_resume);
        if (isset($data->resume->currency_resume))
            $query->bindParam(':currency', $data->resume->currency_resume);
        if (isset($data->resume->ability_resume))
            $query->bindParam(':ability', $data->resume->ability_resume);
        if (isset($data->resume->about_resume))
            $query->bindParam(':about', $data->resume->about_resume);

        $query->bindParam(':id', $id);
        // выполняем запрос
        $result = $query->execute();

        //var_dump($query_str);
        if ($result) {
            // устанавливаем код ответа - 200 OK
            http_response_code(200);
            $res=[
                "status" => true,
                "message" => "Резюме изменено"
            ];

            echo json_encode($res);
        }
        else {
            // установим код ответа - 400
            http_response_code(400);

            $res=[
                "status" => false,
                "message" => "Резюме не изменено"
            ];

            echo json_encode($res, JSON_UNESCAPED_UNICODE);
        }
    }
}

function AddProperty($property, $param)
{
    global $first_position;
    global $query_str;

    if ($first_position) {
        $query_str = $query_str . " " . $property . " = :" . $param;
        $first_position = false;
    } else
        $query_str = $query_str . ", " . $property . " = :" . $param;
}
