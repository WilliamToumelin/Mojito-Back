<?php

namespace App\DataFixtures\Provider;

class AppProvider
{
    private $user = [
        "admin" => [
            "email" => "williamM@gmail.com",
            "roles" => ["ROLE_ADMIN"],
            "password" => "williamM"
        ],
        "moderator" => [
            "email" => "celestinJ@gmail.com",
            "roles" => ["ROLE_MODERATOR"],
            "password" => "celestinJ"
        ],
        "user" => [
            "email" => "tommyD@gmail.com",
            "roles" => [],
            "password" => "tommyD"
        ]
    ];

  /**
   * Get a a user, available roles : admin, moderator, user
   * @param string $role the role of the user
   * @return array a user
   */
  public function user($role = null)
  {
    if ($role) {
      return $this->user[$role];
    }
    return $this->user[array_rand($this->user)];
  }
}