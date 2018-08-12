<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmpleadoBRepository")
 * @UniqueEntity("cedula", message="El numero de cedula ya existe")
 */

class EmpleadoB
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Image(mimeTypesMessage="Este archivo no es una imagen válida")
     */
    private $foto;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('ROLE_ADMIN', 'ROLE_SUPERUSER', 'ROLE_USER')", length=100)
     * @Assert\Choice(choices = {"ROLE_ADMIN", "ROLE_SUPERUSER", "ROLE_USER"})
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $rol;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('Docente', 'Médico', 'Oficina')", length=100)
     * @Assert\Choice(choices = {"Docente","Médico", "Oficina"})
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $tipoempleado;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     * @Assert\Regex(pattern="/\d/",
     *     match=false,
     *     message="Tu nombre no puede tener números")
     */
    private $nombres;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     * @Assert\Regex(pattern="/\d/",
     *     match=false,
     *     message="Tu nombre no puede tener números"))
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $codbiometrico;

    /**
     * @var string $cedula
     *
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $cedula;

    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $fnacimiento;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('Soltero/a', 'Unión de Hecho', 'Casado/a', 'Divorciado/a', 'Viudo/a')", length=100)
     * @Assert\Choice(choices = {"Soltero/a","Unión de Hecho", "Casado/a", "Divorciado/a", "Viudo/a"})
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $ecivil;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $tsangre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Regex(pattern="/\d/",
     *     match=false,
     *     message="Tu nombre no puede tener números")
     */
    private $nombreconyugue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cedulaconyugue;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $cargafamiliar;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $hijos;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $cargaeduc;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $carnetconadis;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discapacidad;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $cuentabanco;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $nombrebanco;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('Ahorro', 'Corriente')", length=100)
     * @Assert\Choice(choices = {"Ahorro","Corriente"})
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $tipocuenta;


    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $ingresoinstitucion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Sueldo", inversedBy="empleadoAs")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $sueldo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $cargo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $dptolabora;

    /**
     * @ORM\Column(type="simple_array")
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $edificiolabora;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $calleprincipal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $calletransversal;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $numcasa;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $barrio;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $sector;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Canton", inversedBy="empleadoAs")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $canton;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Parroquia", inversedBy="empleadoAs")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $parroquia;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     * @Assert\Length(min="7", max="9", minMessage="Minimo 7 caracteres", maxMessage="Maximo 9 caracteres")
     */
    private $teldomicilio;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min="7", max="9", minMessage="Minimo 7 caracteres", maxMessage="Maximo 9 caracteres")
     */
    private $teloficina;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     * * @Assert\Regex(pattern="/\d/", message="Ingrese solo números")
     * @Assert\Length(min="10", max="10", exactMessage="Debe tener 10 caracteres")
     */
    private $celular;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('Movi', 'Claro', 'CNT', 'Otro')", length=10)
     * @Assert\Choice(choices = {"Movi","Claro", "CNT", "Otro"})
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $operadora;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     * @Assert\Email(message="Correo Electronico Invalido")
     */
    private $emailprincipal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email(message="Correo Electronico Invalido")
     */
    private $emailalterno;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $nombreemergencia;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     */
    private $parentescoemergencia;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Campo Obligatorio")
     * @Assert\Length(min="7", max="9", minMessage="Minimo 7 caracteres", maxMessage="Maximo 9 caracteres")
     */
    private $telemergencia;



    //**************************** GETTERS Y SETTERS *************************//

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto): void
    {
        $this->foto = $foto;
    }


    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCodbiometrico(): ?string
    {
        return $this->codbiometrico;
    }

    public function setCodbiometrico(string $codbiometrico): self
    {
        $this->codbiometrico = $codbiometrico;

        return $this;
    }

    public function getCedula(): ?string
    {
        return $this->cedula;
    }

    public function setCedula(string $cedula): self
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFnacimiento()
    {
        return $this->fnacimiento;
    }

    /**
     * @param mixed $fnacimiento
     */
    public function setFnacimiento($fnacimiento): void
    {
        $this->fnacimiento = $fnacimiento;
    }



    public function getTsangre(): ?string
    {
        return $this->tsangre;
    }

    public function setTsangre(string $tsangre): self
    {
        $this->tsangre = $tsangre;

        return $this;
    }

    public function getNombreconyugue(): ?string
    {
        return $this->nombreconyugue;
    }

    public function setNombreconyugue(string $nombreconyugue): self
    {
        $this->nombreconyugue = $nombreconyugue;

        return $this;
    }

    public function getCedulaconyugue(): ?string
    {
        return $this->cedulaconyugue;
    }

    public function setCedulaconyugue(string $cedulaconyugue): self
    {
        $this->cedulaconyugue = $cedulaconyugue;

        return $this;
    }

    public function getCargafamiliar(): ?int
    {
        return $this->cargafamiliar;
    }

    public function setCargafamiliar(int $cargafamiliar): self
    {
        $this->cargafamiliar = $cargafamiliar;

        return $this;
    }

    public function getHijos(): ?int
    {
        return $this->hijos;
    }

    public function setHijos(int $hijos): self
    {
        $this->hijos = $hijos;

        return $this;
    }

    public function getCargaeduc(): ?int
    {
        return $this->cargaeduc;
    }

    public function setCargaeduc(int $cargaeduc): self
    {
        $this->cargaeduc = $cargaeduc;

        return $this;
    }

    public function getCarnetconadis(): ?string
    {
        return $this->carnetconadis;
    }

    public function setCarnetconadis(?string $carnetconadis): self
    {
        $this->carnetconadis = $carnetconadis;

        return $this;
    }

    public function getDiscapacidad(): ?string
    {
        return $this->discapacidad;
    }

    public function setDiscapacidad(?string $discapacidad): self
    {
        $this->discapacidad = $discapacidad;

        return $this;
    }

    public function getCuentabanco(): ?string
    {
        return $this->cuentabanco;
    }

    public function setCuentabanco(string $cuentabanco): self
    {
        $this->cuentabanco = $cuentabanco;

        return $this;
    }

    public function getNombrebanco(): ?string
    {
        return $this->nombrebanco;
    }

    public function setNombrebanco(string $nombrebanco): self
    {
        $this->nombrebanco = $nombrebanco;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getIngresoinstitucion()
    {
        return $this->ingresoinstitucion;
    }

    /**
     * @param mixed $ingresoinstitucion
     */
    public function setIngresoinstitucion($ingresoinstitucion): void
    {
        $this->ingresoinstitucion = $ingresoinstitucion;
    }



    public function getSueldo(): ?Sueldo
    {
        return $this->sueldo;
    }

    public function setSueldo(?Sueldo $sueldo): self
    {
        $this->sueldo = $sueldo;

        return $this;
    }

    public function getCargo(): ?string
    {
        return $this->cargo;
    }

    public function setCargo(string $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getDptolabora(): ?string
    {
        return $this->dptolabora;
    }

    public function setDptolabora(string $dptolabora): self
    {
        $this->dptolabora = $dptolabora;

        return $this;
    }

    public function getCalleprincipal(): ?string
    {
        return $this->calleprincipal;
    }

    public function setCalleprincipal(string $calleprincipal): self
    {
        $this->calleprincipal = $calleprincipal;

        return $this;
    }

    public function getCalletransversal(): ?string
    {
        return $this->calletransversal;
    }

    public function setCalletransversal(string $calletransversal): self
    {
        $this->calletransversal = $calletransversal;

        return $this;
    }

    public function getNumcasa(): ?string
    {
        return $this->numcasa;
    }

    public function setNumcasa(string $numcasa): self
    {
        $this->numcasa = $numcasa;

        return $this;
    }

    public function getBarrio(): ?string
    {
        return $this->barrio;
    }

    public function setBarrio(string $barrio): self
    {
        $this->barrio = $barrio;

        return $this;
    }

    public function getSector(): ?string
    {
        return $this->sector;
    }

    public function setSector(string $sector): self
    {
        $this->sector = $sector;

        return $this;
    }

    public function getCanton(): ?Canton
    {
        return $this->canton;
    }

    public function setCanton(?Canton $canton): self
    {
        $this->canton = $canton;

        return $this;
    }

    public function getParroquia(): ?Parroquia
    {
        return $this->parroquia;
    }

    public function setParroquia(?Parroquia $parroquia): self
    {
        $this->parroquia = $parroquia;

        return $this;
    }

    public function getTeldomicilio(): ?string
    {
        return $this->teldomicilio;
    }

    public function setTeldomicilio(string $teldomicilio): self
    {
        $this->teldomicilio = $teldomicilio;

        return $this;
    }

    public function getTeloficina(): ?string
    {
        return $this->teloficina;
    }

    public function setTeloficina(?string $teloficina): self
    {
        $this->teloficina = $teloficina;

        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(string $celular): self
    {
        $this->celular = $celular;

        return $this;
    }

    public function getEmailprincipal(): ?string
    {
        return $this->emailprincipal;
    }

    public function setEmailprincipal(string $emailprincipal): self
    {
        $this->emailprincipal = $emailprincipal;

        return $this;
    }

    public function getEmailalterno(): ?string
    {
        return $this->emailalterno;
    }

    public function setEmailalterno(?string $emailalterno): self
    {
        $this->emailalterno = $emailalterno;

        return $this;
    }

    public function getNombreemergencia(): ?string
    {
        return $this->nombreemergencia;
    }

    public function setNombreemergencia(string $nombreemergencia): self
    {
        $this->nombreemergencia = $nombreemergencia;

        return $this;
    }

    public function getParentescoemergencia(): ?string
    {
        return $this->parentescoemergencia;
    }

    public function setParentescoemergencia(string $parentescoemergencia): self
    {
        $this->parentescoemergencia = $parentescoemergencia;

        return $this;
    }

    public function getTelemergencia(): ?string
    {
        return $this->telemergencia;
    }

    public function setTelemergencia(string $telemergencia): self
    {
        $this->telemergencia = $telemergencia;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol): void
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getTipoempleado()
    {
        return $this->tipoempleado;
    }

    /**
     * @param mixed $tipoempleado
     */
    public function setTipoempleado($tipoempleado): void
    {
        $this->tipoempleado = $tipoempleado;
    }

    /**
     * @return mixed
     */
    public function getEcivil()
    {
        return $this->ecivil;
    }

    /**
     * @param mixed $ecivil
     */
    public function setEcivil($ecivil): void
    {
        $this->ecivil = $ecivil;
    }

    /**
     * @return mixed
     */
    public function getTipocuenta()
    {
        return $this->tipocuenta;
    }

    /**
     * @param mixed $tipocuenta
     */
    public function setTipocuenta($tipocuenta): void
    {
        $this->tipocuenta = $tipocuenta;
    }

    /**
     * @return mixed
     */
    public function getNombramiento()
    {
        return $this->nombramiento;
    }

    /**
     * @param mixed $nombramiento
     */
    public function setNombramiento($nombramiento): void
    {
        $this->nombramiento = $nombramiento;
    }

    /**
     * @return mixed
     */
    public function getJornada()
    {
        return $this->jornada;
    }

    /**
     * @param mixed $jornada
     */
    public function setJornada($jornada): void
    {
        $this->jornada = $jornada;
    }

    /**
     * @return mixed
     */
    public function getNiveljornada()
    {
        return $this->niveljornada;
    }

    /**
     * @param mixed $niveljornada
     */
    public function setNiveljornada($niveljornada): void
    {
        $this->niveljornada = $niveljornada;
    }

    /**
     * @return mixed
     */
    public function getEdificiolabora()
    {
        return $this->edificiolabora;
    }

    /**
     * @param mixed $edificiolabora
     */
    public function setEdificiolabora($edificiolabora): void
    {
        $this->edificiolabora = $edificiolabora;
    }

    /**
     * @return mixed
     */
    public function getDirectorarea()
    {
        return $this->directorarea;
    }

    /**
     * @param mixed $directorarea
     */
    public function setDirectorarea($directorarea): void
    {
        $this->directorarea = $directorarea;
    }

    /**
     * @return mixed
     */
    public function getComision()
    {
        return $this->comision;
    }

    /**
     * @param mixed $comision
     */
    public function setComision($comision): void
    {
        $this->comision = $comision;
    }

    /**
     * @return mixed
     */
    public function getTipocomision()
    {
        return $this->tipocomision;
    }

    /**
     * @param mixed $tipocomision
     */
    public function setTipocomision($tipocomision): void
    {
        $this->tipocomision = $tipocomision;
    }

    /**
     * @return mixed
     */
    public function getOperadora()
    {
        return $this->operadora;
    }

    /**
     * @param mixed $operadora
     */
    public function setOperadora($operadora): void
    {
        $this->operadora = $operadora;
    }


}
