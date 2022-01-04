<?php
class Image{
    private $_image;
    private $_link;

    public function __construct(array $data)
    {
        $this->hydrate($data);

    }

    public function hydrate(array $data)
    {
        foreach($data as $key => $value)
        {
            //the setters for each attribut
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }


    public function setImage($image)
    {
        if (is_string($image))
        {
            $this->_image = $image;
        }
    }

   

    public function setLink($link)
    {
        if(is_string($link))
        {
            $this->_link = $link;
        }
    }


    public function image(){return $this->_image;}
    public function link(){return $this->_link;}
}
?>