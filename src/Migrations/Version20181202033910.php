<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181202033910 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empleado_a CHANGE rol rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\', \'NINGUNO\'), CHANGE tipoempleado tipoempleado ENUM(\'Docente\', \'Médico\', \'Oficina\'), CHANGE ecivil ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), CHANGE tipocuenta tipocuenta ENUM(\'Ahorro\', \'Corriente\'), CHANGE directorarea directorarea ENUM(\'Si\', \'No\'), CHANGE comision comision ENUM(\'Si\', \'No\'), CHANGE tipocomision tipocomision ENUM(\'Coordinador\', \'Integrante\'), CHANGE operadora operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\')');
        $this->addSql('ALTER TABLE empleado_b CHANGE rol rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\', \'NINGUNO\'), CHANGE tipoempleado tipoempleado ENUM(\'Conserje\', \'Operario de imprenta\', \'Limpieza\'), CHANGE ecivil ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), CHANGE tipocuenta tipocuenta ENUM(\'Ahorro\', \'Corriente\'), CHANGE operadora operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\')');
        $this->addSql('ALTER TABLE horario ADD nombre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE superior CHANGE nivel nivel ENUM(\'Tecnólogo\', \'3\', \'4\')');
        $this->addSql('ALTER TABLE superior_b CHANGE nivel nivel ENUM(\'Tecnólogo\', \'3\', \'4\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empleado_a CHANGE rol rol VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipoempleado tipoempleado VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE ecivil ecivil VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipocuenta tipocuenta VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE directorarea directorarea VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE comision comision VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipocomision tipocomision VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE operadora operadora VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE empleado_b CHANGE rol rol VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipoempleado tipoempleado VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE ecivil ecivil VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipocuenta tipocuenta VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE operadora operadora VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE horario DROP nombre');
        $this->addSql('ALTER TABLE superior CHANGE nivel nivel VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE superior_b CHANGE nivel nivel VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
