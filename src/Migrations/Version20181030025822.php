<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181030025822 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE bachillerato (id INT AUTO_INCREMENT NOT NULL, empleado_a_id INT NOT NULL, titulo VARCHAR(500) NOT NULL, institucion VARCHAR(500) NOT NULL, fecha_titulo DATETIME NOT NULL, UNIQUE INDEX UNIQ_40A642E9B39B91CD (empleado_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bachillerato_b (id INT AUTO_INCREMENT NOT NULL, empleado_b_id INT NOT NULL, titulo VARCHAR(500) NOT NULL, institucion VARCHAR(500) NOT NULL, fecha_titulo DATE NOT NULL, UNIQUE INDEX UNIQ_C8287BAFA12E3E23 (empleado_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE canton (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado_a (id INT AUTO_INCREMENT NOT NULL, sueldo_id INT NOT NULL, canton_id INT NOT NULL, parroquia_id INT NOT NULL, horario_id INT NOT NULL, foto VARCHAR(255) DEFAULT NULL, rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\', \'NINGUNO\'), tipoempleado ENUM(\'Docente\', \'Médico\', \'Oficina\'), nombres VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, codbiometrico VARCHAR(255) NOT NULL, cedula VARCHAR(15) NOT NULL, fnacimiento DATE NOT NULL, ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), tsangre VARCHAR(255) NOT NULL, nombreconyugue VARCHAR(255) DEFAULT NULL, cedulaconyugue VARCHAR(255) DEFAULT NULL, cargafamiliar INT NOT NULL, hijos INT NOT NULL, cargaeduc INT NOT NULL, carnetconadis VARCHAR(255) DEFAULT NULL, discapacidad VARCHAR(255) DEFAULT NULL, cuentabanco VARCHAR(255) NOT NULL, nombrebanco VARCHAR(255) NOT NULL, tipocuenta ENUM(\'Ahorro\', \'Corriente\'), ingresomagisterio DATE NOT NULL, ingresoinstitucion DATE NOT NULL, nombramiento LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', jornada LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', niveljornada LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', asignaturas VARCHAR(500) NOT NULL, edificiolabora LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', directorarea ENUM(\'Si\', \'No\'), descripdirarea VARCHAR(500) DEFAULT NULL, comision ENUM(\'Si\', \'No\'), tipocomision ENUM(\'Coordinador\', \'Integrante\'), nombrecomision VARCHAR(255) DEFAULT NULL, calleprincipal VARCHAR(255) NOT NULL, calletransversal VARCHAR(255) NOT NULL, numcasa VARCHAR(255) NOT NULL, barrio VARCHAR(255) NOT NULL, sector VARCHAR(255) NOT NULL, teldomicilio VARCHAR(255) NOT NULL, teloficina VARCHAR(255) DEFAULT NULL, celular VARCHAR(255) NOT NULL, operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\'), emailprincipal VARCHAR(255) NOT NULL, emailalterno VARCHAR(255) DEFAULT NULL, nombreemergencia VARCHAR(255) NOT NULL, parentescoemergencia VARCHAR(255) NOT NULL, telemergencia VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_951C4AB87BF39BE0 (cedula), INDEX IDX_951C4AB8FBD8F2D3 (sueldo_id), INDEX IDX_951C4AB88D070D0B (canton_id), INDEX IDX_951C4AB874AFDC17 (parroquia_id), INDEX IDX_951C4AB84959F1BA (horario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado_b (id INT AUTO_INCREMENT NOT NULL, sueldo_id INT NOT NULL, canton_id INT NOT NULL, parroquia_id INT NOT NULL, horario_id INT NOT NULL, foto VARCHAR(255) DEFAULT NULL, rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\', \'NINGUNO\'), tipoempleado ENUM(\'Conserje\', \'Operario de imprenta\'), nombres VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, codbiometrico VARCHAR(255) NOT NULL, cedula VARCHAR(15) NOT NULL, fnacimiento DATE NOT NULL, ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), tsangre VARCHAR(255) NOT NULL, nombreconyugue VARCHAR(255) DEFAULT NULL, cedulaconyugue VARCHAR(255) DEFAULT NULL, cargafamiliar INT NOT NULL, hijos INT NOT NULL, cargaeduc INT NOT NULL, carnetconadis VARCHAR(255) DEFAULT NULL, discapacidad VARCHAR(255) DEFAULT NULL, cuentabanco VARCHAR(255) NOT NULL, nombrebanco VARCHAR(255) NOT NULL, tipocuenta ENUM(\'Ahorro\', \'Corriente\'), ingresoinstitucion DATE NOT NULL, cargo VARCHAR(255) NOT NULL, dptolabora VARCHAR(255) NOT NULL, edificiolabora LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', calleprincipal VARCHAR(255) NOT NULL, calletransversal VARCHAR(255) NOT NULL, numcasa VARCHAR(255) NOT NULL, barrio VARCHAR(255) NOT NULL, sector VARCHAR(255) NOT NULL, teldomicilio VARCHAR(255) NOT NULL, teloficina VARCHAR(255) DEFAULT NULL, celular VARCHAR(255) NOT NULL, operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\'), emailprincipal VARCHAR(255) NOT NULL, emailalterno VARCHAR(255) DEFAULT NULL, nombreemergencia VARCHAR(255) NOT NULL, parentescoemergencia VARCHAR(255) NOT NULL, telemergencia VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C151B027BF39BE0 (cedula), INDEX IDX_C151B02FBD8F2D3 (sueldo_id), INDEX IDX_C151B028D070D0B (canton_id), INDEX IDX_C151B0274AFDC17 (parroquia_id), INDEX IDX_C151B024959F1BA (horario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horario (id INT AUTO_INCREMENT NOT NULL, lunes VARCHAR(255) NOT NULL, martes VARCHAR(255) NOT NULL, miercoles VARCHAR(255) NOT NULL, jueves VARCHAR(255) NOT NULL, viernes VARCHAR(255) NOT NULL, sabado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parroquia (id INT AUTO_INCREMENT NOT NULL, canton_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_23A716688D070D0B (canton_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postbachillerato (id INT AUTO_INCREMENT NOT NULL, empleado_a_id INT NOT NULL, titulo VARCHAR(500) NOT NULL, institucion VARCHAR(500) NOT NULL, fecha_titulo DATETIME NOT NULL, UNIQUE INDEX UNIQ_F25B7A38B39B91CD (empleado_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE postbachillerato_b (id INT AUTO_INCREMENT NOT NULL, empleado_b_id INT NOT NULL, titulo VARCHAR(500) NOT NULL, institucion VARCHAR(500) NOT NULL, fecha_titulo DATE NOT NULL, UNIQUE INDEX UNIQ_78098592A12E3E23 (empleado_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sueldo (id INT AUTO_INCREMENT NOT NULL, categoria VARCHAR(255) NOT NULL, valor VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superior (id INT AUTO_INCREMENT NOT NULL, empleado_a_id INT NOT NULL, titulo VARCHAR(500) NOT NULL, institucion VARCHAR(500) NOT NULL, registro_senescyt VARCHAR(255) NOT NULL, nivel ENUM(\'Tecnólogo\', \'3\', \'4\'), INDEX IDX_7903BCAAB39B91CD (empleado_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superior_b (id INT AUTO_INCREMENT NOT NULL, empleado_b_id INT NOT NULL, titulo VARCHAR(500) NOT NULL, institucion VARCHAR(500) NOT NULL, registro_senescyt VARCHAR(255) NOT NULL, nivel ENUM(\'Tecnólogo\', \'3\', \'4\'), INDEX IDX_497981D7A12E3E23 (empleado_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bachillerato ADD CONSTRAINT FK_40A642E9B39B91CD FOREIGN KEY (empleado_a_id) REFERENCES empleado_a (id)');
        $this->addSql('ALTER TABLE bachillerato_b ADD CONSTRAINT FK_C8287BAFA12E3E23 FOREIGN KEY (empleado_b_id) REFERENCES empleado_b (id)');
        $this->addSql('ALTER TABLE empleado_a ADD CONSTRAINT FK_951C4AB8FBD8F2D3 FOREIGN KEY (sueldo_id) REFERENCES sueldo (id)');
        $this->addSql('ALTER TABLE empleado_a ADD CONSTRAINT FK_951C4AB88D070D0B FOREIGN KEY (canton_id) REFERENCES canton (id)');
        $this->addSql('ALTER TABLE empleado_a ADD CONSTRAINT FK_951C4AB874AFDC17 FOREIGN KEY (parroquia_id) REFERENCES parroquia (id)');
        $this->addSql('ALTER TABLE empleado_a ADD CONSTRAINT FK_951C4AB84959F1BA FOREIGN KEY (horario_id) REFERENCES horario (id)');
        $this->addSql('ALTER TABLE empleado_b ADD CONSTRAINT FK_C151B02FBD8F2D3 FOREIGN KEY (sueldo_id) REFERENCES sueldo (id)');
        $this->addSql('ALTER TABLE empleado_b ADD CONSTRAINT FK_C151B028D070D0B FOREIGN KEY (canton_id) REFERENCES canton (id)');
        $this->addSql('ALTER TABLE empleado_b ADD CONSTRAINT FK_C151B0274AFDC17 FOREIGN KEY (parroquia_id) REFERENCES parroquia (id)');
        $this->addSql('ALTER TABLE empleado_b ADD CONSTRAINT FK_C151B024959F1BA FOREIGN KEY (horario_id) REFERENCES horario (id)');
        $this->addSql('ALTER TABLE parroquia ADD CONSTRAINT FK_23A716688D070D0B FOREIGN KEY (canton_id) REFERENCES canton (id)');
        $this->addSql('ALTER TABLE postbachillerato ADD CONSTRAINT FK_F25B7A38B39B91CD FOREIGN KEY (empleado_a_id) REFERENCES empleado_a (id)');
        $this->addSql('ALTER TABLE postbachillerato_b ADD CONSTRAINT FK_78098592A12E3E23 FOREIGN KEY (empleado_b_id) REFERENCES empleado_b (id)');
        $this->addSql('ALTER TABLE superior ADD CONSTRAINT FK_7903BCAAB39B91CD FOREIGN KEY (empleado_a_id) REFERENCES empleado_a (id)');
        $this->addSql('ALTER TABLE superior_b ADD CONSTRAINT FK_497981D7A12E3E23 FOREIGN KEY (empleado_b_id) REFERENCES empleado_b (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empleado_a DROP FOREIGN KEY FK_951C4AB88D070D0B');
        $this->addSql('ALTER TABLE empleado_b DROP FOREIGN KEY FK_C151B028D070D0B');
        $this->addSql('ALTER TABLE parroquia DROP FOREIGN KEY FK_23A716688D070D0B');
        $this->addSql('ALTER TABLE bachillerato DROP FOREIGN KEY FK_40A642E9B39B91CD');
        $this->addSql('ALTER TABLE postbachillerato DROP FOREIGN KEY FK_F25B7A38B39B91CD');
        $this->addSql('ALTER TABLE superior DROP FOREIGN KEY FK_7903BCAAB39B91CD');
        $this->addSql('ALTER TABLE bachillerato_b DROP FOREIGN KEY FK_C8287BAFA12E3E23');
        $this->addSql('ALTER TABLE postbachillerato_b DROP FOREIGN KEY FK_78098592A12E3E23');
        $this->addSql('ALTER TABLE superior_b DROP FOREIGN KEY FK_497981D7A12E3E23');
        $this->addSql('ALTER TABLE empleado_a DROP FOREIGN KEY FK_951C4AB84959F1BA');
        $this->addSql('ALTER TABLE empleado_b DROP FOREIGN KEY FK_C151B024959F1BA');
        $this->addSql('ALTER TABLE empleado_a DROP FOREIGN KEY FK_951C4AB874AFDC17');
        $this->addSql('ALTER TABLE empleado_b DROP FOREIGN KEY FK_C151B0274AFDC17');
        $this->addSql('ALTER TABLE empleado_a DROP FOREIGN KEY FK_951C4AB8FBD8F2D3');
        $this->addSql('ALTER TABLE empleado_b DROP FOREIGN KEY FK_C151B02FBD8F2D3');
        $this->addSql('DROP TABLE bachillerato');
        $this->addSql('DROP TABLE bachillerato_b');
        $this->addSql('DROP TABLE canton');
        $this->addSql('DROP TABLE empleado_a');
        $this->addSql('DROP TABLE empleado_b');
        $this->addSql('DROP TABLE horario');
        $this->addSql('DROP TABLE parroquia');
        $this->addSql('DROP TABLE postbachillerato');
        $this->addSql('DROP TABLE postbachillerato_b');
        $this->addSql('DROP TABLE sueldo');
        $this->addSql('DROP TABLE superior');
        $this->addSql('DROP TABLE superior_b');
    }
}
