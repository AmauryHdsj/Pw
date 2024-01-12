<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240108125537 extends AbstractMigration
{
   public function getDescription(): string
    {
        return 'Migration for MailContact entity';
    }

    public function up(Schema $schema): void
    {
        // Créez la table mail_contact
        $this->addSql('CREATE TABLE mail_contact (
            id INT AUTO_INCREMENT NOT NULL,
            date_envoie DATETIME DEFAULT NULL,
            objet VARCHAR(255) DEFAULT NULL,
            message VARCHAR(300) DEFAULT NULL, -- Ajoutez le champ message
            expediteur_id INT DEFAULT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        // Ajoutez une clé étrangère pour la relation avec la table educateurs
        $this->addSql('ALTER TABLE mail_contact ADD CONSTRAINT FK_12346789abcdef FOREIGN KEY (expediteur_id) REFERENCES educateurs (id)');

        // Créez la table de relation mail_contact_edu
        $this->addSql('CREATE TABLE mail_contact_edu (
            mail_contact_id INT NOT NULL,
            contacts_id INT NOT NULL,
            INDEX IDX_987654321fedcba (mail_contact_id),
            INDEX IDX_123456789abcdef (contacts_id),
            PRIMARY KEY(mail_contact_id, contacts_id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        // Ajoutez des clés étrangères pour la relation avec la table mail_contact et la table contacts
        $this->addSql('ALTER TABLE mail_contact_edu ADD CONSTRAINT FK_97654321fedcba FOREIGN KEY (mail_contact_id) REFERENCES mail_contact (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mail_contact_edu ADD CONSTRAINT FK_13456789yabcdef FOREIGN KEY (contacts_id) REFERENCES contacts (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // Supprimez les tables en cas de rollback
        $this->addSql('DROP TABLE mail_contact_edu');
        $this->addSql('DROP TABLE mail_contact');
    }
}
