<?php

class Capturize_Api {

    const CAPTURIZE_URI = "http://capturize.dev/";

    private $public_key;
    private $private_key;

    private $quality;

    private $browser_width;
    private $browser_height;

    private $crop_x;
    private $crop_y;
    private $crop_w;
    private $crop_h;

    private $resize_w;
    private $resize_h;


    public function __construct($public_key, $private_key)
    {
        $this->public_key = $public_key;
        $this->private_key = $private_key;
    }

    public function setBrowserWidth($browser_width)
    {
      $this->browser_width = $browser_width;
    }

    public function setBrowserHeight($browser_height)
    {
      $this->browser_height = $browser_height;
    }

    public function setQuality($quality)
    {
      $this->quality = $quality;
    }

    public function setCropX($crop_x)
    {
      $this->crop_x = $crop_x;
    }

    public function setCropY($crop_y)
    {
      $this->crop_y = $crop_y;
    }

    public function setCropWidth($crop_w)
    {
      $this->crop_w = $crop_w;
    }

    public function setCropHeight($crop_h)
    {
      $this->crop_h = $crop_h;
    }

    public function setResizeWidth($resize_w)
    {
      $this->resize_w = $resize_w;
    }

    public function setResizeHeight($resize_h)
    {
      $this->resize_h = $resize_h;
    }

    public function getImageUrl($url)
    {
        $image_url = "url=".$url;

        if ($this->browser_width)
        {
          $image_url .= "&browser_width=".$this->browser_width;
        }

        if ($this->browser_height)
        {
          $image_url .= "&browser_height=".$this->browser_height;
        }

        if ($this->quality)
        {
          $image_url .= "&quality=".$this->quality;
        }

        if ($this->crop_x)
        {
          $image_url .= "&crop_x=".$this->crop_x;
        }

        if ($this->crop_y)
        {
          $image_url .= "&crop_y=".$this->crop_y;
        }

        if ($this->crop_w)
        {
          $image_url .= "&crop_w=".$this->crop_w;
        }

        if ($this->crop_h)
        {
          $image_url .= "&crop_h=".$this->crop_h;
        }

        if ($this->resize_w)
        {
          $image_url .= "&resize_w=".$this->resize_w;
        }

        if ($this->resize_h)
        {
          $image_url .= "&resize_h=".$this->resize_h;
        }


        $image_url .= "&hash=".md5($this->private_key.$image_url);
        $image_url .= "&public_key=".$this->public_key;

        return self::CAPTURIZE_URI."?".$image_url;
    }

    public function getImageTag($url)
    {
        return "<img src=\"".$this->getImageUrl($url)."\" />";
    }

}