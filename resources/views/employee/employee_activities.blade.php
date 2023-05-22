<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 1){
    header("location:authenticate\logout_process.php");
    exit;
}else{
    $id = $_SESSION['id'];
?>

@extends('layout/employees_pages')

@section('activities_active', 'active-button')
@section('activities_icon' , 'storage/images/icons/activities-icon-active.svg')
@section('page_name', 'Activities')

@section('body')
@include('contents/activities_employee')
@endsection

<?php } ?>