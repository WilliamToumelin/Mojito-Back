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
    ],
    
    "user1" => [
      "email" => "user1@gmail.com",
      "roles" => [],
      "password" => "user1"
    ],
    "user2" => [
      "email" => "user2@gmail.com",
      "roles" => [],
      "password" => "user2"
    ],
    "user3" => [
      "email" => "user3@gmail.com",
      "roles" => [],
      "password" => "user3"
    ],
    "user4" => [
      "email" => "user4@gmail.com",
      "roles" => [],
      "password" => "user4"
    ],
    "user5" => [
      "email" => "user5@gmail.com",
      "roles" => [],
      "password" => "user5"
    ],
    "user6" => [
      "email" => "user6@gmail.com",
      "roles" => [],
      "password" => "user6"
    ],

    "user7" => [
      "email" => "user7@gmail.com",
      "roles" => [],
      "password" => "user7"
    ],

    "user8" => [
      "email" => "user8@gmail.com",
      "roles" => [],
      "password" => "user8"
    ],
    "user9" => [
      "email" => "user9@gmail.com",
      "roles" => [],
      "password" => "user9"
    ],
    "user10" => [
      "email" => "user10@gmail.com",
      "roles" => [],
      "password" => "user10"
    ],
    "user11" => [
      "email" => "user11@gmail.com",
      "roles" => [],
      "password" => "user11"
    ],
    "user12" => [
      "email" => "user12@gmail.com",
      "roles" => [],
      "password" => "user12"
    ],
    "user13" => [
      "email" => "user13@gmail.com",
      "roles" => [],
      "password" => "user13"
    ],
    "user14" => [
      "email" => "user14@gmail.com",
      "roles" => [],
      "password" => "user14"
    ],
    "user15" => [
      "email" => "user15@gmail.com",
      "roles" => [],
      "password" => "user15"
    ],
    "user16" => [
      "email" => "user16@gmail.com",
      "roles" => [],
      "password" => "user16"
    ],
    "user17" => [
            "email" => "user17@gmail.com",
            "roles" => [],
            "password" => "user17"
    ],
    "user18" => [
            "email" => "user18@gmail.com",
            "roles" => [],
            "password" => "user18"
    ],
    "user19" => [
            "email" => "user19@gmail.com",
            "roles" => [],
            "password" => "user19"
        ],
    "user20" => [
        "email" => "user20@gmail.com",
        "roles" => [],
        "password" => "user20"
    ],
    
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
