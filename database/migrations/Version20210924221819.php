<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210924221819 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C41807E1D FOREIGN KEY (teacher_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE student_student_group ADD CONSTRAINT FK_B06BC5C6CB944F1A FOREIGN KEY (student_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX UNIQ_1483A5E941807E1D ON users');
        $this->addSql('DROP INDEX UNIQ_1483A5E9CB944F1A ON users');
        $this->addSql('ALTER TABLE users ADD rol VARCHAR(255) NOT NULL, DROP teacher_id, DROP student_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C41807E1D');
        $this->addSql('ALTER TABLE student_student_group DROP FOREIGN KEY FK_B06BC5C6CB944F1A');
        $this->addSql('ALTER TABLE users ADD teacher_id INT DEFAULT NULL, ADD student_id INT DEFAULT NULL, DROP rol');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E941807E1D ON users (teacher_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9CB944F1A ON users (student_id)');
    }
}
