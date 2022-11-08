<?php

    namespace App;

    // Une interface a un but similaire aux classes abstraites
    // c'est juste un plan, qui possède les signature des methodes (fonctions)
    // ne premet pas l'implemétation
    interface ControllerInterface{

        public function index();
    }