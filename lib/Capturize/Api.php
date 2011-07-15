<?php

class Capturize_Api {

    const CAPTURIZE_URI = "http://staging.capturize.it/";

    private $public_key;
    private $private_key;

    private $quality;

    private $browser_width;
    private $browser_height;

    private $crop_x;
    private $crop_y;
    private $crop_width;
    private $crop_height;

    private $resize_width;
    private $resize_height;


    public function __construct($public_key, $private_key, array $attributes = array())
    {
        $this->public_key = $public_key;
        $this->private_key = $private_key;

        if (isset($attributes["browser_width"]))    $this->setBrowserWidth($attributes["browser_width"]);
        if (isset($attributes["browser_height"]))   $this->setBrowserHeight($attributes["browser_height"]);
        if (isset($attributes["quality"]))          $this->setQuality($attributes["quality"]);
        if (isset($attributes["crop_x"]))           $this->setCropX($attributes["crop_x"]);
        if (isset($attributes["crop_y"]))           $this->setCropY($attributes["crop_y"]);
        if (isset($attributes["crop_width"]))       $this->setCropWidth($attributes["crop_width"]);
        if (isset($attributes["crop_height"]))      $this->setCropHeight($attributes["crop_height"]);
        if (isset($attributes["resize_width"]))     $this->setResizeWidth($attributes["resize_width"]);
        if (isset($attributes["resize_height"]))    $this->setResizeHeight($attributes["resize_height"]);
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

    public function setCropWidth($crop_width)
    {
      $this->crop_width = $crop_width;
    }

    public function setCropHeight($crop_height)
    {
      $this->crop_height = $crop_height;
    }

    public function setResizeWidth($resize_width)
    {
      $this->resize_width = $resize_width;
    }

    public function setResizeHeight($resize_height)
    {
      $this->resize_height = $resize_height;
    }

    public function getImageUrl($url, array $attributes = array())
    {
        $browser_width      = isset($attributes["browser_width"])  ? $attributes["browser_width"]     : $this->browser_width;
        $browser_height     = isset($attributes["browser_height"]) ? $attributes["browser_height"]    : $this->browser_height;
        $quality            = isset($attributes["quality"])        ? $attributes["quality"]           : $this->quality;
        $crop_x             = isset($attributes["crop_x"])         ? $attributes["crop_x"]            : $this->crop_x;
        $crop_y             = isset($attributes["crop_y"])         ? $attributes["crop_y"]            : $this->crop_y;
        $crop_width         = isset($attributes["crop_width"])     ? $attributes["crop_width"]        : $this->crop_width;
        $crop_height        = isset($attributes["crop_height"])    ? $attributes["crop_height"]       : $this->crop_height;
        $resize_width       = isset($attributes["resize_width"])   ? $attributes["resize_width"]      : $this->resize_width;
        $resize_height      = isset($attributes["resize_height"])  ? $attributes["resize_height"]     : $this->resize_height;

        $image_url = "url=".$url;

        if ($browser_width)
        {
          $image_url .= "&browser_width=".$browser_width;
        }

        if ($browser_height)
        {
          $image_url .= "&browser_height=".$browser_height;
        }

        if ($quality)
        {
          $image_url .= "&quality=".$quality;
        }

        if ($crop_x)
        {
          $image_url .= "&crop_x=".$crop_x;
        }

        if ($crop_y)
        {
          $image_url .= "&crop_y=".$crop_y;
        }

        if ($crop_width)
        {
          $image_url .= "&crop_width=".$crop_width;
        }

        if ($crop_height)
        {
          $image_url .= "&crop_height=".$crop_height;
        }

        if ($resize_width)
        {
          $image_url .= "&resize_width=".$resize_width;
        }

        if ($resize_height)
        {
          $image_url .= "&resize_height=".$resize_height;
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