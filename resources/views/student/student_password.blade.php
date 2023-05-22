<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 2){
    header("location:authenticate\logout_process.php");
    exit;
}else{
    $id = $_SESSION['id'];
?>

@extends('layout/students_pages')

@section('password_active', 'active-button')
@section('password_icon' , 'storage/images/icons/password-icon-active.svg')
@section('page_name', 'Change Password')

@section('body')
@include('contents/password')
@endsection

<?php } ?>