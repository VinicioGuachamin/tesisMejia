<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180811141549 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE empleado_b (id INT AUTO_INCREMENT NOT NULL, sueldo_id INT NOT NULL, canton_id INT NOT NULL, parroquia_id INT NOT NULL, foto VARCHAR(255) DEFAULT NULL, rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\'), tipoempleado ENUM(\'Docente\', \'Médico\', \'Oficina\'), nombres VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, codbiometrico VARCHAR(255) NOT NULL, cedula VARCHAR(255) NOT NULL, fnacimiento DATE NOT NULL, ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), tsangre VARCHAR(255) NOT NULL, nombreconyugue VARCHAR(255) DEFAULT NULL, cedulaconyugue VARCHAR(255) DEFAULT NULL, cargafamiliar INT NOT NULL, hijos INT NOT NULL, cargaeduc INT NOT NULL, carnetconadis VARCHAR(255) DEFAULT NULL, discapacidad VARCHAR(255) DEFAULT NULL, cuentabanco VARCHAR(255) NOT NULL, nombrebanco VARCHAR(255) NOT NULL, tipocuenta ENUM(\'Ahorro\', \'Corriente\'), ingresoinstitucion DATE NOT NULL, cargo VARCHAR(255) NOT NULL, dptolabora VARCHAR(255) NOT NULL, edificiolabora LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', calleprincipal VARCHAR(255) NOT NULL, calletransversal VARCHAR(255) NOT NULL, numcasa VARCHAR(255) NOT NULL, barrio VARCHAR(255) NOT NULL, sector VARCHAR(255) NOT NULL, teldomicilio VARCHAR(255) NOT NULL, teloficina VARCHAR(255) DEFAULT NULL, celular VARCHAR(255) NOT NULL, operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\'), emailprincipal VARCHAR(255) NOT NULL, emailalterno VARCHAR(255) DEFAULT NULL, nombreemergencia VARCHAR(255) NOT NULL, parentescoemergencia VARCHAR(255) NOT NULL, telemergencia VARCHAR(255) NOT NULL, INDEX IDX_C151B02FBD8F2D3 (sueldo_id), INDEX IDX_C151B028D070D0B (canton_id), INDEX IDX_C151B0274AFDC17 (parroquia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empleado_b ADD CONSTRAINT FK_C151B02FBD8F2D3 FOREIGN KEY (sueldo_id) REFERENCES sueldo (id)');
        $this->addSql('ALTER TABLE empleado_b ADD CONSTRAINT FK_C151B028D070D0B FOREIGN KEY (canton_id) REFERENCES canton (id)');
        $this->addSql('ALTER TABLE empleado_b ADD CONSTRAINT FK_C151B0274AFDC17 FOREIGN KEY (parroquia_id) REFERENCES parroquia (id)');
        $this->addSql('DROP TABLE bachillerato');
        $this->addSql('DROP TABLE postbachillerato');
        $this->addSql('DROP TABLE superior');
        $this->addSql('ALTER TABLE empleado_a CHANGE rol rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\'), CHANGE tipoempleado tipoempleado ENUM(\'Docente\', \'Médico\', \'Oficina\'), CHANGE fnacimiento fnacimiento DATE NOT NULL, CHANGE ecivil ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), CHANGE tipocuenta tipocuenta ENUM(\'Ahorro\', \'Corriente\'), CHANGE ingresomagisterio ingresomagisterio DATE NOT NULL, CHANGE ingresoinstitucion ingresoinstitucion DATE NOT NULL, CHANGE directorarea directorarea ENUM(\'Si\', \'No\'), CHANGE comision comision ENUM(\'Si\', \'No\'), CHANGE tipocomision tipocomision ENUM(\'Coordinador\', \'Integrante\'), CHANGE operadora operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\')');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bachillerato (id INT AUTO_INCREMENT NOT NULL, empleado_a_id INT NOT NULL, titulo VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, institucion VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, fecha_titulo DATETIME NOT NULL, UNIQUE INDEX UNIQ_40A642E9B39B91CD (empleado_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postbachillerato (id INT AUTO_INCREMENT NOT NULL, empleado_a_id INT NOT NULL, titulo VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, institucion VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, fecha_titulo DATETIME NOT NULL, UNIQUE INDEX UNIQ_F25B7A38B39B91CD (empleado_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superior (id INT AUTO_INCREMENT NOT NULL, empleado_a_id INT NOT NULL, titulo VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, institucion VARCHAR(500) NOT NULL COLLATE utf8mb4_unicode_ci, registro_senescyt VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, nivel VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_7903BCAAB39B91CD (empleado_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bachillerato ADD CONSTRAINT FK_40A642E9B39B91CD FOREIGN KEY (empleado_a_id) REFERENCES empleado_a (id)');
        $this->addSql('ALTER TABLE postbachillerato ADD CONSTRAINT FK_F25B7A38B39B91CD FOREIGN KEY (empleado_a_id) REFERENCES empleado_a (id)');
        $this->addSql('ALTER TABLE superior ADD CONSTRAINT FK_7903BCAAB39B91CD FOREIGN KEY (empleado_a_id) REFERENCES empleado_a (id)');
        $this->addSql('DROP TABLE empleado_b');
        $this->addSql('ALTER TABLE empleado_a CHANGE rol rol VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipoempleado tipoempleado VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE fnacimiento fnacimiento DATETIME NOT NULL, CHANGE ecivil ecivil VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipocuenta tipocuenta VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE ingresomagisterio ingresomagisterio DATETIME NOT NULL, CHANGE ingresoinstitucion ingresoinstitucion DATETIME NOT NULL, CHANGE directorarea directorarea VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE comision comision VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE tipocomision tipocomision VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE operadora operadora VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
