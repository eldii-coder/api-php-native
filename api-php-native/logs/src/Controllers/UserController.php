<?php

namespace Src\Controllers;

class UserController
{
    public function index()
    {
        $users = [
            ["id" => 1, "name" => "Admin"],
            ["id" => 2, "name" => "Novi"]
        ];

        echo json_encode([
            "success" => true,
            "data" => $users
        ]);
    }

    public function show()
    {
        $user = ["id" => 1, "name" => "User 1"];

        echo json_encode([
            "success" => true,
            "data" => $user
        ]);
    }
}
