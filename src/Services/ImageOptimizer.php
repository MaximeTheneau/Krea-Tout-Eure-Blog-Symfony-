<?php 
namespace App\Services;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
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

    private $dataManager;

    public function __construct(
        SluggerInterface $slugger,
        ContainerBagInterface $params,

        DataManager $dataManager,
        )
        {
                   
            $this->slugger = $slugger;
            $this->params = $params;
            $this->photoDir =  $this->params->get('app.imgDir');
            $this->projectDir =  $this->params->get('app.projectDir');
            $this->imagine = new Imagine();
    }

    public function setPicture( $brochureFile, $post, $setName, $slug ): void
    {   

        #dd($this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp,');
        $newForm = '{"small": "'.$this->projectDir.$this->photoDir.$slug.'-s.webp",'
                .'"middle": "'.$this->projectDir.$this->photoDir.$slug.'-m.webp",'
                .'"large": "'.$this->projectDir.$this->photoDir.$slug.'-l.webp"}';

        $post->$setName($newForm);

        
        #dd($this->photoDir.$slug.'s-w250-q80.webp');
        $small = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(320, 320))
            ->save($this->photoDir.$slug.'-s.webp', ['webp_quality' => 80]);
        
        $middle = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(640, 640))
            ->save($this->photoDir.$slug.'-m.webp', ['webp_quality' => 80]);

        $large = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(1000, 1000))
            ->save($this->photoDir.$slug.'-l.webp', ['webp_quality' => 100]);
    
    }

    public function setThumbnail( $brochureFile, $post, $setName, $slug ): void
    {   

        #dd($this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp,');
        $newForm = $this->projectDir.$this->photoDir.$slug.'-miniature.webp';
        #dd($newForm);

        $post->$setName($newForm);

        list($iwidth, $iheight) = getimagesize($brochureFile);
        $ratio = $iwidth / $iheight;
        $width =  250;
        $height = 250;
        if ($width / $height < $ratio) {
            $width = $height * $ratio;
        } else {
            $height = $width / $ratio;
        }
        
        #dd($width, $height);
        
        $thumbnail = $this->imagine->open($brochureFile)
        ->thumbnail(new Box($width, $height))
        ->save($this->photoDir.$slug.'-miniature.webp', ['webp_quality' => 80]);
        
    }
        
}



