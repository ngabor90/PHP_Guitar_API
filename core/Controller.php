<?php
require_once("model.php");

abstract class Controller
{
    public static function ServRequest(): void
    {
        global $cfg;
        if (isset($_GET[$cfg["procparam"]])) {
            $method = $_GET[$cfg["procparam"]];
            if (array_key_exists($method, $cfg["methods"])) {
                $methodInfo = $cfg["methods"][$method];
                $params = array();

                if ($methodInfo["method"] === "GET" || $methodInfo["method"] === "DELETE") {
                    $params = $_GET;
                } else {
                    $input = file_get_contents("php://input");
                    $params = json_decode($input, true);
                }

                // Ellenőrizzük, hogy milyen paraméterek érkeztek
                error_log("ServRequest Params: " . print_r($params, true));

                $valid = true;
                foreach ($methodInfo["input"] as $inputKey) {
                    if (!isset($params[$inputKey])) {
                        $valid = false;
                        break;
                    }
                }

                if ($valid) {
                    if ($_SERVER["REQUEST_METHOD"] === $methodInfo["method"]) {
                        $result = call_user_func(array("Controller", $methodInfo["name"]), $params);
                        View::setOutput(json_encode($result));
                    } else {
                        View::setOutput(json_encode(array("error" => true, "reason" => "A megadott metódus nem hívható a megadott HTTP metódikán!")));
                    }
                } else {
                    View::setOutput(json_encode(array("error" => true, "reason" => "Hiányos paraméterek!")));
                }
            } else {
                View::setOutput(json_encode(array("error" => true, "reason" => "Ismeretlen metódus!")));
            }
        } else {
            View::setOutput(json_encode(array("error" => true, "reason" => "Hiányos hívás!")));
        }
    }


    private static function GetGuitar(array $input): array
    {
        try {
            $id = isset($input["id"]) ? (int) $input["id"] : null;
            return Model::GetGuitar($id);
        } catch (Exception $ex) {
            return array("error" => true, "reason" => $ex->getMessage(), "realReason" => $ex->getPrevious() ? $ex->getPrevious()->getMessage() : '');
        }
    }

    private static function GetGuitarById(array $input): array
    {
        try {
            if (isset($input["id"])) {
                $id = (int) $input["id"];
                return Model::GetGuitar($id);
            } else {
                return array("error" => true, "reason" => "Az id megadása kötelező!");
            }
        } catch (Exception $ex) {
            return array("error" => true, "reason" => $ex->getMessage(), "realReason" => $ex->getPrevious() ? $ex->getPrevious()->getMessage() : '');
        }
    }

    private static function SetNewGuitar(array $input): array
    {
        try {
            $neededKeys = array("name", "type", "body", "neckProfile", "fretsSize", "fretCount", "bridgePU", "neckPU", "price", "image_url", "storeno");
            $data = array();

            foreach ($neededKeys as $key) {
                if (isset($input[$key])) {
                    $data[$key] = $input[$key];
                } else {
                    return array("error" => true, "reason" => "Hiányzó adat: {$key}");
                }
            }

            Model::SetNewGuitar($data);
            return array("error" => false, "reason" => "Hozzáadás sikeres!");
        } catch (Exception $ex) {
            return array("error" => true, "reason" => $ex->getMessage(), "realReason" => $ex->getPrevious() ? $ex->getPrevious()->getMessage() : '');
        }
    }

    private static function GetAllStoreNos(): array
    {
        try {
            return Model::GetAllStoreNos();
        } catch (Exception $ex) {
            return array("error" => true, "reason" => $ex->getMessage(), "realReason" => $ex->getPrevious() ? $ex->getPrevious()->getMessage() : '');
        }
    }


    private static function ModGuitar(array $input): array
    {
        try {
            if (isset($input["id"])) {
                $id = (int) $input["id"];
                unset($input["id"]); // Az ID már nem szükséges a frissítéshez
                Model::ModGuitar($id, $input);
                return array("error" => false, "reason" => "A módosítás sikeres!");
            } else {
                return array("error" => true, "reason" => "Az id megadása kötelező!");
            }
        } catch (Exception $ex) {
            return array("error" => true, "reason" => $ex->getMessage(), "realReason" => $ex->getPrevious() ? $ex->getPrevious()->getMessage() : '');
        }
    }

    private static function DelGuitar(array $input): array
    {
        try {
            if (isset($input['id']) && is_numeric($input['id'])) {
                Model::DelGuitar((int) $input['id']);
                return ['error' => false, 'reason' => 'A törlés sikeres!'];
            } else {
                return ['error' => true, 'reason' => 'Az id megadása kötelező!'];
            }
        } catch (Exception $ex) {
            return ['error' => true, 'reason' => $ex->getMessage()];
        }
    }
}