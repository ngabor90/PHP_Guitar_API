<?php
include_once("core/DBException.php");
include_once("config.php");

abstract class Model
{
    private static PDO $con;

    public static function Connect(): void
    {
        global $cfg;

        try {
            self::$con = new PDO("mysql:host={$cfg["dbhost"]};dbname={$cfg["dbdb"]}", $cfg["user"], $cfg["pass"]);
            self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            throw new DBException("Csatlakozás sikertelen", $e);
        }
    }

    public static function GetGuitar(?int $id = null): array
    {
        try {
            if ($id !== null) {
                $sql = "SELECT * FROM `guitar` WHERE `id` = :id";
                $prep = self::$con->prepare($sql);
                $prep->bindValue(":id", $id, PDO::PARAM_INT);
                $prep->execute();
                $result = $prep->fetch(PDO::FETCH_ASSOC);
                $prep->closeCursor();
                return $result ? $result : array("error" => true, "reason" => "Nincs találat.");
            } else {
                $sql = "SELECT * FROM `guitar`";
                $result = self::$con->query($sql);
                $returnArray = $result->fetchAll(PDO::FETCH_ASSOC);
                $result->closeCursor();
                return $returnArray;
            }
        } catch (Exception $e) {
            throw new DBException("A lekérdezés sikertelen", $e);
        }
    }

    public static function SetNewGuitar(array $guitarData): void
    {
        try {
            $sql = "INSERT INTO guitar (name, type, body, neckProfile, fretsSize, fretCount, bridgePU, neckPU, price, image_url, storeno) 
                    VALUES (:name, :type, :body, :neckProfile, :fretsSize, :fretCount, :bridgePU, :neckPU, :price, :image_url, :storeno)";
            $prep = self::$con->prepare($sql);
            $prep->execute($guitarData);
            $prep->closeCursor();
        } catch (Exception $e) {
            error_log("A beszúrás sikertelen: " . $e->getMessage() . "\nSQL: " . $sql . "\nAdatok: " . print_r($guitarData, true));  // Logolás
            throw new DBException("A beszúrás sikertelen", $e);
        }
    }

    public static function GetAllStoreNos(): array
    {
        try {
            $sql = "SELECT storeno FROM store";
            $prep = self::$con->prepare($sql);
            $prep->execute();
            $storeNos = $prep->fetchAll(PDO::FETCH_ASSOC);
            $prep->closeCursor();
            return $storeNos;
        } catch (Exception $e) {
            throw new DBException("A lekérdezés sikertelen", $e);
        }
    }



    public static function ModGuitar(int $id, array $guitarData): void
    {
        try {
            $sql = "UPDATE guitar SET ";
            $setParts = [];
            foreach ($guitarData as $key => $value) {
                $setParts[] = "{$key} = :{$key}";
            }
            $sql .= implode(", ", $setParts);
            $sql .= " WHERE id = :id";

            $prep = self::$con->prepare($sql);

            // Hozzáadjuk a paramétereket
            foreach ($guitarData as $key => $value) {
                $prep->bindValue(":{$key}", $value);
            }
            $prep->bindValue(":id", $id, PDO::PARAM_INT);

            $prep->execute();
            $prep->closeCursor();

        } catch (Exception $e) {
            throw new DBException("A módosítás sikertelen", $e);
        }
    }

    public static function DelGuitar(int $id): void
    {
        try {
            // Ellenőrizzük, hogy létezik-e a gitár az adott id-val
            $sqlCheck = "SELECT COUNT(*) FROM guitar WHERE id = :id";
            $prepCheck = self::$con->prepare($sqlCheck);
            $prepCheck->bindValue(":id", $id, PDO::PARAM_INT);
            $prepCheck->execute();
            $exists = $prepCheck->fetchColumn();
            $prepCheck->closeCursor();

            if (!$exists) {
                throw new Exception("A megadott ID-val nem található gitár!");
            }

            // Töröljük a gitárt, ha létezik
            $sql = "DELETE FROM guitar WHERE id = :id";
            $prep = self::$con->prepare($sql);
            $prep->bindValue(":id", $id, PDO::PARAM_INT);
            $prep->execute();
            $prep->closeCursor();
        } catch (Exception $e) {
            throw new DBException("A törlés sikertelen, a megadott ID-val nem található gitár!", $e);
        }
    }
}
