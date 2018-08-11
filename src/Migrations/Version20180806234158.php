<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180806234158 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE postbachillerato (id INT AUTO_INCREMENT NOT NULL, empleado_a_id INT NOT NULL, titulo VARCHAR(500) NOT NULL, institucion VARCHAR(500) NOT NULL, fecha_titulo DATETIME NOT NULL, UNIQUE INDEX UNIQ_F25B7A38B39B91CD (empleado_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE postbachillerato ADD CONSTRAINT FK_F25B7A38B39B91CD FOREIGN KEY (empleado_a_id) REFERENCES empleado_a (id)');
        $this->addSql('ALTER TABLE empleado_a CHANGE rol rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\'), CHANGE tipoempleado tipoempleado ENUM(\'Docente\', \'Médico\', \'Oficina\'), CHANGE ecivil ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), CHANGE tipocuenta tipocuenta ENUM(\'Ahorro\', \'Corriente\'), CHANGE directorarea directorarea ENUM(\'Si\', \'No\'), CHANGE comision comision ENUM(\'Si\', \'No\'), CHANGE tipocomision tipocomision ENUM(\'Coordinador\', \'Integrante\'), CHANGE operadora operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE postbachillerato');
        $this->addSql('ALTER TABLE empleado_a CHANGE rol rol VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipoempleado tipoempleado VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE ecivil ecivil VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipocuenta tipocuenta VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE directorarea directorarea VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE comision comision VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipocomision tipocomision VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE operadora operadora VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
