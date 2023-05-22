<?php

session_start();

if(!isset($_SESSION['loggedin']) or $_SESSION['type'] != 2){
    header("location:authenticate\logout_process.php");
    exit;
}else{
    $id = $_SESSION['id'];
?>

@extends('layout/students_pages')

@section('messages_active', 'active-button')
@section('mail_icon' , 'storage/images/icons/mail-icon-active.svg')
@section('page_name', 'Messages')

@section('body')
@include('contents/messages')
@endsection

<?php } ?>