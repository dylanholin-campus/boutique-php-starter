<?php

class Car
{
    public string $brand;
    public string $model;
    public int $year;

    public function __construct(string $brand, string $model, int $year)
    {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

    public function getAge(): int
    {     // Retourne l'âge du véhicule
        $currentYear = (int)date('Y'); // Année actuelle (2026)
        return $currentYear - $this->year;
    }

    public function display(): string
    {     // Retourne "Brand Model (X ans)"
        $age = $this->getAge();
        return "{$this->brand} {$this->model} ($age ans)";
    }
}

$car1 = new Car('Toyota', 'Yaris', 2018);
$car2 = new Car('Ford', 'Mustang', 1969);
$car3 = new Car('Tesla', 'Model 3', 2024);

echo $car1->display() . '<br>';
echo $car2->display() . '<br>';
echo $car3->display() . '<br>';
