<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231121104928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url_page LONGTEXT NOT NULL, url_image VARCHAR(255) DEFAULT NULL, summary LONGTEXT NOT NULL, source VARCHAR(255) NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crypto_currency (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, current_price NUMERIC(10, 2) DEFAULT NULL, opening_price NUMERIC(10, 2) DEFAULT NULL, lowest_price_day NUMERIC(10, 2) DEFAULT NULL, highest_price_day NUMERIC(10, 2) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE crypto_currency_user_preference (crypto_currency_id INT NOT NULL, user_preference_id INT NOT NULL, INDEX IDX_42E0393419932572 (crypto_currency_id), INDEX IDX_42E03934369E8F90 (user_preference_id), PRIMARY KEY(crypto_currency_id, user_preference_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keyword (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, uri VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keyword_user_preference (keyword_id INT NOT NULL, user_preference_id INT NOT NULL, INDEX IDX_39C4594B115D4552 (keyword_id), INDEX IDX_39C4594B369E8F90 (user_preference_id), PRIMARY KEY(keyword_id, user_preference_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_preference (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, currency VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_FA0E76BFA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE crypto_currency_user_preference ADD CONSTRAINT FK_42E0393419932572 FOREIGN KEY (crypto_currency_id) REFERENCES crypto_currency (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE crypto_currency_user_preference ADD CONSTRAINT FK_42E03934369E8F90 FOREIGN KEY (user_preference_id) REFERENCES user_preference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE keyword_user_preference ADD CONSTRAINT FK_39C4594B115D4552 FOREIGN KEY (keyword_id) REFERENCES keyword (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE keyword_user_preference ADD CONSTRAINT FK_39C4594B369E8F90 FOREIGN KEY (user_preference_id) REFERENCES user_preference (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_preference ADD CONSTRAINT FK_FA0E76BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE TABLE flux_rss (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, site VARCHAR(255) NOT NULL, topique VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, langue VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE crypto_currency_user_preference DROP FOREIGN KEY FK_42E0393419932572');
        $this->addSql('ALTER TABLE crypto_currency_user_preference DROP FOREIGN KEY FK_42E03934369E8F90');
        $this->addSql('ALTER TABLE keyword_user_preference DROP FOREIGN KEY FK_39C4594B115D4552');
        $this->addSql('ALTER TABLE keyword_user_preference DROP FOREIGN KEY FK_39C4594B369E8F90');
        $this->addSql('ALTER TABLE user_preference DROP FOREIGN KEY FK_FA0E76BFA76ED395');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE crypto_currency');
        $this->addSql('DROP TABLE crypto_currency_user_preference');
        $this->addSql('DROP TABLE keyword');
        $this->addSql('DROP TABLE keyword_user_preference');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_preference');
        $this->addSql('DROP TABLE flux_rss');
    }
}
