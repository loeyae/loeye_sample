<?php

/**
 * UserRepository.php
 *
 * Licensed under the Apache License, Version 2.0 (the "License"),
 * see LICENSE for more details: http://www.apache.org/licenses/LICENSE-2.0.
 *
 * @author  Zhang Yi <loeyae@gmail.com>
 * @version SVN: $Id: Zhang Yi $
 */
namespace app\models\repository;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * @author   Zhang Yi <loeyae@gmail.com>
 */

class UserRepository extends EntityRepository {

     public function getAllUser()
     {
         return $this->_em->createQuery("SELECT u FROM app\\models\\entity\\User u")->getResult();
     }

}
