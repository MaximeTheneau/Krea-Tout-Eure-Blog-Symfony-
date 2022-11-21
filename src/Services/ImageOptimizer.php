<?php 
namespace App\Services;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Filter\FilterInterface;

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

    private $filter;
    private $dataManager;

    public function __construct(
        SluggerInterface $slugger,
        ContainerBagInterface $params,
        FilterInterface $filter,
        DataManager $dataManager,
        )
        {
                   
            $this->slugger = $slugger;
            $this->params = $params;
            $this->photoDir =  $this->params->get('app.imgDir');
            $this->projectDir =  $this->params->get('app.projectDir');
            $this->imagine = new Imagine();
            $filter->filter = $filter;
    }

    public function setPicture( $brochureFile, $post, $setName, $slug ): void
    {   

        #dd($this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp,');
        $newForm = '{"small": "'.$this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp",'
                .'"middle": "'.$this->projectDir.$this->photoDir.$slug.'l-w=1000-q=80.webp",'
                .'"large": "'.$this->projectDir.$this->photoDir.$slug.'m-w500-q80.webp"}';

        $post->$setName($newForm);

        
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

    public function setThumbnail( $brochureFile, $post, $setName, $slug ): void
    {   

        #dd($this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp,');
        $newForm = '{"small": "'.$this->projectDir.$this->photoDir.$slug.'-miniature.webp"}';
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


        dd($this->$filter);
        $thumbnail = $this->imagine->open($brochureFile)
            ->thumbnail(new Box($width, $height))
            ->crop(new Point(0, 0), new Box(250, 250), ImageInterface::POSITION_CENTER)
            ->save($this->photoDir.$slug.'-miniature.webp', ['webp_quality' => 80]);

    }
        
}