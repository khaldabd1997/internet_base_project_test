<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 2){
    header("location:authenticate\logout_process.php");
    exit;
}else{
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
?>


@extends('layout/students_pages')

@section('main_active', 'active-button')
@section('home_icon' , 'storage/images/icons/home-icon-active.svg')
@section('page_name', 'Main Page')


<?php } ?>