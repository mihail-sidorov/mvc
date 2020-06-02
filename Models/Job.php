<?php

namespace Models;

use App;

class Job
{

    public $name;
    public $email;
    public $description;
    public $done = 0;
    public $edit_admin = 0;
    protected static $table = 'jobs';
    protected static $all_count;
    protected static $count;
    protected static $page;

    protected static function order_by($params)
    {

        if (isset($params['order_by'])) {
            $result = " ORDER BY {$params['order_by']} ";
            if (isset($params['order'])) {
                $result .= $params['order'];
            }
            else {
                $result .= 'ASC';
            }
        }
        else {
            $result = '';
        }

        return $result;

    }
    
    public static function all()
    {

        static::$page = 0;
        $params = App::$router->params;
        
        $table = static::$table;
        $query = "SELECT * FROM $table" . static::order_by($params);
        return App::$db->execute($query);

    }

    public static function paginate($count)
    {

        $table = static::$table;
        $all_count = App::$db->pdo->query("SELECT COUNT(*) as count FROM $table")->fetchColumn();
        static::$all_count = $all_count;
        static::$count = $count;
        static::$page = 0;

        if ($all_count > $count) {
            $params = App::$router->params;
            if (isset($params['page'])) {
                $page = $params['page'];
            }
            else {
                $page = 1;
            }
            static::$page = $page;

            App::$db->pdo->setAttribute( \PDO::ATTR_EMULATE_PREPARES, false );
            $query = "SELECT * FROM $table" . static::order_by($params) . " LIMIT :limit1, :limit2";
            $query_params = [
                ':limit1' => $page * $count - $count,
                ':limit2' => $count,
            ];
            return App::$db->execute($query, $query_params);
        }
        else {
            return static::all();
        }

    }

    public static function links()
    {

        if (static::$page !== 0) {
            $count_pages = intval(static::$all_count / static::$count);
            if (static::$all_count % static::$count !== 0) {
                $count_pages++;
            }

            $link = App::$router->get_link_without_param(['page']);

            ob_start();
            require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'paginate.php';
            return ob_get_clean();
        }

        return '';
    }

    public static function order($arr)
    {

        $link = App::$router->get_link_without_param(['order_by', 'order']);
        $params = App::$router->params;

        ob_start();
        require ROOTPATH.DIRECTORY_SEPARATOR.'Views'.DIRECTORY_SEPARATOR.'order.php';
        return ob_get_clean();

    }

    public function insert()
    {

        $table = static::$table;
        $query = "INSERT INTO $table (name, email, description, done, edit_admin) VALUES (:name, :email, :description, :done, :edit_admin)";

        $this->protect_fields();

        $params = [
            ':name' => $this->name,
            ':email' => $this->email,
            ':description' => $this->description,
            ':done' => $this->done,
            ':edit_admin' => $this->edit_admin,
        ];

        return App::$db->execute($query, $params);

    }

    public function update($id)
    {

        $table = static::$table;
        $query = "UPDATE $table SET";

        $this->protect_fields();

        $params = [];
        $first = true;
        foreach ($this as $key => $value) {
            if (isset($value)) {
                if ($first) {
                    $query .= " $key = :$key";
                    $first = false;
                }
                else {
                    $query .= ", $key = :$key";
                }
                $params[":$key"] = $value;
            }
        }

        $query .= " WHERE id = :id";
        $params[':id'] = $id;

        return App::$db->execute($query, $params);

    }

    public static function get_field_value($field_name, $id)
    {

        $table = static::$table;
        $query = "SELECT $field_name FROM $table WHERE id = :id";
        $params = [
            ':id' => $id,
        ];

        return App::$db->execute($query, $params)[0][$field_name];

    }

    protected function protect_fields()
    {

        foreach ($this as $index => $value) {
            if (isset($value)) {
                $this->$index = htmlspecialchars(addslashes($value));
            }
        }

    }

}