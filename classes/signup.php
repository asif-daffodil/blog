<?php

namespace classes\signup;

include_once "./classes/db.php";

use classes\db\db as db;


class signup extends db
{
    private string $uname;
    private string $uemail;
    private string $gender;
    private string $password;
    private string $dob;
    public string $unameErrMsg, $uemailErrMsg, $genderErrMsg, $dobErrMsg, $passwordErrMsg;

    private function validateUname($uname): bool
    {
        if (empty($uname)) {
            $this->unameErrMsg = "Please enter your name";
            return false;
        } elseif (!preg_match("/^[A-Za-z. ]*$/", $uname)) {
            $this->unameErrMsg = "Please enter a valid name";
            return false;
        } else {
            $this->unameErrMsg = "";
            return true;
        }
    }

    private function validateUemail($uemail): bool
    {
        if (empty($uemail)) {
            $this->uemailErrMsg = "Please enter your email";
            return false;
        } elseif (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
            $this->uemailErrMsg = "Please enter a valid email";
            return false;
        } else {
            // check if email already exists
            $sql = "SELECT email FROM users WHERE email =?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $uemail);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $this->uemailErrMsg = "Email already exists";
                return false;
            } else {
                $this->uemailErrMsg = "";
                return true;
            }
        }
    }

    public function validateGender($gender): bool
    {
        if (empty($gender)) {
            $this->genderErrMsg = "Please select your gender";
            return false;
        } else {
            $this->genderErrMsg = "";
            return true;
        }
    }

    public function validateDate($dob): bool
    {
        if (empty($dob)) {
            $this->dobErrMsg = "Please enter your date of birth";
            return false;
        } else {
            $this->dobErrMsg = "";
            return true;
        }
    }

    public function validatePassword($password): bool
    {
        if (empty($password)) {
            $this->passwordErrMsg = "Please enter your password";
            return false;
        } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&#]{8,}$/", $password)) {
            $this->passwordErrMsg = "Please provide a strong password";
            return false;
        } else {
            $this->passwordErrMsg = "";
            return true;
        }
    }

    public function signup($uname, $uemail, $gender, $password, $dob): void
    {
        $this->uname = $this->conn->real_escape_string($uname);
        $this->uemail = $this->conn->real_escape_string($uemail);
        $this->gender = $this->conn->real_escape_string($gender);
        $this->password = $this->conn->real_escape_string($password);
        $this->dob = $this->conn->real_escape_string($dob);
        if ($this->validateUname($uname) && $this->validateUemail($uemail) && $this->validateGender($gender) && $this->validateDate($dob) && $this->validatePassword($password)) {
            $this->password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, email, gender, password, dob) VALUES ('$this->uname', '$this->uemail', '$this->gender', '$this->password', '$this->dob')";
            $result = mysqli_query($this->conn, $sql);
            if ($result) {
                // toastr success position bottom
                echo "<script>toastr.success('Signup successful'); setTimeout(()=>{location.href='signin.php'}, 2000)</script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            }
        }
    }
}
