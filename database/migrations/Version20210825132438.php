<?php

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20210825132438 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE assignments (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_308A50DD8DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE assignment_student (assignment_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_D41DE2CAD19302F8 (assignment_id), INDEX IDX_D41DE2CACB944F1A (student_id), PRIMARY KEY(assignment_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, course_id INT DEFAULT NULL, title LONGTEXT NOT NULL, description LONGTEXT NOT NULL, from_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', to_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_2ED7EC5591CC992 (course_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses (id INT AUTO_INCREMENT NOT NULL, teacher_id INT DEFAULT NULL, title LONGTEXT NOT NULL, description LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_A9A55A4C41807E1D (teacher_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_student_group (course_id INT NOT NULL, student_group_id INT NOT NULL, INDEX IDX_267A7981591CC992 (course_id), INDEX IDX_267A79814DDF95DC (student_group_id), PRIMARY KEY(course_id, student_group_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_groups (id INT AUTO_INCREMENT NOT NULL, name LONGTEXT NOT NULL, description LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_student_group (student_group_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_B06BC5C64DDF95DC (student_group_id), INDEX IDX_B06BC5C6CB944F1A (student_id), PRIMARY KEY(student_group_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tasks (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, description LONGTEXT NOT NULL, from_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', to_date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE p_class_task (task_id INT NOT NULL, p_class_id INT NOT NULL, INDEX IDX_B150EA658DB60186 (task_id), INDEX IDX_B150EA65370AB730 (p_class_id), PRIMARY KEY(task_id, p_class_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE teachers (id INT AUTO_INCREMENT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, teacher_id INT DEFAULT NULL, student_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email LONGTEXT NOT NULL, password LONGTEXT NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, UNIQUE INDEX UNIQ_1483A5E941807E1D (teacher_id), UNIQUE INDEX UNIQ_1483A5E9CB944F1A (student_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE assignments ADD CONSTRAINT FK_308A50DD8DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id)');
        $this->addSql('ALTER TABLE assignment_student ADD CONSTRAINT FK_D41DE2CAD19302F8 FOREIGN KEY (assignment_id) REFERENCES assignments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE assignment_student ADD CONSTRAINT FK_D41DE2CACB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes ADD CONSTRAINT FK_2ED7EC5591CC992 FOREIGN KEY (course_id) REFERENCES courses (id)');
        $this->addSql('ALTER TABLE courses ADD CONSTRAINT FK_A9A55A4C41807E1D FOREIGN KEY (teacher_id) REFERENCES teachers (id)');
        $this->addSql('ALTER TABLE course_student_group ADD CONSTRAINT FK_267A7981591CC992 FOREIGN KEY (course_id) REFERENCES courses (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course_student_group ADD CONSTRAINT FK_267A79814DDF95DC FOREIGN KEY (student_group_id) REFERENCES student_groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_student_group ADD CONSTRAINT FK_B06BC5C64DDF95DC FOREIGN KEY (student_group_id) REFERENCES student_groups (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_student_group ADD CONSTRAINT FK_B06BC5C6CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE p_class_task ADD CONSTRAINT FK_B150EA658DB60186 FOREIGN KEY (task_id) REFERENCES tasks (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE p_class_task ADD CONSTRAINT FK_B150EA65370AB730 FOREIGN KEY (p_class_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E941807E1D FOREIGN KEY (teacher_id) REFERENCES teachers (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9CB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE assignment_student DROP FOREIGN KEY FK_D41DE2CAD19302F8');
        $this->addSql('ALTER TABLE p_class_task DROP FOREIGN KEY FK_B150EA65370AB730');
        $this->addSql('ALTER TABLE classes DROP FOREIGN KEY FK_2ED7EC5591CC992');
        $this->addSql('ALTER TABLE course_student_group DROP FOREIGN KEY FK_267A7981591CC992');
        $this->addSql('ALTER TABLE assignment_student DROP FOREIGN KEY FK_D41DE2CACB944F1A');
        $this->addSql('ALTER TABLE student_student_group DROP FOREIGN KEY FK_B06BC5C6CB944F1A');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9CB944F1A');
        $this->addSql('ALTER TABLE course_student_group DROP FOREIGN KEY FK_267A79814DDF95DC');
        $this->addSql('ALTER TABLE student_student_group DROP FOREIGN KEY FK_B06BC5C64DDF95DC');
        $this->addSql('ALTER TABLE assignments DROP FOREIGN KEY FK_308A50DD8DB60186');
        $this->addSql('ALTER TABLE p_class_task DROP FOREIGN KEY FK_B150EA658DB60186');
        $this->addSql('ALTER TABLE courses DROP FOREIGN KEY FK_A9A55A4C41807E1D');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E941807E1D');
        $this->addSql('DROP TABLE assignments');
        $this->addSql('DROP TABLE assignment_student');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE courses');
        $this->addSql('DROP TABLE course_student_group');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_groups');
        $this->addSql('DROP TABLE student_student_group');
        $this->addSql('DROP TABLE tasks');
        $this->addSql('DROP TABLE p_class_task');
        $this->addSql('DROP TABLE teachers');
        $this->addSql('DROP TABLE users');
    }
}
