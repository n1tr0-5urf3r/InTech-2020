<?php


class Database
{

    private $connection;

    /**
     * Database constructor.
     *
     * Baut die Verbindung zur Datenbank auf
     */
    public function __construct()
    {
        // MySQL-Zugangsdaten
        // Hier: Automatisch auslesen aus .my.cnf. Sonst einfach von Hand eintragen
        $user = get_current_user(); // Benutzer, dem diese Datei gehört!
        $myCnf = parse_ini_file("/home/$user/.my.cnf");

        $host = $myCnf['host'];
        $user = $myCnf['user'];
        $password = $myCnf['password'];
        $database = $myCnf['database'];

        $this->connection = new mysqli($host, $user, $password, $database);
    }

    /**
     * Schließt die Verbindung zru Datenbank
     */
    public function __destruct()
    {
        $this->connection->close();
    }


    /**
     * Löscht die Tabelle tasks und erstelle sie anschließend erneut
     */
    public function reset()
    {
        $this->connection->query("DROP TABLE IF EXISTS tasks");
        $this->connection->query("CREATE TABLE tasks(id INT NOT NULL AUTO_INCREMENT, name TEXT, PRIMARY KEY (id));");
    }


    /**
     * Fügt einen Task mit dem Namen $name in die Tabelle tasks ein
     *
     * @param string $name
     * @return bool true, falls Einfügen erfolgreich
     */
    public function addTask($name)
    {
        $statement = $this->connection->prepare("INSERT INTO tasks(name) VALUES(?)");
        $statement->bind_param("s", $name);
        return $statement->execute();
    }

    /**
     * Löscht den Taks mit der ID $id aus der Tabelle tasks
     *
     * @param int $id
     * @return bool, falls Löschen erfolgreich
     */
    public function deleteTask($id)
    {
        $statement = $this->connection->prepare("DELETE FROM tasks WHERE id = ?");
        $statement->bind_param("i", $id);
        return $statement->execute();
    }

    /**
     * Liefert ein assozaitves Array aller in der Tabelle tasks gespeicherten Einträge
     *
     * @return array
     */
    public function getTasks()
    {
        $result = $this->connection->query("SELECT * FROM tasks");

        $resultArray = [];

        while ($line = $result->fetch_assoc()) {
            array_push($resultArray, $line);
        }

        $result->free();

        return $resultArray;
    }


}