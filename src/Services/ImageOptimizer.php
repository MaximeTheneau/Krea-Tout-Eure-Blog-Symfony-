<?php 
namespace App\Services;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Liip\ImagineBundle\Imagine\Data\DataManager;


class ImageOptimizer
{

    private $params;
    private $photoDir;
    private $projectDir;
    private $imagine;
    private $filterManager;
    private $dataManager;

    public function __construct(
        ContainerBagInterface $params,
        FilterManager $filterManager,
        DataManager $dataManager
        )
        {        
            $this->params = $params;
            $this->photoDir =  $this->params->get('app.imgDir');
            $this->projectDir =  $this->params->get('app.projectDir');
            $this->imagine = new Imagine();
            $this->filterManager = $filterManager;
            $this->dataManager   = $dataManager;
    }

    public function setPicture( $brochureFile, $newFilename ): void
    {   

        $middle = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(500, 500), allow_upscale: true)
            ->save($this->photoDir.$newFilename.'-500-100.webp', ['webp_quality' => 80]);
        
        $small = $this->imagine
            ->open($brochureFile)
            ->thumbnail(new Box(250, 250))
            ->save($this->photoDir.$newFilename.'-250-80.webp', ['webp_quality' => 80]);
    
     }
}