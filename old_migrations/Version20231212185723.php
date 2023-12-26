<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231212185723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment CHANGE comment comment LONGTEXT DEFAULT NULL, CHANGE rate rate INT DEFAULT NULL');
        $this->addSql('ALTER TABLE episode CHANGE title title VARCHAR(255) DEFAULT NULL, CHANGE number number INT DEFAULT NULL, CHANGE synopsis synopsis LONGTEXT DEFAULT NULL, CHANGE duration duration INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE episode CHANGE title title VARCHAR(255) NOT NULL, CHANGE number number INT NOT NULL, CHANGE synopsis synopsis LONGTEXT NOT NULL, CHANGE duration duration INT NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE comment comment LONGTEXT NOT NULL, CHANGE rate rate INT NOT NULL');
    }
}
