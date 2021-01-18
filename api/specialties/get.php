<?php

function getSpecialties_byResumeId($db, $id)
{
    // запрашиваем блоки образования
    $query = $db->prepare("SELECT id_specialties, position_specialties, salary_specialties, specializations_specialties,
                            dateentry_specialties, currency_specialties FROM specialties WHERE id_resume = :id");
    $query->bindParam(':id', $id);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $result = $query->execute();
    $data = $query->fetchAll();

    return $data;
}

