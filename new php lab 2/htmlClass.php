<?php 
    class HTMLPage {
        function __construct($title,$data) {
            $this->title = $title;
            echo("
            <html>
                <head>
                <title>{$this->title}</title>
                </head>
                <body>
            ");
            $this->data = $data;
        }
        protected function header(){
            echo "
            <header style='height:50px; widht:100%'>
                <h2>{$this->title}</h2>
            </header>
            ";
        }
        function logo(){
            echo "<div style='width:50px; height:50px'>
                <img style='height:100%;widht:100%;' src='Logo.jpg' alt='Logo.jpg'/>
            </div>";
        }
        function menu(){
            echo "
            <div><a href='index.php'>Назад</a></div>
            ";

        }
         protected function content(){
            echo "
            <div>
            <h3>{$this->data['p1']} <Br></h3>
            <h3>{$this->data['p2']} <Br></h3>
            <h3>{$this->data['p3']} <Br></h3>
            </div>
            ";
        } 
        protected function footer(){
            echo "
            <div style='widht: 100px; margin: 0 auto;'>Copyright ℗</div>
                </body>
            </html>
            ";

        }
        function write(){
            $this->header();
            $this->logo();
            $this->menu();
            $this->content();
            $this->footer();
        }
    };
?>
