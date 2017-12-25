<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171240000001 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE content_permissions (content_id INT NOT NULL, permission_id INT NOT NULL, INDEX IDX_7EC766E984A0A3ED (content_id), INDEX IDX_7EC766E9FED90CCA (permission_id), PRIMARY KEY(content_id, permission_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permissions (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(65) NOT NULL, UNIQUE INDEX UNIQ_2DEDCC6F5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE content_permissions ADD CONSTRAINT FK_7EC766E984A0A3ED FOREIGN KEY (content_id) REFERENCES content (id)');
        $this->addSql('ALTER TABLE content_permissions ADD CONSTRAINT FK_7EC766E9FED90CCA FOREIGN KEY (permission_id) REFERENCES permissions (id)');

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

        $this->addSql('ALTER TABLE content_permissions DROP FOREIGN KEY FK_7EC766E9FED90CCA');
        $this->addSql('DROP TABLE content_permissions');
        $this->addSql('DROP TABLE permissions');
    }
}
