<?php
class Form {

    private $fields = [];
    private $action;
    private $submit_name;

    public function __construct($action = "", $submit_name = "Submit") {
        $this->action = $action;
        $this->submit_name = $submit_name;
    }

    public function addField($name, $label, $type = "text", $value = "") {
        $this->fields[] = [
            "name" => $name,
            "label" => $label,
            "type" => $type,
            "value" => $value
        ];
    }

    public function render() {
        echo "<form method='POST' enctype='multipart/form-data'>";
        echo "<table>";

        foreach ($this->fields as $f) {
            echo "<tr>";
            echo "<td><strong>{$f['label']}</strong></td>";
            echo "<td>";

            if ($f['type'] === "textarea") {
                echo "<textarea name='{$f['name']}' required>{$f['value']}</textarea>";
            } else {
                echo "<input type='{$f['type']}' name='{$f['name']}' value='{$f['value']}' required>";
            }

            echo "</td>";
            echo "</tr>";
        }

        echo "<tr><td></td><td><button class='btn' type='submit' name='submit'>{$this->submit_name}</button></td></tr>";
        echo "</table>";
        echo "</form>";
    }
}
?>
