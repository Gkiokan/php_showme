<?php

  /*
      Project: PHP ShowMe
      Author: Gkiokan
      Date: 22.12.2015
      Commments: Basic ShowMe Class for the application.

  */


  class showme {

      public $version = "1.0";
      public $author  = "Gkiokan Sali";


      public function __construct(){
          //$this->run();

      }

      /*
          Temporarly load function for Template
      */
      public function load($file=null){
          if(!$file) return false;

          $file = "template/".$file.".php";

          if(file_exists($file))
            include_once $file;
      }


      /*
        The Overloaded constrcutor
      */
      public function run(){
          // We need the typical Header stuff and bla.
          $this->load('header');

          // Lets start with something nice before we get some Infos.
          $this->version();

          // Magic
          $this->show_global();

          // Magic Single Examples .
          if(false):
            $this->view($_SERVER, 'server');
            $this->view($_GET, 'get_');
            $this->view($_POST, 'post_');
            $this->view($_COOKIE, 'cookie_');
            $this->view($_FILES, 'files_');

          endif;

          // Close the Stuff
          $this->load('footer');
      }



      /*
        Handle Version Information
      */
      public function version(){
          $data = [];
          $data["Version"] = $this->version;
          $data["Author"]  = $this->author;
          $data["time"]    = date("d.m.Y H:s:i", time());

          $this->view($data, "info");
      }



      // View the Stuff
      public function view($data=array(), $class='default'){
          echo "<div class='element $class'>";
          if(is_array($data))
          foreach($data as $a=>$b)
            echo "<div class='line'><div class='key'> $a </div>" .  "<div class='value'> $b </div></div>";
          else
            echo "<div class='empty'>" . print_r($data) ." </div>";
          echo "</div>";
      }

      // The magic over the magic
      public function show_global(){
          $data = $GLOBALS;

          if(is_array($data))
          foreach($data as $typ=>$array):
              if($typ!=='GLOBALS'):
              echo "<div class='element'>";
                  echo "<div class='title'> $typ </div>";
                  echo "<div class='content'>"; $this->view($array, $typ); echo "</div>";
              echo "</div>";
              endif;
          endforeach;
          else echo "<div class='empty'>Nothing found in Globals </div>";
      }

  }
