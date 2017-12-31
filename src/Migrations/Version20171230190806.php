<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171230190806 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE content (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, summary VARCHAR(400) DEFAULT NULL, body LONGTEXT DEFAULT NULL, status VARCHAR(65) NOT NULL, path VARCHAR(400) DEFAULT NULL, is_published TINYINT(1) DEFAULT \'1\' NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_FEC530A92B36786B (title), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE content_permissions (content_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_7EC766E984A0A3ED (content_id), INDEX IDX_7EC766E9FED90CCA (permission_id), PRIMARY KEY(content_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permissions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(65) NOT NULL, UNIQUE INDEX UNIQ_2DEDCC6F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id BIGINT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B63E2EC75E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BIGINT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(128) DEFAULT NULL, last_name VARCHAR(128) DEFAULT NULL, is_active TINYINT(1) NOT NULL, deleted_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_roles (user_id BIGINT NOT NULL, role_id BIGINT NOT NULL, INDEX IDX_54FCD59FA76ED395 (user_id), INDEX IDX_54FCD59FD60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group (id INT AUTO_INCREMENT NOT NULL, owner_id BIGINT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(400) DEFAULT NULL, UNIQUE INDEX UNIQ_8F02BF9D5E237E06 (name), INDEX IDX_8F02BF9D7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group_users (group_id INT NOT NULL, user_id BIGINT NOT NULL, INDEX IDX_EDB4471BFE54D947 (group_id), INDEX IDX_EDB4471BA76ED395 (user_id), PRIMARY KEY(group_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_group_permissions (group_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_F04A6885FE54D947 (group_id), INDEX IDX_F04A6885FED90CCA (permission_id), PRIMARY KEY(group_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content_permissions ADD CONSTRAINT FK_7EC766E984A0A3ED FOREIGN KEY (content_id) REFERENCES content (id)');
        $this->addSql('ALTER TABLE content_permissions ADD CONSTRAINT FK_7EC766E9FED90CCA FOREIGN KEY (permission_id) REFERENCES permissions (id)');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FD60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE user_group ADD CONSTRAINT FK_8F02BF9D7E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_group_users ADD CONSTRAINT FK_EDB4471BFE54D947 FOREIGN KEY (group_id) REFERENCES user_group (id)');
        $this->addSql('ALTER TABLE user_group_users ADD CONSTRAINT FK_EDB4471BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_group_permissions ADD CONSTRAINT FK_F04A6885FE54D947 FOREIGN KEY (group_id) REFERENCES user_group (id)');
        $this->addSql('ALTER TABLE user_group_permissions ADD CONSTRAINT FK_F04A6885FED90CCA FOREIGN KEY (permission_id) REFERENCES permissions (id)');


        $this->addSql('INSERT INTO roles (name) VALUES ("ROLE_USER"),("ROLE_ADMIN")');
        $this->addSql("INSERT INTO users (username, password, email, is_active, first_name, last_name, created_at, updated_at, deleted_at) VALUES ('admin', '$2y$12$2J3ww0p/6ahfWwhBlLbx8eGhNUdQljAcmp.LRtDKYJ7LbuMyebrNG', 'admin@admin.dev', '1', NULL, NULL, '2017-12-23 00:00:00', NULL, NULL);");
        $this->addSql("INSERT INTO user_roles (user_id,role_id) VALUES ( (SELECT id FROM users WHERE username='admin'),(SELECT id FROM roles WHERE name='ROLE_ADMIN'))");
        $permissions = [
            'CONTENT_VIEW',
            'CONTENT_EDIT',
            'CONTENT_PUBLISH',
            'CONTENT_CREATE'
        ];
        $this->addSql("INSERT INTO permissions (name) VALUES ('".join("'),('",$permissions)."')");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content_permissions DROP FOREIGN KEY FK_7EC766E984A0A3ED');
        $this->addSql('ALTER TABLE content_permissions DROP FOREIGN KEY FK_7EC766E9FED90CCA');
        $this->addSql('ALTER TABLE user_group_permissions DROP FOREIGN KEY FK_F04A6885FED90CCA');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FD60322AC');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FA76ED395');
        $this->addSql('ALTER TABLE user_group DROP FOREIGN KEY FK_8F02BF9D7E3C61F9');
        $this->addSql('ALTER TABLE user_group_users DROP FOREIGN KEY FK_EDB4471BA76ED395');
        $this->addSql('ALTER TABLE user_group_users DROP FOREIGN KEY FK_EDB4471BFE54D947');
        $this->addSql('ALTER TABLE user_group_permissions DROP FOREIGN KEY FK_F04A6885FE54D947');
        $this->addSql('DROP TABLE content');
        $this->addSql('DROP TABLE content_permissions');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_roles');
        $this->addSql('DROP TABLE user_group');
        $this->addSql('DROP TABLE user_group_users');
        $this->addSql('DROP TABLE user_group_permissions');
    }
}
