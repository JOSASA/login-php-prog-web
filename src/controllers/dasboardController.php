<?php
// (Asegúrate que el nombre de archivo coincida con el require en PageController)

function get_dashboard_stats($db_conn) {
    $stats = [];
    $stats['total_users'] = $db_conn->query("SELECT COUNT(*) as total FROM usuarios")->fetch_assoc()['total'];
    $stats['total_products'] = $db_conn->query("SELECT COUNT(*) as total FROM productos")->fetch_assoc()['total'];
    $stats['total_orders'] = $db_conn->query("SELECT COUNT(*) as total FROM pedidos")->fetch_assoc()['total'];
    $stats['pending_orders'] = $db_conn->query("SELECT COUNT(*) as total FROM pedidos WHERE state = 'pendiente'")->fetch_assoc()['total'];
    return $stats;
}

// (Usaremos la función que ya existe en ProductController en lugar de duplicarla)
// function get_all_products_admin($db_conn) { ... } 
?>