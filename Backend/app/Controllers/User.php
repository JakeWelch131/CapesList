<?php

namespace App\Controllers;

use App\Models\Users;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


function validateUserLogin($postedLogin, $storedLogin) {
    //Cleansing the posted data
    $escUser = esc($postedLogin['email']);
    $escPassword = esc($postedLogin['password']);

    //Now check if they are equal
    // if ($escUser != $storedLogin['email']) {
    //     //Now check if passwords are equal
    //     if ($escPassword != $storedLogin['password']) {
    //         return false;    //Logins match
    //     }

    //     return false;
    // } 

    if ($escUser == $storedLogin['email']) {
        return true;
    }

    //Login credentials do not match
    return false;
}


class User extends ResourceController {

    use ResponseTrait;

    private string $table = 'user';
    

    public function createUser() {

    }

    public function deleteUser() {

    }

    public function updateUser() {

    }

    public function retrieveUser() {
        //Loads in the user credential validator
        //helper('UserLogin');
        
        //Cleanse the data to prevent injection
        //$cleansedData = cleansePostData($_POST, '');

        //TESTING
        $givenLogin = ['email'=>'test@test.com', 'password'=>'1234'];

        //Now create model and retrieve user credentials
        $storedLogin = [];

        $model = new Users();
        $storedLogin['password'] = $model -> getPassword($givenLogin['email']);  //Grabs password based on email

        $storedLogin['email'] = $givenLogin['email']; 

        $response = [
            validateUserLogin($givenLogin, $storedLogin),
            'Stored Username' => $storedLogin['email'],
            'Stored Password' => $storedLogin['password'],
            'GIVEN Username' => $givenLogin['email'],
            'GIVEN Password' => $givenLogin['password']
        ];

       return $this->respond(
            $response
       );


    }

    

}



?>