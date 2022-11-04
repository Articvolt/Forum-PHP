<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UsersManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(string $pseudonyme, string $email, string $password, string $dateCreate, string $role){
            parent::connect();
        }


    }