<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171223062758 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE roles (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B63E2EC75E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_roles (user_id BIGINT NOT NULL, role_id BIGINT NOT NULL, INDEX IDX_54FCD59FA76ED395 (user_id), INDEX IDX_54FCD59FD60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FD60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');

//        $this->addSql('INSERT INTO roles (name) VALUES ("ROLE_USER"),("ROLE_ADMIN")');
//        $this->addSql("INSERT INTO users (username, password, email, is_active, first_name, last_name, created_at, updated_at, deleted_at) VALUES ('admin', '$2y$12$2J3ww0p/6ahfWwhBlLbx8eGhNUdQljAcmp.LRtDKYJ7LbuMyebrNG', 'admin@admin.dev', '1', NULL, NULL, '2017-12-23 00:00:00', NULL, NULL);");
//        $this->addSql("INSERT INTO user_roles (user_id,role_id) VALUES ( (SELECT user_id FROM users WHERE username='admin'),(SELECT role_id FROM roles WHERE name='ROLE_ADMIN'))");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FD60322AC');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE user_roles');
    }
}
