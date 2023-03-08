@extends('layouts.app')


@section('titulo')
    Pagina Princial
@endsection

@section('contenido')
   <x-listar-post :posts="$posts" />
@endsection
