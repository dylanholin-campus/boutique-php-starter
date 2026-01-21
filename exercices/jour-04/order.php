<?php

$status = 'canceled';

echo '<h2>Version avec SWITCH</h2>';

$message = '';
$color = '';

switch ($status) {
    case 'standby':
        $message = '⏳ Commande en attente de validation';
        $color = 'orange';
        break;
    case 'validated':
        $message = '✅ Commande validée';
        $color = 'blue';
        break;
    case 'shipped':
        $message = '🚚 Commande expédiée';
        $color = 'purple';
        break;
    case 'delivered':
        $message = '🏠 Commande livrée';
        $color = 'green';
        break;
    case 'canceled':
        $message = '❌ Commande annulée';
        $color = 'red';
        break;
    default:
        $message = '❓ Statut inconnu';
        $color = 'gray';
}

echo "<span style='color: $color; font-weight: bold; font-size: 1.2rem;'>$message</span>";

echo '<hr>';

echo '<h2>Version avec MATCH (PHP 8+)</h2>';

// Avec match, on retourne directement les données associées au statut
$result = match ($status) {
    'standby'   => ['color' => 'orange', 'msg' => '⏳ Commande en attente de validation'],
    'validated' => ['color' => 'blue',   'msg' => '✅ Commande validée'],
    'shipped'   => ['color' => 'purple', 'msg' => '🚚 Commande expédiée'],
    'delivered' => ['color' => 'green',  'msg' => '🏠 Commande livrée'],
    'canceled'  => ['color' => 'red',    'msg' => '❌ Commande annulée'],
    default     => ['color' => 'gray',   'msg' => '❓ Statut inconnu'],
};

echo "<span style='color: {$result['color']}; font-weight: bold; font-size: 1.2rem;'>{$result['msg']}</span>";
