<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171204020839 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content_page CHANGE path path VARCHAR(2048) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE username username VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE content_page CHANGE path path VARCHAR(2048) DEFAULT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE users CHANGE username username VARCHAR(25) NOT NULL COLLATE utf8_unicode_ci, CHANGE email email VARCHAR(60) NOT NULL COLLATE utf8_unicode_ci');
    }
}
