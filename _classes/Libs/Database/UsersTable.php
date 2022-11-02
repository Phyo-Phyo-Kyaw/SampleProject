<?php
      namespace Libs\Database ;


use PDOException;

      class UsersTable {
            private $db ;
            public function __construct(MySQL $db) 
            {
                  $this->db = $db->connect();
            }

            public function insert($data) {
                  try {
                        $data['password'] = password_hash($data['password'] , PASSWORD_DEFAULT);
                        $statement = $this->db->prepare(
                              "INSERT INTO users (
                                    name, email, phone , address, 
                                    password, role_id , created_at
                                    ) VALUES (
                                          :name , :email, :phone , :address ,
                                          :password , :role_id , Now()
                                    )"
                        );
                        $statement->execute($data) ;
                        return $this->db->lastInsertId();

                  } catch (PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }

            public function getAll() {
                  try {
                        $result = $this->db->query("
                              SELECT users.* , roles.name as role , roles.value 
                              FROM users LEFT JOIN roles
                              ON users.role_id = roles.id
                              ORDER BY id desc
                        ");
                        return $result->fetchAll();

                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }

            public function findByEmailAndPassword($email , $password) {
                  try {
                        $statement = $this->db->prepare("
                              SELECT users.* , roles.name AS role , roles.value
                              FROM users LEFT JOIN roles
                              ON users.role_id = roles.id
                              WHERE users.email = :email 
                              
                        ");

                        $statement->execute([
                              ":email" => $email ,
                              
                        ]);
                        $row = $statement->fetch();
                       if($row) {
                              if(password_verify($password , $row->password))
                                    return $row ;
                       }
                       return false;
                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }

            public function suspend($id) {
                  try {
                        $statement = $this->db->prepare("
                              UPDATE users SET suspended = 1
                              WHERE id = :id 
                        ");
                        $statement->execute([
                              ":id" => $id ,
                        ]);

                        return $statement->rowCount();


                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }

            public function unsuspend($id) {
                  try {
                        $statement = $this->db->prepare("
                              UPDATE users SET suspended = 0
                              WHERE id = :id 
                        ");
                        $statement->execute([
                              ":id" => $id ,
                        ]);

                        return $statement->rowCount();


                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }

            public function delete($id) {
                  try {
                        $statement = $this->db->prepare("
                              DELETE FROM users
                              WHERE id = :id 
                        ");
                        $statement->execute([
                              ":id" => $id ,
                        ]);

                        return $statement->rowCount();


                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }

            public function role($id , $role) {
                  try {
                        $statement = $this->db->prepare("
                              UPDATE users SET role_id = :role
                              WHERE id = :id 
                        ");
                        $statement->execute([
                              ":id" => $id ,
                              ":role" => $role ,
                        ]);

                        return $statement->rowCount();


                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }

            public function updatePhoto($id , $photo) {
                  try {
                        $statement = $this->db->prepare("
                              UPDATE users SET photo = :photo
                              WHERE id = :id 
                        ");
                        $statement->execute([
                              ":id" => $id ,
                              ":photo" => $photo ,
                        ]);

                        return $statement->rowCount();


                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }
      }