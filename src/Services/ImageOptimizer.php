<?php 
namespace App\Services;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ImageOptimizer
{
    private $slugger;
    private $params;
    private $photoDir;
    private $projectDir;
    private $imagine;
    private $serializer;

    public function __construct(
        SluggerInterface $slugger,
        ContainerBagInterface $params,
        SerializerInterface $serializer,
        )
        {
                   
            $this->slugger = $slugger;
            $this->params = $params;
            $this->photoDir =  $this->params->get('app.imgDir');
            $this->projectDir =  $this->params->get('app.projectDir');
            $this->imagine = new Imagine();
            $this->serializer = $serializer;
    }

    public function setPicture( $brochureFile, $post, $setName, $slug ): void
    {   



        
        #dd($this->photoDir.$slug.'s-w250-q80.webp');
        $img = $this->imagine->open($brochureFile)
            ->thumbnail(new Box(1000, 1000))
            ->save($this->photoDir.$slug.'.webp', ['webp_quality' => 80]);
        $heightSmall = $img->getSize()->getHeight();
        $widthSmall = $img->getSize()->getWidth();

        $newForm = '{"path": "'.$this->projectDir.$this->photoDir.$slug.'.webp", "width": '.$widthSmall.', "height": '.$heightSmall.'}';

        $post->$setName($this->serializer->decode($newForm, 'json'));
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

    public function setThumbnailJpg( $brochureFile, $post, $setName, $slug ): void
    {   

        #dd($this->projectDir.$this->photoDir.$slug.'s-w250-q80.webp,');
        $newForm = $this->projectDir.$this->photoDir.$slug.'.png';
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
        ->thumbnail(new Box($width, $height), 'inset')
        ->save($this->photoDir.$slug.'.png', ['png_quality' => 80]);
        
    }
        
}



