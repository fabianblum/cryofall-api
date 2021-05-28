<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210528205907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(500) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE command_queue CHANGE id id BIGINT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE connection_stats DROP FOREIGN KEY connection_stats___ip_geo_fk');
        $this->addSql('ALTER TABLE connection_stats DROP FOREIGN KEY connection_stats___player_fk');
        $this->addSql('ALTER TABLE connection_stats CHANGE player_uid player_uid BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE connection_stats ADD CONSTRAINT FK_918DAE1FA5E3B32D FOREIGN KEY (ip) REFERENCES ip_geo (ip)');
        $this->addSql('ALTER TABLE connection_stats ADD CONSTRAINT FK_918DAE1F2EBA4725 FOREIGN KEY (player_uid) REFERENCES player (uid)');
        $this->addSql('ALTER TABLE gathered DROP FOREIGN KEY gathered___player_fk');
        $this->addSql('ALTER TABLE gathered DROP FOREIGN KEY gathered___server_fk');
        $this->addSql('ALTER TABLE gathered ADD CONSTRAINT FK_A2E4C36D99E6F5DF FOREIGN KEY (player_id) REFERENCES player (uid)');
        $this->addSql('ALTER TABLE gathered ADD CONSTRAINT FK_A2E4C36D1844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('ALTER TABLE ip_geo CHANGE ip ip VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY kills___killed_npc_fk');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY kills___killed_player_fk');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY kills___killer_npc_fk');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY kills___killer_player_fk');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY kills___server_fk');
        $this->addSql('ALTER TABLE kills CHANGE server_id server_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT FK_2F673FA12ED7AC39 FOREIGN KEY (killed_npc_id) REFERENCES npc (id)');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT FK_2F673FA154A7FB78 FOREIGN KEY (killed_player_uid) REFERENCES player (uid)');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT FK_2F673FA194039495 FOREIGN KEY (killer_npc_id) REFERENCES npc (id)');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT FK_2F673FA1B782B364 FOREIGN KEY (killer_player_uid) REFERENCES player (uid)');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT FK_2F673FA11844E6B7 FOREIGN KEY (server_id) REFERENCES server (id)');
        $this->addSql('ALTER TABLE player CHANGE uid uid BIGINT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE users');
        $this->addSql('ALTER TABLE command_queue CHANGE id id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE connection_stats DROP FOREIGN KEY FK_918DAE1FA5E3B32D');
        $this->addSql('ALTER TABLE connection_stats DROP FOREIGN KEY FK_918DAE1F2EBA4725');
        $this->addSql('ALTER TABLE connection_stats CHANGE player_uid player_uid BIGINT NOT NULL');
        $this->addSql('ALTER TABLE connection_stats ADD CONSTRAINT connection_stats___ip_geo_fk FOREIGN KEY (ip) REFERENCES ip_geo (ip) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE connection_stats ADD CONSTRAINT connection_stats___player_fk FOREIGN KEY (player_uid) REFERENCES player (uid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gathered DROP FOREIGN KEY FK_A2E4C36D99E6F5DF');
        $this->addSql('ALTER TABLE gathered DROP FOREIGN KEY FK_A2E4C36D1844E6B7');
        $this->addSql('ALTER TABLE gathered ADD CONSTRAINT gathered___player_fk FOREIGN KEY (player_id) REFERENCES player (uid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gathered ADD CONSTRAINT gathered___server_fk FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ip_geo CHANGE ip ip VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY FK_2F673FA12ED7AC39');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY FK_2F673FA154A7FB78');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY FK_2F673FA194039495');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY FK_2F673FA1B782B364');
        $this->addSql('ALTER TABLE kills DROP FOREIGN KEY FK_2F673FA11844E6B7');
        $this->addSql('ALTER TABLE kills CHANGE server_id server_id BIGINT NOT NULL');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT kills___killed_npc_fk FOREIGN KEY (killed_npc_id) REFERENCES npc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT kills___killed_player_fk FOREIGN KEY (killed_player_uid) REFERENCES player (uid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT kills___killer_npc_fk FOREIGN KEY (killer_npc_id) REFERENCES npc (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT kills___killer_player_fk FOREIGN KEY (killer_player_uid) REFERENCES player (uid) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kills ADD CONSTRAINT kills___server_fk FOREIGN KEY (server_id) REFERENCES server (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player CHANGE uid uid BIGINT NOT NULL');
    }
}
