<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 1){
    header("location:authenticate\logout_process.php");
    exit;
}else{
    $id = $_SESSION['id'];
    $tc = $_SESSION['tc'];
    $name = $_SESSION['name'];
    $surname = $_SESSION['surname'];
    $mobile = $_SESSION['mobile'];
    $email = $_SESSION['email'];
    $depatment = $_SESSION['position'];
    $image = $_SESSION['image'];

?>

@extends('layout/employees_pages')

@section('page_name', 'Info')
@section('info_active', 'active-button')
@section('statistic_icon' , 'storage/images/icons/statistic-icon-active.svg')

@section('body')
@include('contents/info')
@endsection

<?php } ?>