<?php

function UploadFile($db)
{
    if(isset($_FILES) && isset($_FILES['file'])) {
        //Переданный массив сохраняем в переменной
        $image = $_FILES['file'];

        // Проверяем размер файла и если он превышает заданный размер
        // завершаем выполнение скрипта и выводим ошибку
        if ($image['size'] > 2000000) {
            die('error');
        }

        // Достаем формат изображения
        $imageFormat = explode('.', $image['name']);
        $imageFormat = $imageFormat[1];

        // Генерируем новое имя для изображения. Можно сохранить и со старым
        // но это не рекомендуется делать
        $imageName = hash('crc32',time()) . '.' . $imageFormat;
        $imageFullName = 'C:\\Users\\twi9g\\Vue_project\\profile\\src\\assets\\' . $imageName;

        // Сохраняем тип изображения в переменную
        $imageType = $image['type'];

        // Сверяем доступные форматы изображений, если изображение соответствует,
        // копируем изображение в папку images
        if ($imageType == 'image/jpeg' || $imageType == 'image/png') {
            if (move_uploaded_file($image['tmp_name'],$imageFullName)) {
                http_response_code(200);
                $res=[
                    "status" => true,
                    "filename" => $imageName,
                    "message" => "Изображение загружено"
                ];
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
            } else {
                http_response_code(400);
                $res=[
                    "status" => true,
                    "message" => "Изображение не удалось загрузить"
                ];
                echo json_encode($res, JSON_UNESCAPED_UNICODE);
            }
        }
    }
}
