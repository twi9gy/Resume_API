<?php
function getEducation_byResumeId($db, $id)
{
    // запрашиваем блоки образования
    $query = $db->prepare("SELECT id_educations, level_educations, institution_educations, faculty_educations,
                            specialization_educations, yearend_educations FROM educations WHERE id_resume = :id");
    $query->bindParam(':id', $id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $result = $query->execute();
    $data = $query->fetchAll();

    return $data;
}

