<?php
class Specialty
{
    // свойства объекта
    public $position_specialties;
    public $salary_specialties;
    public $specializations_specialties;
    public $dateentry_specialties;
    public $currency_specialties;
    public $id_resume;

    /**
     * @return mixed
     */
    public function getIdResume()
    {
        return $this->id_resume;
    }

    /**
     * @param mixed $id_resume
     */
    public function setIdResume($id_resume)
    {
        $this->id_resume = $id_resume;
    }

    /**
     * @return mixed
     */
    public function getDateentrySpecialties()
    {
        return $this->dateentry_specialties;
    }

    /**
     * @param mixed $dateentry_specialties
     */
    public function setDateentrySpecialties($dateentry_specialties)
    {
        $this->dateentry_specialties = $dateentry_specialties;
    }

    /**
     * @return mixed
     */
    public function getPositionSpecialties()
    {
        return $this->position_specialties;
    }

    /**
     * @param mixed $position_specialties
     */
    public function setPositionSpecialties($position_specialties)
    {
        $this->position_specialties = $position_specialties;
    }

    /**
     * @return mixed
     */
    public function getSalarySpecialties()
    {
        return $this->salary_specialties;
    }

    /**
     * @param mixed $salary_specialties
     */
    public function setSalarySpecialties($salary_specialties)
    {
        $this->salary_specialties = $salary_specialties;
    }

    /**
     * @return mixed
     */
    public function getSpecializationsSpecialties()
    {
        return $this->specializations_specialties;
    }

    /**
     * @param mixed $specializations_specialties
     */
    public function setSpecializationsSpecialties($specializations_specialties)
    {
        $this->specializations_specialties = $specializations_specialties;
    }

    /**
     * @return mixed
     */
    public function getCurrencySpecialties()
    {
        return $this->currency_specialties;
    }

    /**
     * @param mixed $currency_specialties
     */
    public function setCurrencySpecialties($currency_specialties)
    {
        $this->currency_specialties = $currency_specialties;
    }
}
