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
namespace app\models\repository\sample;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * @author   Zhang Yi <loeyae@gmail.com>
 */

class UserRepository extends EntityRepository {


    public function createMember($data)
    {
        $sql = "INSERT INTO `user` SET ";
        $params = [];
        $set = [];
        $data = \loeye\service\Handler::entity2array($data);
        foreach ($data as $key => $value) {
            if (is_null($value)) {
                continue;
            }
            if ($key == "password") {
                $set[] = "`".$key."` = PASSWORD(:". $key .")";
            } else {
                 $set[] = "`".$key."`=:".$key;
            }
            $params[":".$key] = $value;
        }
        $sql .= join(",", $set);
        $smtp = $this->_em->getConnection()->prepare($sql);
        $smtp->execute($params);
        return $this->_em->getConnection()->lastInsertId();
    }

     public function getAllUser()
     {
         return $this->_em->createQuery("SELECT u FROM app\\models\\entity\\sample\\User u")->getResult();
     }

}
