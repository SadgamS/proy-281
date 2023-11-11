<?php
   
   class Conexion{
       static public function conectar(){
           $link = new PDO("mysql:host=localhost;dbname=bdtmecanica",
                            "root","");
            $link -> exec("set name utf8");

            return $link;

       }
   }