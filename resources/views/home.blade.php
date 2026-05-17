@extends('layouts.app')

@section('title')
    Pagina principal
@endsection

@section('contenido') 
    <x-listar-post :posts="$posts"/>
@endsection