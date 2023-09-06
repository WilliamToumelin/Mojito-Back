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
    "admin1" => [
      "email" => "celestinJ@gmail.com",
      "roles" => ["ROLE_ADMIN"],
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

  private $categories = [
    'Gin',
    'Whisky',
    'Rhum',
    'Tequila',
    'Vodka',
    'Brandy',
    'Champagne',
    'vin',
    'Sans alcool',
    'Triple Sec',
    'Bière',
    'Cognac',
    'Pastis',
  ];

  private $ingredients = [
    'Sugar',
    'Lemon juice',
    'Gin',
    'Vodka',
    'Aromatic bitters',
    'Cognac',
    'Orange',
    'Pineapple juice',
    'Egg white',
    'Soda water',
    'Grapefruit juice', 
    'Apple juice',
    'Cranberry juice',
    'Apricot',
    'Ginger',
    'Tonic water',
    'Raspberries',
    'Vanilla',
    'Milk',
    'Melon'
    ];

    private $cocktails = [
      "cocktail1" => [
        "name" => "Ancient Mariner",
        "image" => "https://www.liquor.com/thmb/URg2VhGmAY2OODDUeyf6eZq5CD8=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/ancient-mariner-720x720-primary-c3d0dc150eef4d9ea29b1fb2ef314e40.jpg",
      ],
      "cocktail2" => [
        "name" => "Airmail",
        "image" => "https://www.liquor.com/thmb/hLtvn5Bvze1ckFTDOysJAyG3Yrc=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Airmail-Punch-720x720-primary-e206b94c9cf44b3f87157395d8c24ef1.jpg",
      ],
      "cocktail3" => [
        "name" => "Bacardi",
        "image" => "https://www.liquor.com/thmb/vnEbdBpRP1ZxIHeMwXarW0NPa5Y=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/__opt__aboutcom__coeus__resources__content_migration__liquor__2017__11__14145228__bacardi-cocktail-720x720-recipe-77d6a74767654d449b9d6fecc00f39f0.jpg",
      ],
      "cocktail4" => [
        "name" => "Sangria",
        "image" => "https://www.liquor.com/thmb/m5goQtbCpgDt0-kJe4I0lqjroIY=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/sangria-1500x1500-hero-3de44be51d84439ca3d1ce22fcdb995f.jpg",
      ],
      "cocktail5" => [
        "name" => "Harvey Wallbanger",
        "image" => "https://www.liquor.com/thmb/OD4blq_mvOFdlLdCed76RsfoBmo=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/harvey-wallbanger-720x720-primary-8b1855f846484855913ad6280459c1da.jpg",
      ],
      "cocktail6" => [
        "name" => "Golden Cadillac",
        "image" => "https://www.liquor.com/thmb/4BK4FKdo0BpHYx4SV3_Ver6r5ns=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/golden-cadillac-720x720-primary-6757a5d530fb4b2492bd02c50667e40a.jpg",
      ],
      "cocktail7" => [
        "name" => "Blue Hawaii",
        "image" => "https://www.liquor.com/thmb/DJMfBLhTugR59z7nifQInKsd8Xw=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/__opt__aboutcom__coeus__resources__content_migration__liquor__2019__07__12101312__Blue-Hawaii-720x720-recipe-1c521445b9394786abe8215118baf734.jpg",
      ],
      "cocktail8" => [
        "name" => "Blue Hawaiian",
        "image" => "https://www.liquor.com/thmb/Na1xU5BzDQSwvJZzpJn8ibtJ0HE=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/__opt__aboutcom__coeus__resources__content_migration__liquor__2019__05__01120413__blue-hawaiian-720x720-recipe-50e8ba44935a4fc4a874d1b0e27b8b30.jpg",
      ],
      "cocktail9" => [
        "name" => "Bumbo",
        "image" => "https://www.liquor.com/thmb/D6Ca4oL1SSMG9zQzZ1PyN5EXZMI=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/bushwaker-720x720-primary-f9af9059141b435d88ee0c4ae88f7e06.jpg",
      ],
      "cocktail10" => [
        "name" => "Bushwacker",
        "image" => "https://www.liquor.com/thmb/D6Ca4oL1SSMG9zQzZ1PyN5EXZMI=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/bushwaker-720x720-primary-f9af9059141b435d88ee0c4ae88f7e06.jpg",
      ],
      "cocktail11" => [
        "name" => "Dorado Old Fashioned",
        "image" => "https://www.liquor.com/thmb/ECx_MjNNQO6wp3-IYggwqeZ1yt4=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/dorado-old-fashioned-720x720-primary-c14e358610664b93995e1352d6f8378e.jpg",
      ],
      "cocktail12" => [
        "name" => "Cherry Revolution",
        "image" => "https://www.liquor.com/thmb/4jHp2x3702ll16VGFsQzIx6O9Kc=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Cherry-Revolution-720x720-primary-bacff2e6861542c8a97ce1687fe8144a.jpg",
      ],
      "cocktail13" => [
        "name" => "Landmaster",
        "image" => "https://www.liquor.com/thmb/44B2zCBnyTIi-2dpCc_Sy6R8D3g=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Landmaster-720x720-primary-5bd8194d3dbc4e71a51f89c6ca3b7ec6.jpg",
      ],
      "cocktail14" => [
        "name" => "Daiquiri",
        "image" => "https://www.liquor.com/thmb/aLlM1JQiNiu0o2Mwx2n2AfOgoyw=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Daiquiri_3000x3000_primary-206eb2330cb04852ab7d780dcf3d55ef.jpg",
      ],
      "cocktail15" => [
        "name" => "Dark and stormy",
        "image" => "https://www.liquor.com/thmb/yLOY2mTfVURRLncmwG3FTQ3q5Nc=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/dark-n-stormy-720x720-primary-f0b2a3adf8064575b375e56d1a822b4e.jpg",
      ],
      "cocktail16" => [
        "name" => "El Presidente",
        "image" => "https://www.liquor.com/thmb/0EJHJZMVks1SfLWzAxdPDg7coy0=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/el-presidente-720x720-primary-45dfe9fd8e4c43ee942bf861af9b645f.jpg",
      ],
      "cocktail16" => [
        "name" => "Fish house punch",
        "image" => "https://www.liquor.com/thmb/H5kgyWuOn0SopfyCuNTA8z2CuUI=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/fish-house-punch-720x720-primary-5d682aee64f14eea8569227b55af20f7.jpg",
      ],
      "cocktail17" => [
        "name" => "Portobello Rum Punch",
        "image" => "https://www.liquor.com/thmb/ZimbFpaZ7d-uP395433fHSRpMKQ=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/portabello-rum-punch-720x720-primary-2baf8261ebf14841a0f0a3ed2db506c5.jpg",
      ],
      "cocktail18" => [
        "name" => "Hurricane",
        "image" => "https://www.liquor.com/thmb/t4unQHZC2WbR4Z06EQPj47j8d28=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/hurricane-720x720-primary-e5b3f57f86904ad39f87c96b1b0e0d1e.jpg",
      ],
      "cocktail19" => [
        "name" => "Mary Pickford",
        "image" => "https://www.liquor.com/thmb/Qa9p2NzR2wDtYvrRa5qbt3590Dc=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/mary-pickford-720x720-primary-d3a86684af4b42bfb7c90074135aec24.jpg",
      ],
      "cocktail20" => [
        "name" => "Mojito",
        "image" => "https://www.liquor.com/thmb/d8ISqwKZVgLgrMsMbHGmRAuhSuc=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/mojito-720x720-primary-6a57f80e200c412e9a77a1687f312ff7.jpg",
      ],
      "cocktail21" => [
        "name" => "El Fili Daiquiri",
        "image" => "https://www.liquor.com/thmb/D1wrZA929L_13mk2UewDUsejYro=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Gugu-Room-El-Fili-Daiquiri-by-KK-Chote_MST-Creative-PR_main_720x720-38d3bd88270f4598af47618eddb5b30a.jpg",
      ],
      "cocktail22" => [
        "name" => "Painkiller",
        "image" => "https://www.liquor.com/thmb/YlMWVvySEk0rkpeHB-DP_nZYH0w=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/painkiller-1500x1500-hero-b55802983b9545f28510e8af5101604d.jpg",
      ],
      "cocktail23" => [
        "name" => "Piña colada",
        "image" => "https://www.liquor.com/thmb/lwEhLZZ4d8qwjZ544JcjBuQsF5E=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Frozen-Pina-Colada-1500x1500-hero-aac506d60d9647f78171bbe4ddc126ed.jpg",
      ],
      "cocktail24" => [
        "name" => "punch",
        "image" => "https://www.liquor.com/thmb/3a5YmGF8FnxmLWL1JP7SV-5UYDY=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/__opt__aboutcom__coeus__resources__content_migration__liquor__2018__12__07094804__A-Bartender-Put-Milk-Punch-in-a-Bottle-So-Everyone-Could-Try-It-720x720-article-1b128dab38084c8ab508997a9d0d39c4.jpg",
      ],
      "cocktail25" => [
        "name" => "Angostura Colada",
        "image" => "https://www.liquor.com/thmb/llxaLlxd65hu5xF4jbsvVyD8VJs=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/angostura-colada-720x720-primary-3484b3c7188540aaa1ee158d0184f893.jpg",
      ],
      "cocktail26" => [
        "name" => "Test Pilot",
        "image" => "https://www.liquor.com/thmb/D6g9V6hag4nwbBu6zmdetBy26y8=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/test-pilot-720x720-primary-175f17b7ef6d45c8a0161b120f94c526.jpg",
      ],
      "cocktail27" => [
        "name" => "Rum and Coke",
        "image" => "https://www.liquor.com/thmb/b20Qf79ZiNJz2fG6eJUAT4moBIM=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/rum-and-coke-720x720-primary-2d25470536c54528a8a02126fcec9989.jpg",
      ],
      "cocktail28" => [
        "name" => "Queens Park Swizzle",
        "image" => "https://www.liquor.com/thmb/v0ZvblyUtpj_sfsTEkCbJl8mex8=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/queens-park-swizzle-720x720-primary-4a0d77fb77a04e668e13e554d0b076dd.jpg",
      ],
      "cocktail29" => [
        "name" => "Ube Colada",
        "image" => "https://www.liquor.com/thmb/yoxak9E183XuCM96HCua-hpI0q0=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/Ube-Colada-Ben-Rojo_main_720x720-202e91084aa548379574558de14fa176.jpg",
      ],
      "cocktail30" => [
        "name" => "Gibson",
        "image" => "https://www.liquor.com/thmb/f7c2GG-ptWN--lPcwrLHinFSZD4=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/gibson-1500x1500-hero-98170c85487241a1b768368039b4ea97.jpg",
      ],
  ];

  private $units = [
    'oz',
    'cl',
    'shot',
    'c. à table',
    'c. à café',
    'tasse',
    'cuillière',
    'trait',
    'splash',
    'pincée',
    'partie'
  ];

  private $typesingredients = [
    'alcools',
    'softs',
    'aromates',
  ];

  private $technicals = [
    'au shaker',
    'à la cuillère',
    'en assemblage'
  ];

  /**
   * get a random technical name from the provider
   * @return string random technical name
   */
  public function technical(): string
  {
    return $this->technicals[array_rand($this->technicals)];
  }


   /**
   * get a random typeIngredient name from the provider
   * @return string random TypeIngredient name
   */
  public function typeIngredient(): string
  {
    return $this->typesingredients[array_rand($this->typesingredients)];
  }

  /**
   * get a random unit name from the provider
   * @return string random unit name
   */
  public function unit(): string
  {
    return $this->units[array_rand($this->units)];
  }

   /**
   * get a random cocktail name and image from the provider
   * @return string random cocktail name and image
   */
  public function cocktail(): array
  {
    return $this->cocktails[array_rand($this->cocktails)];
  }

  /**
   * get a random ingredient name from the provider
   * @return string random ingredient name
   */
  public function ingredient(): string
  {
    return $this->ingredients[array_rand($this->ingredients)];
  }

  /**
   * get a random category name from the provider
   * @return string random category name
   */
  public function category(): string
  {
    return $this->categories[array_rand($this->categories)];
  }

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
