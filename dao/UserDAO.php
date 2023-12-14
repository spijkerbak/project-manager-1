<?php

require_once 'framework/DAO.php';
require_once 'model/User.php';

class UserDAO extends DAO
{

    private static $select = 'SELECT * FROM `TM1_User`';

    function __construct()
    {
        parent::__construct('User');
    }

    function startList(): void
    {
        $sql = self::$select;
        $sql .= ' ORDER BY `TM1_User`.`username`';
        $this->startListSql($sql);
    }

    function login(User $user): bool
    {
        $sql = 'SELECT * FROM `TM1_User` WHERE `username` = ? AND `password` = ? ';
        $args = [
            $user->getUsername(),
            $user->getPassword(),
        ];
        return $this->execute($sql, $args);
    }

    function get(?string $username)
    {
        if (empty($username)) {
            return new User;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `TM1_User`.`username` = ?';
            return $this->getObjectSql($sql, [$username]);
        }
    }

    function delete(string $username)
    {
        $sql = 'DELETE FROM `TM1_User` WHERE `username` = ?';
        $args = [$username];
        $this->execute($sql, $args);
    }

    private function insert(User $user)
    {
        $sql = 'INSERT INTO `TM1_User` '
            . ' (username, passWord)'
            . ' VALUES (?, ?)';
        $args = [
            $user->getUsername(),
            $user->getPassword(),
        ];
        $this->execute($sql, $args);
    }

    private function update(User $user)
    {
        $sql = 'UPDATE `TM1_User` '
            . ' SET username = ?, password = ? '
            . ' WHERE username = ?';
        $args = [
            $user->getUsername(),
            $user->getPassword(),
            $user->getUsername(),
        ];
        $this->execute($sql, $args);
    }

    function save(User $user)
    {
        if (empty($user->getUsername())) {
            $this->insert($user);
        } else {
            $this->update($user);
        }
    }

}
