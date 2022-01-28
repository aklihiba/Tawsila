<?php
    class Theme extends Model{
        public function __construct($theme, $bg, $primary, $secondary, $border)
        {
            $this->getConnection();
            //change the colors
            $sql = "UPDATE couleur SET
            code='".$bg."'
            WHERE type='background'";
            $this->query($sql);

            $sql = "UPDATE couleur SET
            code='".$primary."'
            WHERE type='primary'";
            $this->query($sql);

            $sql = "UPDATE couleur SET
            code='".$secondary."'
            WHERE type='secondary'";
            $this->query($sql);

            $sql = "UPDATE couleur SET
            code='".$border."'
            WHERE type='border'";
            $this->query($sql);

            //change the logo photos
            $sql = "UPDATE header SET
            logo='top_logo_".$theme.".png'";  
            $this->query($sql);

            $sql = "UPDATE footer SET
            logo='footer_logo_".$theme.".png'";  
            $this->query($sql);

            $sql = "UPDATE presentation_page SET
            content='big_logo_".$theme.".png'
            WHERE type='img'";
            $this->query($sql);

        }
    }

?>