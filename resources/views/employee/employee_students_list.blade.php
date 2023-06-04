<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 1){
    header("location:authenticate\logout_process.php");
    exit;
}else{
    $id = $_SESSION['id'];
?>

@extends('layout/employees_pages')

@section('users_active', 'active-button')
@section('user_icon' , 'storage/images/icons/users-icon-active.svg')
@section('page_name', 'Messages')

@section('body')
@include('contents/students_list')
@endsection

<?php } ?>