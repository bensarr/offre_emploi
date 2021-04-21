<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210421043557 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE domaine (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, titre VARCHAR(50) NOT NULL, description VARCHAR(500) NOT NULL, niveau_etude NUMERIC(10, 0) DEFAULT NULL, nbr_annee_experience NUMERIC(10, 0) DEFAULT NULL, INDEX IDX_AF86866FA4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre_domaine (offre_id INT NOT NULL, domaine_id INT NOT NULL, INDEX IDX_D47479EC4CC8505A (offre_id), INDEX IDX_D47479EC4272FC9F (domaine_id), PRIMARY KEY(offre_id, domaine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE offre_domaine ADD CONSTRAINT FK_D47479EC4CC8505A FOREIGN KEY (offre_id) REFERENCES offre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre_domaine ADD CONSTRAINT FK_D47479EC4272FC9F FOREIGN KEY (domaine_id) REFERENCES domaine (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandeur DROP FOREIGN KEY FK_665DA6134272FC9F');
        $this->addSql('ALTER TABLE domaine_profile DROP FOREIGN KEY FK_5D8E4E714272FC9F');
        $this->addSql('ALTER TABLE favori DROP FOREIGN KEY FK_EF85A2CC4272FC9F');
        $this->addSql('ALTER TABLE offre_domaine DROP FOREIGN KEY FK_D47479EC4272FC9F');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A54CC8505A');
        $this->addSql('ALTER TABLE offre_domaine DROP FOREIGN KEY FK_D47479EC4CC8505A');
        $this->addSql('DROP TABLE domaine');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE offre_domaine');
    }
}
