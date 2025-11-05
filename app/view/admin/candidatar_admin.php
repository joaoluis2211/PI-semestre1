<?php
session_start();

require_once __DIR__ . '/app/model/Candidatura.php';
$candidatura = new Candidatura();

$candidatura->setPeriodo(isset($_POST['email']) ? trim($_POST['email']) : '');
$candidatura->setCurso(isset($_POST['senha']) ? $_POST['senha'] : '');
$candidatura->setCurso(isset($_POST['senha']) ? $_POST['senha'] : '');
$candidatura->setCurso(isset($_POST['senha']) ? $_POST['senha'] : '');