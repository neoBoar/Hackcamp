<?php


class staffData
{
    protected $_employeeID, $_name, $_email, $_password, $_jobRole;

    public function __construct($dbrow) {
        $this->_employeeID=$dbrow['employeeID'];
        $this->_name=$dbrow['name'];
        $this->_email=$dbrow['email'];
        $this->_password=$dbrow['password'];
        $this->_jobRole=$dbrow['jobRole'];
    }

    /**
     * @return mixed
     */
    public function getEmployeeID()
    {
        return $this->_employeeID;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return mixed
     */
    public function getJobRole()
    {
        return $this->_jobRole;
    }

}