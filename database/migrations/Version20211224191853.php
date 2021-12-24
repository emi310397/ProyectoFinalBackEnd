<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20211224191853 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classes CHANGE from_date from_date DATE NOT NULL, CHANGE to_date to_date DATE NOT NULL');
        $this->addSql('ALTER TABLE tasks CHANGE from_date from_date DATE NOT NULL, CHANGE to_date to_date DATE NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE classes CHANGE from_date from_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', CHANGE to_date to_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE tasks CHANGE from_date from_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', CHANGE to_date to_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }
}
