<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 11/8/2018
 * Time: 09:46
 */

namespace App\EventListener;


use App\Entity\EmpleadoB;
use App\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadListenerB
{
    private $uploader;

    public function __construct(FileUploader $uploader)
    {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        // Retrieve Form as Entity
        $entity = $args->getEntity();

        // This logic only works for Product entities
        if (!$entity instanceof EmpleadoB) {
            return;
        }

        // Check which fields were changes
        $changes = $args->getEntityChangeSet();

        // Declare a variable that will contain the name of the previous file, if exists.
        $previousFilename = null;

        // Verify if the brochure field was changed
        if(array_key_exists("foto", $changes)){
            // Update previous file name
            $previousFilename = $changes["foto"][0];
        }

        // If no new brochure file was uploaded
        if(is_null($entity->getFoto())){
            // Let original filename in the entity
            $entity->setFoto($previousFilename);

            // If a new brochure was uploaded in the form
        }else{
            // If some previous file exist
            if(!is_null($previousFilename)){
                $pathPreviousFile = $this->uploader->getTargetDirectory(). "/". $previousFilename;

                // Remove it
                if(file_exists($pathPreviousFile)){
                    unlink($pathPreviousFile);
                }
            }

            // Upload new file
            $this->uploadFile($entity);
        }
    }

    private function uploadFile($entity)
    {
        // upload only works for Product entities
        if (!$entity instanceof EmpleadoB) {
            return;
        }

        $file = $entity->getFoto();

        // only upload new files
        if ($file instanceof UploadedFile) {
            $fileName = $this->uploader->upload($file);
            $entity->setFoto($fileName);
        }
    }
}