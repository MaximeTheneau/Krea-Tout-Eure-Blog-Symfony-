<?php 
namespace App\Services;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Liip\ImagineBundle\Imagine\Data\DataManager;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageOptimizer
{

    private $slugger;
    private $params;
    private $photoDir;
    private $projectDir;
    private $imagine;
    private $filterManager;
    private $dataManager;

    public function __construct(
        SluggerInterface $slugger,
        ContainerBagInterface $params,
        FilterManager $filterManager,
        DataManager $dataManager
        )
        {        
            $this->slugger = $slugger;
            $this->params = $params;
            $this->photoDir =  $this->params->get('app.imgDir');
            $this->projectDir =  $this->params->get('app.projectDir');
            $this->imagine = new Imagine();
            $this->filterManager = $filterManager;
            $this->dataManager   = $dataManager;
    }

    public function setPicture( $brochureFile, $post, $name ): void
    {   

        $slug = $this->slugger->slug($this->slugger->slug($post->getTitle()));

        $post->setSlug($slug);
        #dd($this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp,');
        $newForm = '{"small": "'.$this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp",'
                .'"middle": "'.$this->projectDir.$this->photoDir.$slug.'l-w=1000-q=80.webp",'
                .'"large": "'.$this->projectDir.$this->photoDir.$slug.'m-w500-q80.webp"}';
        #dd($newForm);

        $post->$name($newForm);

        
        #dd($slugBase.'s-w250-q80.webp');
        $small = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(250, 250))
            ->save($this->photoDir.$slug.'s-w250-q80.webp', ['webp_quality' => 80]);
        
        $middle = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(500, 500))
            ->save($this->photoDir.$slug.'s-w=500-q=80.webp', ['webp_quality' => 80]);


        $large = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(1000, 1000))
            ->save($this->photoDir.$slug.'l-w=1000-q=80.webp', ['webp_quality' => 80]);
        
    
     }
}