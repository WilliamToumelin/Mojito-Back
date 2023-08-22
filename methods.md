Dictionnaire de données
============================

## Category

|getter|setter|add|remove|
|-|-|-|-|
|getId()||||
|getName()|setName(string $name)|||
|getCocktails()|-|addCocktail(Cocktail $cocktail)|removeCocktail(Cocktail $cocktail)|


## Cocktail

|getter|setter|add|remove|
|-|-|-|-|
|getId()||||
|getName()|setName(string $name)|||
|getDescription()|setDescription(string $description)|-|-|
|getPicture()|setPicture(string $picture)|-|-|
|getDifficulty()|setDifficulty(string $difficulty)|-|-|
|isVisible()|setVisible(bool $visible)|-|-|
|getPreparationTime()|setPreparationTime(int $preparation_time)|-|-|
|getTrick()|setTrick(?string $trick)|-|-|
|isAlcool()|setAlcool(bool $alcool)|-|-|
|getSlug()|setSlug(string $slug)|-|-|
|getRating()|setRating(float $rating)|-|-|
|getMaterials()|-|addMaterial(Material $material)|removeMaterial(Material $material)|
|getSteps()|-|addStep(Step $step)|removeElement($step)|
|getCategories()|-|addCategory(Category $category)|removeCategory(Category $category)|
|getCocktailUses()|-|addCocktailUse(CocktailUse $cocktailUse)|removeCocktailUse(CocktailUse $cocktailUse)|
|getUser()|setUser(?User $user)|-|-|
|getComments()|-|addComment(Comment $comment)|removeComment(Comment $comment)|


## CocktailUse

|getter|setter|add|remove|
|-|-|-|-|
|getQuantity()|setQuantity(float $quantity)|-|-|
|getIngredient()|setIngredient(?Ingredient $ingredient)|-|-|
|getUnit()|setUnit(?Unit $unit)|-|-|
|getCocktail()|setCocktail(?Cocktail $cocktail)|-|-|


## Comment

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getContent()|setContent(string $content)|-|-|
|getRating()|setRating(int $rating)|-|-|
|getPostedAt()|setPostedAt(\DateTimeImmutable $posted_at)|-|-|
|getUser()|setUser(?User $user)|-|-|
|getCocktail()|setCocktail(?Cocktail $cocktail)|-|-|


## Ingredient

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getName()|setName(string $name)|-|-|
|getTypeingredient()|setTypeingredient(?TypeIngredient $typeingredient)|-|-|
|getCocktailUses()|-|addCocktailUse(CocktailUse $cocktailUse)|removeCocktailUse(CocktailUse $cocktailUse)|


## Material

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getName()|setName(string $name)|-|-|
|getTypematerial()|setTypematerial(?TypeMaterial $typematerial)|-|-|
|getCocktails()|-|addCocktail(Cocktail $cocktail)|removeCocktail(Cocktail $cocktail)|


## Step

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getNumberStep()|setNumberStep(int $number_step)|-|-|
|getContent()|setContent(string $content)|-|-|
|getCocktail()|setCocktail(?Cocktail $cocktail)|-|-|


## TypeIngredient

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getName()|setName(string $name)|-|-|
|getIngredients()|-|addIngredient(Ingredient $ingredient)|removeIngredient(Ingredient $ingredient)|


## TypeMaterial

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getName()|setName(string $name)|-|-|
|getMaterials()|-|addMaterial(Material $material)|removeMaterial(Material $material)|


## TypeMaterial

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getName()|setName(string $name)|-|-|
|getCocktailUses()|-|addCocktailUse(CocktailUse $cocktailUse)|removeCocktailUse(CocktailUse $cocktailUse)|


## User

|getter|setter|add|remove|
|-|-|-|-|
|getId()|-|-|-|
|getEmail()|setEmail(string $email)|-|-|
|getRoles()|setRoles(array $roles)|-|-|
|getPassword()|setPassword(string $password)|-|-|
|getFirstname()|setFirstname(?string $firstname)|-|-|
|getLastname()|setLastname(?string $lastname)|-|-|
|getPseudonym()|setPseudonym(string $pseudonym)|-|-|
|getDateOfBirth()|setDateOfBirth(\DateTimeImmutable $date_of_birth)|-|-|
|getCreatedAt()|setCreatedAt(\DateTimeImmutable $created_at)|-|-|
|getLastLogin()|setLastLogin(?\DateTimeImmutable $last_login)|-|-|
|isVerified()|setVerified(bool $verified)|-|-|
|getIpAdress()|setIpAdress(string $ip_adress)|-|-|
|getWarning()|setWarning(int $warning)|-|-|
|getPicture()|setPicture(?string $picture)|-|-|
|getCocktails()|-|addCocktail(Cocktail $cocktail)|removeCocktail(Cocktail $cocktail)|
|getComments()|-|addComment(Comment $comment)|removeComment(Comment $comment)|
