<?php
declare(strict_types = 1);

namespace LampSite;

class ViewTemplate
{
    private string $page_title;
    private string $body_file;
    private array $stylesheets;
    private string $favicon_image_file;
    private string $favicon_image_type;

    public function __construct(
            string $page_title, string $body_file){
        $this->favicon_image_file = "/assets/images/favicon.ico";
        $this->favicon_image_type = "image/ico";
        $this->stylesheets = array();
        $this->page_title = $page_title;
        $this->body_file = $body_file;
    }

    public function render(){
        echo "<html>";
        $this->_head();
        echo "<body>";
        if (!is_readable($this->body_file)) {
            throw new \Exception("Failed to find template body file");
        }
        require($this->body_file);
        echo "</body>";
        $this->_footer();
        echo "</html>";
    }

    public function addDefaultStylesheets(){
        $this->addStylesheet("https://www.w3schools.com/w3css/4/w3.css");
        $this->addStylesheet("https://fonts.googleapis.com/css?family=Montserrat");
        $this->addStylesheet("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css");
        $this->addStylesheet('/assets/css/lampsite.css');
    }
    
    public function addStylesheet(string $stylesheet){
        array_push($this->stylesheets, $stylesheet);
    }

    public function clearStylesheets(){
        $this->stylesheets = array();
    }

    private function _head(){
        $page_title = $this->page_title;
        $favicon_image_file = $this->favicon_image_file;
        $favicon_image_type = $this->favicon_image_type;
        $stylesheets = $this->stylesheets;
        $head_template = __DIR__ . "/../templates/head.php";
        if (!is_readable($head_template)) {
            throw new \Exception("Failed to find template head file");
        }
        require($head_template);
    }

    private function _footer(){
        $footer_template = __DIR__ . "/../templates/footer.php";
        if (!is_readable($footer_template)) {
            throw new \Exception("Failed to find template footer file");
        }
        require($footer_template);
    }
}