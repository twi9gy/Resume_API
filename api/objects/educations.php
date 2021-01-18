<?php
class Education
{
    // свойства объекта
    public $id_educations;
    public $level_educations;
    public $institution_educations;
    public $faculty_educations;
    public $specialization_educations;
    public $yearend_educations;
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
    public function getSpecializationEducations()
    {
        return $this->specialization_educations;
    }

    /**
     * @param mixed $specialization_educations
     */
    public function setSpecializationEducations($specialization_educations)
    {
        $this->specialization_educations = $specialization_educations;
    }

    /**
     * @return mixed
     */
    public function getLevelEducations()
    {
        return $this->level_educations;
    }

    /**
     * @param mixed $level_educations
     */
    public function setLevelEducations($level_educations)
    {
        $this->level_educations = $level_educations;
    }

    /**
     * @return mixed
     */
    public function getInstitutionEducations()
    {
        return $this->institution_educations;
    }

    /**
     * @param mixed $institution_educations
     */
    public function setInstitutionEducations($institution_educations)
    {
        $this->institution_educations = $institution_educations;
    }

    /**
     * @return mixed
     */
    public function getFacultyEducations()
    {
        return $this->faculty_educations;
    }

    /**
     * @param mixed $yearend_educations
     */
    public function setYearendEducations($yearend_educations)
    {
        $this->yearend_educations = $yearend_educations;
    }

    /**
     * @return mixed
     */
    public function getYearendEducations()
    {
        return $this->yearend_educations;
    }

    /**
     * @param mixed $faculty_educations
     */
    public function setFacultyEducations($faculty_educations)
    {
        $this->faculty_educations = $faculty_educations;
    }

    /**
     * @return mixed
     */
    public function getIdEducations()
    {
        return $this->id_educations;
    }

    /**
     * @param mixed $id_educations
     */
    public function setIdEducations($id_educations)
    {
        $this->id_educations = $id_educations;
    }
}
