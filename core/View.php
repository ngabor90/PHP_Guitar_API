<?php

abstract class View
{
    private static string $output;

    public static function getOutput(): string
    {
        return self::$output;
    }

    public static function setOutput(string $output): void
    {
        self::$output = $output;
    }

    public static function RenderJSON(): void
    {
        ob_clean(); // Töröljük az esetleges korábbi kimeneti buffert
        header("Content-type: application/json");
        echo self::$output;
    }

    public static function RenderXML(): void
    {
        ob_clean(); // Töröljük az esetleges korábbi kimeneti buffert
        header("Content-type: text/xml");
        echo self::$output;
    }
}
