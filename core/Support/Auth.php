<?php
namespace Core\Support;

use Core\Database\Doctrine;
use stdClass;
use Whoops\Exception\ErrorException;

class Auth
{
    public $db;
    public $table;
    /**
     * @var array|mixed
     */
    private mixed $database;

    public function initDB()
    {
        $this->table = function_exists('config') ? config('app.table', 'users') : (env('AUTH_TABLE') ?: 'users');
        $this->database = config('database.db_database');
        $this->db = new Doctrine($this->table);
    }

    /**
     * @return bool|stdClass
     */
    public static function user()
    {
        return (new self)->get();
    }

    /**
     * @return false
     */
    public static function id()
    {
        $result = (new self)->get();
        if ($result) {
            return $result->id;
        } else {
            return false;
        }
    }

    /**
     * @return bool
     */
    public static function check()
    {
        if(isset($_SESSION['user']) &&  $_SESSION['user'] != ''){
            $return = true;
        }else{
            $return = false;
        }
        return $return;
    }

    /**
     * @param $credentials
     * @return bool
     * @throws ErrorException
     */
    public static function attempt($credentials): bool
    {
        $auth_fields = (new self)->getAuthTableFieldsSkipPassword($credentials);
        $result = (new self)->checkUser($auth_fields);
        if($result) {
            $verify = (new self)->verify($credentials, $result);
            if($verify) {
                session_regenerate_id(true); // Prevent session fixation
                $_SESSION['user'] = $result;
                return true;
            } else {
                self::logout();
                return false;
            }
        }

        self::logout();
        return false;
    }

    /**
     * @param $password
     * @return bool|string
     */
    public static function Hash($password): bool|string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @return bool
     */
    public static function logout(): bool
    {
        session_regenerate_id(true); // Prevent session fixation
        unset($_SESSION['user']);
        return true;
    }

    /**
     * @return bool|stdClass
     */
    private function get()
    {
        if (!isset($_SESSION['user']) || !is_object($_SESSION['user'])) {
            return false;
        }

        $user = $_SESSION['user'];
        $filteredUser = new stdClass();

        foreach ($user as $key => $value) {
            if (stripos($key, 'password') === false) {
                $filteredUser->$key = $value;
            }
        }

        return $filteredUser;
    }


    /**
     * @param $credentials
     * @return mixed
     * @throws \Whoops\Exception\ErrorException
     */
    private function checkUser($credentials): mixed
    {
        self::initDB();
        return $this->db->where_array($credentials)->userFound();
    }

    /**
     * @param $credentials
     * @param $output
     * @return bool
     */
    public function verify($credentials,$output): bool
    {
        $verified = [];
        foreach ($credentials as $field=> $credential){
            $verified[] = password_verify($credential, $output->$field );
        }
        if(in_array(true,$verified)){
            return true;
        }
        return false;
    }

    /**
     * @param array $credentials
     * @return array
     * @throws ErrorException
     */
    private function getAuthTableFieldsSkipPassword(array $credentials): array
    {
        $this->initDB();

        $columns = $this->getTableColumns($this->database, $this->table);

        if (empty($columns)) {
            throw new ErrorException("The table '{$this->table}' for authentication does not exist or cannot be accessed.");
        }

        return $this->filterCredentialsByColumns($credentials, $columns);
    }

    /**
     * @param string $database
     * @param string $table
     * @return array
     */
    private function getTableColumns(string $database, string $table): array
    {
        // Sanitize inputs to avoid SQL injection
        $dbSafe = preg_replace('/[^a-zA-Z0-9_]/', '', $database);
        $tableSafe = preg_replace('/[^a-zA-Z0-9_]/', '', $table);

        $query = "SELECT COLUMN_NAME 
              FROM INFORMATION_SCHEMA.COLUMNS 
              WHERE TABLE_SCHEMA = '{$dbSafe}' 
                AND TABLE_NAME = '{$tableSafe}'";

        $fields = $this->db->rawQuery($query);

        return $fields ?: [];
    }

    /**
     * @param array $credentials
     * @param array $columns
     * @return array
     */
    private function filterCredentialsByColumns(array $credentials, array $columns): array
    {
        $authFields = [];

        foreach ($columns as $field) {
            $columnName = $field->COLUMN_NAME;

            // Skip columns containing 'password' (case-insensitive)
            if (stripos($columnName, 'password') === false && array_key_exists($columnName, $credentials)) {
                $authFields[$columnName] = $credentials[$columnName];
            }
        }

        return $authFields;
    }


}