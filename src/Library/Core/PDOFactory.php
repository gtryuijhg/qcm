<?php
namespace Aftral\Qcm\Library\Core;

/**
 * 
 * @author gregoire.huteau
 *
 */
abstract class PDOFactory
{
    private static $_databaseConnection;
    private static $_sgbdr;
    private static $_host;
    private static $_dbname;
    private static $_charset;
    private static $_login;
    private static $_password;
    private static $_options;
    
    /**
     * 
     * @return \PDO
     */
    public static function getDatabaseConnection()
    {
        if (self::$_databaseConnection == NULL)
        {
            self::setDatabaseConnection();
        }
        
        return self::$_databaseConnection;
    }
    
    private static function setDatabaseConnection()
    {
        $xml = new \DomDocument();
        $xml->load(__DIR__.'/databaseConnection.xml');
        
        $connections = $xml->getElementsByTagName('connection');
        
        //utiliser une boucle pour récupérer les éléments de LA SEULE connexion à une base de données
        foreach ($connections as $connection) {
            self::$_sgbdr = $connection->getAttribute('sgbdr');
            self::$_host = $connection->getAttribute('host');
            self::$_dbname = $connection->getAttribute('dbname');
            self::$_charset = $connection->getAttribute('charset');
            self::$_login = $connection->getAttribute('login');
            self::$_password = $connection->getAttribute('password');
            self::$_options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];
            
            self::$_databaseConnection = new \PDO(self::$_sgbdr.':host='.self::$_host.';dbname='.self::$_dbname.';charset='.self::$_charset.'', ''.self::$_login.'',''. self::$_password, self::$_options);
        }      
    }
}

