<?php
    namespace App;

    abstract class AbstractController{

        public function index(){}
        
        public function redirectTo($ctrl = null, $action = null, $id = null){

            // opérateur ternaire "?" 

            // si le controller n'est pas "home"
            if($ctrl != "home") {
                // l'opérateur ternaire "?" est un raccourci d’écriture pour le if.
                $url = $ctrl ? "?ctrl=".$ctrl : "";
                $url.= $action ? "&action=".$action : "";
                $url.= $id ? "&id=".$id : "";
                // $url.= ".html";
            }
            else $url = "/exercices/forum-PHP/";
            header("Location: $url");
            die();
        }

        public function restrictTo($role){
            
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("security", "login");
            }
            return;
        }

    }