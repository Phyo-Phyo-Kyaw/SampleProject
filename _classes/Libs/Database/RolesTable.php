<?php
      namespace Libs\Database ;

use PDOException;

      class RolesTable {
            private $db ;

            public function __construct(MySQL $db) 
            {
                $this->db = $db->connect();  
            }

            public function getAll() {

                  try {
                        $result = $this->db->query("SELECT * FROM roles");
                        return $result->fetchAll();

                  } catch(PDOException $e) {
                        echo $e->getMessage();
                        exit();
                  }
            }
      }