<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @var Request $request
 * @var Response $response
 */

$name = $request->query->get('name', 'World');

?>

Hello <?= htmlspecialchars($name, ENT_QUOTES) ?>
