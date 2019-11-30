<?php 

/**
 * Conn.class [CONEXÃO]
 * Classe de conexão com o Bando de dados. Padrão Singleton
 * @copyright (c) 2019, Francisco Assis
 */
class Conn{
    private static $Host = HOST;
    private static $User = USER;
    private static $Pass = PASS;
    private static $Db = DB;

    /** @var PDO */
    private static $Connect = null;

    private static function Conectar(){
        try{
            if(self::$Connect == null):
                $dsn = 'mysql:host=' . self::$Host . ';dbname=' . self::$Db;
                $options = [ PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8']; 
                self::$Connect = new PDO($dsn, self::$User, self::$Pass, $options);
            endif;
        }catch (PDOException $e){
            echo "<p style='color: #fff; font-size: 0.9em; display: inline-block; background: #d12121; font-family: Calibri, sans-serif; padding: 5px 15px;'>{$e}</p>";
            die;
        }

        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }

    /** retorna um objeto Singleton Pattern. */
    public static function getConn(){
        return self::Conectar();
    }
}


