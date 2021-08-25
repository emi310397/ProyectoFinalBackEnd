<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210825184927 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE course_student_group');
        $this->addSql('ALTER TABLE student_groups ADD course_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE student_groups ADD CONSTRAINT FK_7E5BE1F0591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
        $this->addSql('CREATE INDEX IDX_7E5BE1F0591CC992 ON student_groups (course_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE course_student_group (course_id INT NOT NULL, student_group_id INT NOT NULL, INDEX IDX_267A79814DDF95DC (student_group_id), INDEX IDX_267A7981591CC992 (course_id), PRIMARY KEY(course_id, student_group_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE course_student_group ADD CONSTRAINT FK_267A79814DDF95DC FOREIGN KEY (student_group_id) REFERENCES student_groups (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_student_group ADD CONSTRAINT FK_267A7981591CC992 FOREIGN KEY (course_id) REFERENCES courses (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_groups DROP FOREIGN KEY FK_7E5BE1F0591CC992');
        $this->addSql('DROP INDEX IDX_7E5BE1F0591CC992 ON student_groups');
        $this->addSql('ALTER TABLE student_groups DROP course_id');
    }
}
