<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 1){
    header("location:authenticate\logout_process.php");
    exit;
}else{
    $id = $_SESSION['id'];
?>

@extends('layout/employees_pages')

@section('main_active', 'active-button')
@section('home_icon' , 'storage/images/icons/home-icon-active.svg')
@section('page_name', 'Main Page')

<?php } ?>