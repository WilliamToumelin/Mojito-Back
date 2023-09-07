<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230904140835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, glass_id INT NOT NULL, ice_id INT NOT NULL, technical_id INT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, picture LONGTEXT NOT NULL, difficulty INT NOT NULL, visible TINYINT(1) NOT NULL, preparation_time INT NOT NULL, trick LONGTEXT DEFAULT NULL, alcool TINYINT(1) NOT NULL, slug VARCHAR(255) NOT NULL, rating DOUBLE PRECISION NOT NULL, INDEX IDX_7B4914D4A76ED395 (user_id), INDEX IDX_7B4914D46E4A05EA (glass_id), INDEX IDX_7B4914D4D553E9BF (ice_id), INDEX IDX_7B4914D4B9FC167E (technical_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_category (cocktail_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_29E0BEEDCD6F76C6 (cocktail_id), INDEX IDX_29E0BEED12469DE2 (category_id), PRIMARY KEY(cocktail_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cocktail_use (ingredient_id INT NOT NULL, unit_id INT NOT NULL, cocktail_id INT NOT NULL, quantity DOUBLE PRECISION NOT NULL, INDEX IDX_8DAFAC2B933FE08C (ingredient_id), INDEX IDX_8DAFAC2BF8BD700D (unit_id), INDEX IDX_8DAFAC2BCD6F76C6 (cocktail_id), PRIMARY KEY(ingredient_id, unit_id, cocktail_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cocktail_id INT NOT NULL, content LONGTEXT NOT NULL, posted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526CA76ED395 (user_id), INDEX IDX_9474526CCD6F76C6 (cocktail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE glass (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ice (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, typeingredient_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_6BAF78704E273820 (typeingredient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, cocktail_id INT NOT NULL, user_id INT NOT NULL, rating INT NOT NULL, INDEX IDX_D8892622CD6F76C6 (cocktail_id), INDEX IDX_D8892622A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, cocktail_id INT NOT NULL, number_step INT NOT NULL, content LONGTEXT NOT NULL, INDEX IDX_43B9FE3CCD6F76C6 (cocktail_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE technical (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_ingredient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE unit (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(100) DEFAULT NULL, lastname VARCHAR(100) DEFAULT NULL, pseudonym VARCHAR(100) NOT NULL, date_of_birth DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_login DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', verified TINYINT(1) DEFAULT 0 NOT NULL, warning INT DEFAULT 0 NOT NULL, picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D6493654B190 (pseudonym), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D4A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D46E4A05EA FOREIGN KEY (glass_id) REFERENCES glass (id)');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D4D553E9BF FOREIGN KEY (ice_id) REFERENCES ice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktail ADD CONSTRAINT FK_7B4914D4B9FC167E FOREIGN KEY (technical_id) REFERENCES technical (id)');
        $this->addSql('ALTER TABLE cocktail_category ADD CONSTRAINT FK_29E0BEEDCD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktail_category ADD CONSTRAINT FK_29E0BEED12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktail_use ADD CONSTRAINT FK_8DAFAC2B933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id)');
        $this->addSql('ALTER TABLE cocktail_use ADD CONSTRAINT FK_8DAFAC2BF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id)');
        $this->addSql('ALTER TABLE cocktail_use ADD CONSTRAINT FK_8DAFAC2BCD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CCD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id)');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF78704E273820 FOREIGN KEY (typeingredient_id) REFERENCES type_ingredient (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622CD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id)');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3CCD6F76C6 FOREIGN KEY (cocktail_id) REFERENCES cocktail (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cocktail DROP FOREIGN KEY FK_7B4914D4A76ED395');
        $this->addSql('ALTER TABLE cocktail DROP FOREIGN KEY FK_7B4914D46E4A05EA');
        $this->addSql('ALTER TABLE cocktail DROP FOREIGN KEY FK_7B4914D4D553E9BF');
        $this->addSql('ALTER TABLE cocktail DROP FOREIGN KEY FK_7B4914D4B9FC167E');
        $this->addSql('ALTER TABLE cocktail_category DROP FOREIGN KEY FK_29E0BEEDCD6F76C6');
        $this->addSql('ALTER TABLE cocktail_category DROP FOREIGN KEY FK_29E0BEED12469DE2');
        $this->addSql('ALTER TABLE cocktail_use DROP FOREIGN KEY FK_8DAFAC2B933FE08C');
        $this->addSql('ALTER TABLE cocktail_use DROP FOREIGN KEY FK_8DAFAC2BF8BD700D');
        $this->addSql('ALTER TABLE cocktail_use DROP FOREIGN KEY FK_8DAFAC2BCD6F76C6');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CCD6F76C6');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF78704E273820');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622CD6F76C6');
        $this->addSql('ALTER TABLE rating DROP FOREIGN KEY FK_D8892622A76ED395');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3CCD6F76C6');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE cocktail');
        $this->addSql('DROP TABLE cocktail_category');
        $this->addSql('DROP TABLE cocktail_use');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE glass');
        $this->addSql('DROP TABLE ice');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE technical');
        $this->addSql('DROP TABLE type_ingredient');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE `user`');
    }
}
