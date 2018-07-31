<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180725194636 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE canton (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empleado_a (id INT AUTO_INCREMENT NOT NULL, sueldo_id INT NOT NULL, canton_id INT NOT NULL, parroquia_id INT NOT NULL, foto VARCHAR(255) NOT NULL, rol ENUM(\'ROLE_ADMIN\', \'ROLE_SUPERUSER\', \'ROLE_USER\'), tipoempleado ENUM(\'Docente\', \'Médico\', \'Oficina\'), nombres VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, codbiometrico VARCHAR(255) NOT NULL, cedula VARCHAR(255) NOT NULL, fnacimiento DATETIME NOT NULL, ecivil ENUM(\'Soltero/a\', \'Unión de Hecho\', \'Casado/a\', \'Divorciado/a\', \'Viudo/a\'), tsangre VARCHAR(255) NOT NULL, nombreconyugue VARCHAR(255) DEFAULT NULL, cedulaconyugue VARCHAR(255) DEFAULT NULL, cargafamiliar INT NOT NULL, hijos INT NOT NULL, cargaeduc INT NOT NULL, carnetconadis VARCHAR(255) DEFAULT NULL, discapacidad VARCHAR(255) DEFAULT NULL, cuentabanco VARCHAR(255) NOT NULL, nombrebanco VARCHAR(255) NOT NULL, tipocuenta ENUM(\'Ahorro\', \'Corriente\'), ingresomagisterio DATETIME NOT NULL, ingresoinstitucion DATETIME NOT NULL, nombramiento LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', jornada LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', niveljornada LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', asignaturas VARCHAR(500) NOT NULL, edificiolabora LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', directorarea ENUM(\'Si\', \'No\'), descripdirarea VARCHAR(500) DEFAULT NULL, comision ENUM(\'Si\', \'No\'), tipocomision ENUM(\'Coordinador\', \'Integrante\'), nombrecomision VARCHAR(255) DEFAULT NULL, calleprincipal VARCHAR(255) NOT NULL, calletransversal VARCHAR(255) NOT NULL, numcasa VARCHAR(255) NOT NULL, barrio VARCHAR(255) NOT NULL, sector VARCHAR(255) NOT NULL, teldomicilio VARCHAR(255) NOT NULL, teloficina VARCHAR(255) DEFAULT NULL, celular VARCHAR(255) NOT NULL, operadora ENUM(\'Movi\', \'Claro\', \'CNT\', \'Otro\'), emailprincipal VARCHAR(255) NOT NULL, emailalterno VARCHAR(255) DEFAULT NULL, nombreemergencia VARCHAR(255) NOT NULL, parentescoemergencia VARCHAR(255) NOT NULL, telemergencia VARCHAR(255) NOT NULL, INDEX IDX_951C4AB8FBD8F2D3 (sueldo_id), INDEX IDX_951C4AB88D070D0B (canton_id), INDEX IDX_951C4AB874AFDC17 (parroquia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE parroquia (id INT AUTO_INCREMENT NOT NULL, canton_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_23A716688D070D0B (canton_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sueldo (id INT AUTO_INCREMENT NOT NULL, categoria VARCHAR(255) NOT NULL, valor VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE empleado_a ADD CONSTRAINT FK_951C4AB8FBD8F2D3 FOREIGN KEY (sueldo_id) REFERENCES sueldo (id)');
        $this->addSql('ALTER TABLE empleado_a ADD CONSTRAINT FK_951C4AB88D070D0B FOREIGN KEY (canton_id) REFERENCES canton (id)');
        $this->addSql('ALTER TABLE empleado_a ADD CONSTRAINT FK_951C4AB874AFDC17 FOREIGN KEY (parroquia_id) REFERENCES parroquia (id)');
        $this->addSql('ALTER TABLE parroquia ADD CONSTRAINT FK_23A716688D070D0B FOREIGN KEY (canton_id) REFERENCES canton (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE empleado_a DROP FOREIGN KEY FK_951C4AB88D070D0B');
        $this->addSql('ALTER TABLE parroquia DROP FOREIGN KEY FK_23A716688D070D0B');
        $this->addSql('ALTER TABLE empleado_a DROP FOREIGN KEY FK_951C4AB874AFDC17');
        $this->addSql('ALTER TABLE empleado_a DROP FOREIGN KEY FK_951C4AB8FBD8F2D3');
        $this->addSql('DROP TABLE canton');
        $this->addSql('DROP TABLE empleado_a');
        $this->addSql('DROP TABLE parroquia');
        $this->addSql('DROP TABLE sueldo');
    }
}
